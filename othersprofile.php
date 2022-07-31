<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "server/conn.php";
include "partials/_links.php"
?>

<body>

    <title>Profile</title>
    <link rel="stylesheet" href="./profile.css" />

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
        $login_id = $_SESSION['loginid'];
    } else {
        $login_id = 0;
        header("Location: http://localhost/forum/4/login.php");
    }

    include "./partials/navbar.php";
    ?>

    <?php

    $user_id = $_GET['id'];

    $sql = "select * from users where user_id = '$user_id' ";
    $query = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($query);
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_location = $row['user_location'];
    $user_about = $row['user_about'];
    $user_university = $row['user_university'];
    $user_job_title = $row['user_job_title'];
    $user_website = $row['user_website'];
    $user_linkedin = $row['user_linkedin'];
    $user_github = $row['user_github'];


    $sql2 = "select threadlist_id from threadlist where threadlist_user_id = '$user_id'";
    $query2 = mysqli_query($conn,$sql2);
    $questioned = mysqli_num_rows($query2);

    $sql3 = "select comment_id from comment where comment_user_id = '$user_id'";
    $query3 = mysqli_query($conn,$sql3);
    $answered = mysqli_num_rows($query3);

    $sql4 = "select SUM(comment_likes) from comment where comment_user_id = '$user_id' ";
    $query4 = mysqli_query($conn, $sql4);
    $likes_on_comment = mysqli_fetch_assoc($query4);
    $likes_on_comment = implode("", $likes_on_comment);

    if($likes_on_comment<1){
        $likes_on_comment = 0;
    }

    ?>




    <div class="profile_container">
        <!-- <h1>Akhilesh</h1> -->
        <div class="profile_parent">
            <h2>----- Profile -----</h2>
            <!-- <a href="./edit_profile.php"><i  class="fas fa-user-edit"></i></a> -->
            <div class="profile_detail">
                <div class="left_profile">
                    <div class=""><span>Name</span> :- <?php echo $user_name ?> </div>
                    <div class=""><span>Email</span> :- <?php echo $user_email ?> </div>
                    <div class="">
                        <span>Location</span> :- <?php echo $user_location ?>
                    </div>

                    <div class=""><span>About me</span> :- <?php echo $user_about ?> </div>
                    <div class=""><span>University</span> :- <?php echo $user_university ?> </div>

                </div>

                <div class="right_profile">
                    <div class=""><span>Job Title</span> :- <?php echo $user_job_title ?> </div>
                    <div class=""><span>Website link</span> :- <?php echo $user_website ?> </div>
                    <div class="">
                        <span>Linkdein</span> :- <?php echo $user_linkedin ?>
                    </div>
                    <div class=""><span>GitHub</span> :- <?php echo $user_github ?> </div>
                    <div class=""><span>Questioned</span> :- <?php echo $questioned ?> </div>
                    <div class=""><span>Answered</span> :- <?php echo $answered ?> </div>
                    <div class=""><span>likes</span> :- <?php echo $likes_on_comment ?> </div>
                </div>

            </div>
        </div>
    </div>






    <?php
    include "./partials/footer.php"

    ?>



</body>

</html>