<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include "partials/_links.php";
include "server/conn.php";
include "./partials/navbar.php";
?>

<title>Signup</title>
<link rel="stylesheet" href="./signup.css" />

<body>

    <?php
    // if ($_SESSION['loggedin']) {
    ?>
    <script>
        // window.location.href = "./index.php";
    </script>
    <?php
    // }
    ?>


    <?php

    include "server/conn.php";

    if (isset($_POST['submit'])) {
        $signupname = mysqli_real_escape_string($conn, $_POST['signupname']);
        $signupemail = mysqli_real_escape_string($conn, $_POST['signupemail']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

        $find = "select * from users where user_email = '$signupemail' ";
        $query = mysqli_query($conn, $find);
        $result = mysqli_num_rows($query);


        if (!empty(trim($signupemail)) && !empty(trim($signupname))  && !empty(trim($password))) {

            if (strlen($signupname) < 15) {

                if (!$result) {

                    if ($password === $cpassword) {
                        $hash = password_hash($password, PASSWORD_BCRYPT);
                        $insert = "insert into users(user_name,user_email,user_password) values('$signupname','$signupemail','$hash')";
                        $query = mysqli_query($conn, $insert);

                        if ($query) {

                            $otp = rand(100000, 999999);
                            $_SESSION['otp'] = $otp;
                            $_SESSION['mail'] = $signupemail;
                            require "Mail/phpmailer/PHPMailerAutoload.php";
                            $mail = new PHPMailer;

                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->Port = 587;
                            $mail->SMTPAuth = true;
                            $mail->SMTPSecure = 'tls';

                            $mail->Username = 'diskas2022@gmail.com';
                            $mail->Password = 'Machoman21@!';

                            $mail->setFrom('diskas2022@gmail.com', 'OTP Verification');
                            $mail->addAddress($_POST["signupemail"]);

                            $mail->isHTML(true);
                            $mail->Subject = "Your verify code";
                            $mail->Body = "<p>Dear user, </p> <h3>Your verification OTP code is $otp <br></h3>
                        <br><br>
                        <p>With regrads,</p>
                        <b>Team Diskas</b>";

                            if (!$mail->send()) {
                            ?>
                                <script>
                                    alert("<?php echo "Register Failed, Invalid Email " ?>");
                                </script>
                            <?php
                            } else {
                            ?>
                                <script>
                                    alert("<?php echo "Register Successfully, OTP sent to " . $signupemail ?>");
                                    window.location.replace('./password_verification.php');
                                </script>
                            <?php
                            }
                            ?>
                            <script>
                                alert('data inserted');
                                window.location.href = "./login.php";
                            </script>
                        <?php

                        } else {
                        ?>
                            <script>
                                alert('not inserted');
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script>
                            alert('password is incorrect');
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        alert('email already exist');
                    </script>
            <?php
                }
            }else{
                ?>
                <script>
                    alert('User name should be less than 14 character !');
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert('please enter valid details');
            </script>
    <?php
        }
    }
    ?>



    <div class="signup_container">
        <div class="signup_parent">
            <h1>Signup Form</h1>
            <form action="" method="POST">
                <div class="">
                    <h4>Username</h4>
                    <input type="text" name="signupname" placeholder="Type of username">
                </div>
                <div class="">
                    <h4>Email</h4>
                    <input type="email" name="signupemail" placeholder="Type of Email">
                </div>
                <div class="">
                    <h4>Password</h4>
                    <input type="password" name="password" placeholder="Type your password">
                </div>
                <div class="">
                    <h4>Confirm Password</h4>
                    <input type="password" name="cpassword" placeholder="Confirm password">
                </div>
                <br>

                <button type="submit" name="submit" class="btn">Signup</button>
            </form>

            <h3><a href="./login.php">Login</a></h3>

        </div>
    </div>

    <?php

    include "./partials/footer.php";

    //dvwveve

    ?>


</body>

</html>