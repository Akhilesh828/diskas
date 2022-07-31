<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    include "./partials/_links.php";
?>

<title>edit_profile</title>
<link rel="stylesheet" href="./edit_profile.css"/>

<body>
<?php
    include "./server/conn.php";
    include "./partials/navbar.php";

    include "./components/with_login.php";


?>

<?php
    
    if(isset($_POST['submit'])){

        $user_name = mysqli_real_escape_string($conn, $_POST['name']);
        $user_email = mysqli_real_escape_string($conn, $_POST['email']);
        $user_location = mysqli_real_escape_string($conn, $_POST['location']);
        $user_about = mysqli_real_escape_string($conn, $_POST['about']);
        $user_university = mysqli_real_escape_string($conn, $_POST['university']);
        $user_job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
        $user_website = mysqli_real_escape_string($conn, $_POST['website']);
        $user_linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);
        $user_github = mysqli_real_escape_string($conn, $_POST['github']);


        $sql = "update users set 
        user_name = '$user_name',
        user_email = '$user_email',
        user_location = '$user_location',
        user_about = '$user_about',
        user_job_title = '$user_job_title',
        user_website = '$user_website',
        user_linkedin = '$user_linkedin',
        user_github = '$user_github',
        user_university = '$user_university'
        where user_id = '$login_id' ";

        $query1 = mysqli_query($conn ,$sql);

        
        if($query1){
            ?>
            <script>
                alert("Profile Updated");
                history.back();
            </script>
            <?php
        }


    }
    
    
?>



<?php
    
    $sql2 = "select * from users where user_id = '$login_id' ";
    $query2 = mysqli_query($conn, $sql2);
    
    $row = mysqli_fetch_assoc($query2);
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_location = $row['user_location'];
        $user_about = $row['user_about'];
        $user_university = $row['user_university'];
        $user_job_title = $row['user_job_title'];
        $user_website = $row['user_website'];
        $user_linkedin = $row['user_linkedin'];
        $user_github = $row['user_github'];
        // $user_name = $row['user_name'];
        // $user_name = $row['user_name'];
    
?>


    
<div class="edit_profile_container">
        <h1> .</h1>
        <h1> .</h1>
        <div class="edit_profile">
            <h2>Profile information</h2>
            

            <form action="" method="POST">

                <div class="public_info">
                    <div class="image"></div>
                    <h3>Profile</h3>
                    <br>

                    <label for="">
                        Display Name
                    </label> <br>
                    <input type="text"  value="<?php echo $user_name   ?>" name="name"> <br>

                    <label for="">
                        Email
                    </label> <br>
                    <input type="email" value="<?php echo $user_email  ?>" name="email"> <br>


                    <label for="">
                        Location
                    </label> <br>
                    <input type="text" value="<?php echo $user_location   ?>" name="location"> <br>

                    
                    <label for="">
                        University
                    </label> <br>
                    <input type="text" value="<?php echo $user_university  ?>" name="university"> <br>

                    <label for="">
                        Job Title
                    </label> <br>
                    <input type="text" value="<?php echo $user_job_title   ?>" name="job_title"> <br>

                    <label for="">
                        About me
                    </label> <br>
                    <textarea  name="about" id="" cols="50" rows="50"><?php echo $user_about ?></textarea> <br>

                </div>

                <div class="links_info">
                    <h3>Links</h3>
                    <br>

                    <label for="">
                        Website link
                    </label> <br>
                    <input type="text" value="<?php echo $user_website   ?>" name="website"> <br>

                    <label for="">
                        Linkedin link or username
                    </label> <br>
                    <input type="text" value="<?php echo $user_linkedin   ?>" name="linkedin"> <br>

                    <label for="">
                        GitHub link or username
                    </label> <br>
                    <input type="text" value="<?php echo $user_github   ?>" name="github"> <br>

                <button name="submit" >Save profile</button>


                </div>

            </form>
        </div>
    </div>



    <?php
        include "./partials/footer.php";
        
        
    ?>

    
</body>
</html>