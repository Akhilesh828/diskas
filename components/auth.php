<?php
session_start();

include_once "../server/conn.php";


// $sql = "select * from users where user_email = '$loginemail' ";
// $query = mysqli_query($conn,$sql);
// $result = mysqli_num_rows($query);


            
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true && $_SESSION['is_verified'] === 1 ){
        $login_id = $_SESSION['loginid'];
        
    }else{
        $login_id = 0;
        
        $_SESSION['user_role'] = "regular";
        
        ?>
        <script>
            alert('Youer account is not verified, plz check your email');
            window.location.href="./index.php";
        </script>
        <?php
    }
    
    
?>