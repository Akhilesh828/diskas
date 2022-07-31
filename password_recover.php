<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    
    include "./server/conn.php";
    include "./partials/_links.php";
    include "./partials/navbar.php";
?>


<title>password recover</title>

<link rel="stylesheet" href="./login.css"/>


<body>
    


<div class="login_container">
        <div class="login_parent">
            <h1>Recover Password</h1>
            <br>

            
            <form action="" method="POST">
                <div class="">
                    <h4>Type your email</h4>
                    <input type="email" id="email_address" class="form-control" name="email" required autofocus>                    
                </div>

                <br>

                <button type="submit" name="recover" class="btn">Submit</button>
            </form>

        </div>
    </div>


    <?php 
    if(isset($_POST["recover"])){
        include('./server/conn.php');
        $email = $_POST["email"];

        $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("<?php  echo "Sorry, no emails exists "?>");
            </script>
            <?php
        }else if($fetch["is_verified"] == "no"){
            ?>
            <script>
                alert("Sorry, your account must verify first, before you recover your password !");
                window.location.replace("./index.php");
            </script>
            <?php
        }else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            //session_start ();
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // h-hotel account
            $mail->Username='diskas2022@gmail.com';
            $mail->Password='Machoman21@!';

            // send by h-hotel email
            $mail->setFrom('diskas2022@gmail.com', 'Password Reset');
            // get email from input
            $mail->addAddress($_POST["email"]);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Recover your password";
            $mail->Body="<b>Dear User</b>
            <h3>We received a request to reset your password.</h3>
            <p>Kindly click the below link to reset your password</p>
            http://localhost/forum/4/password_reset.php
            <p>If not requested then kindly avoid it</p>
            <br><br>
            <p>With regrads,</p>
            <b>Team Diskas</b>";

            if(!$mail->send()){
                ?>
                    <script>
                        alert("<?php echo " Invalid Email "?>");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        // window.location.replace("notification.html");
                        alert("check your email");
                        window.location.href ="./login.php";
                    </script>
                <?php
            }
        }
    }


?>

<!-- http://diskas.thewebsinfinity.com/password_reset.php -->



    <?php
        include "./partials/footer.php";
    ?>

    

    
</body>
</html>