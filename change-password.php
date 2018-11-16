<?php
include('./classes/db.php');
include('./classes/Login.php');
include('header.php');

$tokenIsValid = False;
if (Login::isLoggedIn()) {
        if (isset($_POST['changepass'])) {
                $oldpassword = $_POST['oldpass'];
                $newpassword = $_POST['newpass'];
                $newconfirm = $_POST['newconfirm'];
                $userid = Login::isLoggedIn();
                if (password_verify($oldpassword, DB::query('SELECT password FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['password'])) {
                        if ($newpassword == $newconfirm) {
                                if (strlen($newpassword) >= 6 && strlen($newpassword) <= 60) {
                                        DB::query('UPDATE users SET password=:newpassword WHERE id=:userid', array(':newpassword'=>password_hash($newpassword, PASSWORD_BCRYPT), ':userid'=>$userid));
                                        echo 'Password changed successfully!';
                                }
                        } else {
                                echo '<p />Passwords don\'t match!';
                        }
                } else {
                        echo '<p />Incorrect old password!';
                }
        }
} else {
        if (isset($_GET['token'])) {
        $token = $_GET['token'];
        if (DB::query('SELECT user_id FROM password_tokens WHERE token=:token', array(':token'=>sha1($token)))) {
                $userid = DB::query('SELECT user_id FROM password_tokens WHERE token=:token', array(':token'=>sha1($token)))[0]['user_id'];
                $tokenIsValid = True;
                if (isset($_POST['changepassword'])) {
                        $newpassword = $_POST['newpassword'];
                        $newconfirm = $_POST['newconfirm'];
                                if ($newpassword == $newconfirm) {
                                        if (strlen($newpassword) >= 6 && strlen($newpassword) <= 60) {
                                                DB::query('UPDATE users SET password=:newpassword WHERE id=:userid', array(':newpassword'=>password_hash($newpassword, PASSWORD_BCRYPT), ':userid'=>$userid));
                                                echo 'Password changed successfully!';
                                                DB::query('DELETE FROM password_tokens WHERE user_id=:userid', array(':userid'=>$userid));
                                        }
                                } else {
                                        echo '<p /><font color="red">Passwords don\'t match!</font>';
                                }
                        }
        } else {
                die('<p /><font color="red">Token invalid</font>');
        }
} else {
        die('<p /><font color="red">Not logged in</font>');
}
}
?>
<div class="ContentLeft">
<h1>Change your Password</h1>
<form action="<?php if (!$tokenIsValid) { echo 'change-password.php'; } else { echo 'change-password.php?token='.$token.''; } ?>" method="post">
        <?php if (!$tokenIsValid) { echo '<input class="StyleTxtField" type="password" name="oldpass" value="" placeholder="Current Password ..."><p />'; } ?>
        <input class="StyleTxtField" type="password" name="newpass" value="" placeholder="New Password ..."><p />
        <input class="StyleTxtField" type="password" name="newconfirm" value="" placeholder="Confirm Password ..."><p />
        <input type="submit" name="changepass" value="Change Password">
</form>
</div>
