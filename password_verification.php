<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    
    include "./server/conn.php";
    include "partials/_links.php";
    include "./partials/navbar.php";
?>


<title>Verification</title>

<link rel="stylesheet" href="./login.css"/>


<body>
    

        
    <div class="login_container">
        <div class="login_parent">
            <h1>Verification</h1>
            <br>
            <br>
            <br>
            
            <form action="" method="POST">
                <div class="">
                    <h4>OTP code</h4>
                    <input type="text" id="otp" class="form-control" name="otp_code" required autofocus> 
                </div>

                <br>

                <button type="submit" name="verify" class="btn">Submit</button>
            </form>

        </div>
    </div>



<?php
    
    include('./server/conn.php');
    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp_code'];

        if($otp != $otp_code){
            ?>
            <script>
                alert("Invalid OTP code");
            </script>
            <?php
        }else{
            mysqli_query($conn, "UPDATE users SET is_verified = 'yes' WHERE user_email = '$email'");
            ?>
            <script>
                alert("Verfiy account done, you may sign in now");
                window.location.replace("./login.php");
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