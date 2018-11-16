<?php
include('classes/db.php');
include('classes/Login.php');
include('header2.php');

$username = "";
$isFollowing = False;
if (isset($_GET['username'])) {
        if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))) {

                $username = DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];
                //$userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
                //$followerid = Login::isLoggedIn();

                //if (isset($_POST['follow'])) {

                       // if ($userid != $followerid) {

                                //if (!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {

                                        //DB::query('INSERT INTO followers VALUES (\'\', :userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
                                //} else {
                                       // echo 'Already following!';
                                //}
                               // $isFollowing = True;
                       // }
                //}
               // if (isset($_POST['unfollow'])) {

                      // if ($userid != $followerid) {

                               // if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid', array(':userid'=>$userid))) {

                                       // DB::query('DELETE FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid));
                               // }
                               // $isFollowing = False;
                      // }
               // }
               // if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                        //echo 'Already following!';
                        //$isFollowing = True;
               // }

                if (isset($_POST['post'])) {
                        $body = $_POST['body'];
                        $user_id = Login::isLoggedIn();

                        DB::query('INSERT INTO posts VALUES (\'\', :body, NOW(), :user_id, 0)', array(':body'=>$body, ':user_id'=>$user_id));
                        
               }

        }
                $user_id = Login::isLoggedIn();
                $dbposts = DB::query('SELECT * FROM posts WHERE user_id=:user_id ORDER BY id DESC', array(':user_id'=>$user_id));
                $posts = "";
                foreach($dbposts as $p) {
                       $posts .= htmlspecialchars($p['body'])."<hr><br>";
                }

        } else {
                die('User not found!');
        }            

?>
<div class="ContentLeft">
<br>
<b><?php echo date("l d F Y"); ?></b><br><br>
	<script>display_c;</script>
<h1><?php echo $username; ?>'s Profile</h1><br><br>
<form action="profile.php?username=<?php echo $username; ?>" method="post">
        <textarea name="body" rows="20" cols="80"></textarea><br><br>
        <input type="submit" name="post" value="Post">
</form>
</div>
<div class="ContentRight">
		<?php echo $posts; ?>
</div>