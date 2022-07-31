<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    
    include "./server/conn.php";
    include "./partials/_links.php";
    include "./partials/navbar.php";

?>


<title>Reset</title>

<link rel="stylesheet" href="./login.css"/>


<body>
    

        
    <div class="login_container">
        <div class="login_parent">
            <h1>Reset Password</h1>
            <br>

            
            <form action="" method="POST">
                <div class="">
                    <h4>Type your new password</h4>
                    <input type="password" id="password" class="form-control" name="password" required autofocus>
                    <!-- <i class="bi bi-eye-slash" id="togglePassword"></i> -->
                </div>

                <br>

                <button type="submit" name="reset" class="btn">Submit</button>
            </form>

        </div>
    </div>



    <?php
    if(isset($_POST["reset"])){
        include './server/conn.php';
        $password = mysqli_real_escape_string($conn,$_POST["password"]);

        $token = $_SESSION['token'];
        $Email = $_SESSION['email'];

        $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_email='$Email'");
        $query = mysqli_num_rows($sql);
        $fetch = mysqli_fetch_assoc($sql);

        if($query){
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $new_pass = $hash;
            $query = mysqli_query($conn, "UPDATE users SET user_password = '$new_pass' WHERE user_email='$Email' ");

            if($query){
                ?>
                <script>
                    alert("<?php echo "your password has been succesful reset"?>");
                    window.location.replace("./login.php");
                </script>
                <?php
            }

        }else{
            ?>
            <script>
                alert("<?php echo "Please try again"?>");
            </script>
            <?php
        }
    }

?>


    <?php
        include "./partials/footer.php";
    ?>




    
</body>
</html>