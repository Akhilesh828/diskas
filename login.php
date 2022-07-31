<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    
    include "./server/conn.php";
    include "./partials/_links.php";
    include "./partials/navbar.php";
?>


<title>login</title>

<link rel="stylesheet" href="./login.css"/>

<body>
    
<?php
    $_SESSION['is_verified'] = false;
    // $_SESSION['user_role'] = regular;



        
        if(isset($_POST['submit'])){
            $loginemail = mysqli_real_escape_string($conn, $_POST['loginemail']);
            $loginpassword = mysqli_real_escape_string($conn, $_POST['loginpassword']);

            $sql = "select * from users where user_email = '$loginemail' ";
            $query = mysqli_query($conn,$sql);
            $result = mysqli_num_rows($query);

            if($row = mysqli_fetch_assoc($query)){
            $db_password = $row['user_password'];

                $verify = password_verify($loginpassword,$db_password);

                if($verify){
                    $_SESSION['email'] = "$loginemail";
                    $_SESSION['loggedin'] = true;
                    $_SESSION['loginid'] = $row['user_id'];
                    $_SESSION['loginname'] = $row['user_name'];
                    $_SESSION['user_role'] = $row['user_role'];
                    $_SESSION['is_verified'] = $row['is_verified'];

                    // if($_SESSION['user_role'] === "admin"){
                    //     echo "addddddddddddd";
                    // }else{
                    //     echo "reeeeee";
                    // }


                
                    ?>
                    
                    <script>
                        alert('login');

                        window.location.href="./index.php";
                    </script>
                    <?php


                }else{
                    ?>
                    <script>
                        alert('password is incorrect');
                    </script>
                    <?php
                }
            }else{
                ?>
                <script>
                    alert('email not exist');
                </script>
                <?php
            }


        }


        // //? --- remember me ---
        // $loginemail = '';
        // $loginpassword = '';
        // $set_remember = "";

        // if(isset($_COOKIE['loginemail']) && isset($_COOKIE['loginpassword'])){
        //     $loginemail = $_COOKIE['loginemail'];
        //     $loginpassword = $_COOKIE['loginpassword'];
        //     $set_remember = "checked='checked'";
        // }

        
        
    ?>
    <div class="login_container">
        <div class="login_parent">
            <h1>Login Form</h1>
            <form action="" method="POST">

                <div class="">
                    <h4>User Email</h4>
                    <input type="email" name="loginemail" placeholder="Enter your email" >    
                </div>
                <div class="">
                    <h4>Password</h4>
                    <input type="password" name="loginpassword" placeholder="Type your password" >
                </div>

                <br>

                <button type="submit" name="submit" class="btn">Login</button>
            </form>

            <h3><a href="./password_recover.php">forget password ?</a></h3>
            <h3><a href="./signup.php">signup</a></h3>
            
        </div>
    </div>






    <?php
        include "./partials/footer.php";
        
        
    ?>

    
</body>
</html>