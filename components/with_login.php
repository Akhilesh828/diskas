<?php


    

    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true){
        $login_id = $_SESSION['loginid'];
        
    }else{
        $login_id = 0;
        $_SESSION['user_role'] = "regular";
        ?>
        <script>
            alert('login');
            window.location.href="./login.php";
        </script>
        <?php
        
    }
    
    
?>


