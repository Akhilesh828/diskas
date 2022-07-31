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

  $sql = "select * from users where user_id = '$login_id' ";
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



  $sql2 = "select * from bmark where bmark_user_id = '$login_id' ";
  $query2 = mysqli_query($conn, $sql2);
  $bookmark_no = mysqli_num_rows($query2)
  // $row = mysqli_fetch_assoc($query2);

  ?>




  <div class="profile_container">
    <!-- <h1>Akhilesh</h1> -->
    <div class="profile_parent">
      <h2>----- Profile -----</h2>
      <a href="./edit_profile.php"><i class="fas fa-user-edit"></i></a>

      <div class="profile_detail">
        <div class="left_profile">
          <div class=""><span>Name</span> :- <?php echo $user_name ?> </div>
          <div class=""><span>Email</span> :- <?php echo $user_email ?> </div>
          <div class="">
            <span>Location</span> :- <?php echo $user_location ?>
          </div>

          <div class=""><span>About me</span> :- <?php echo $user_about ?> </div>
          <div class=""><span>University</span> :- <?php echo $user_university ?> </div>
          <div class=""><span>Bookmarks <i class="fa-solid fa-bookmark"></i></span> :- <a href="./bookmarks.php"><?php echo $bookmark_no ?></a> </div>


        </div>

        <div class="right_profile">
          <div class=""><span>Job Title</span> :- <?php echo $user_job_title ?> </div>
          <div class=""><span>Website link</span> :- <?php echo $user_website ?> </div>
          <div class="">
            <span>Linkdein</span> :- <?php echo $user_linkedin ?>
          </div>
          <div class=""><span>GitHub</span> :- <?php echo $user_github ?> </div>
          <div class=""><span>Delete <i style="color: red; width: 20px" class="fa-solid fa-user-slash"></i></span> :- <a href="./delete/delete_selfprofile.php?user_id=<?php echo $row['user_id']?>"> click here</a> </div>
        </div>

      </div>
    </div>
  </div>






  <?php
  include "./partials/footer.php"

  ?>



</body>

</html>