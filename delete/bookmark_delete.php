<?php
    session_start();
    include "../server/conn.php";
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true){
        $login_id = $_SESSION['loginid'];
        
        }else{
        $login_id = 0;
        header("Location: http://localhost/forum/4/login.php");
        }
    
        $threadlist_id = $_GET['id'];

    $sql = "delete from bmark where bmark_threadlist_id = '$threadlist_id' && bmark_user_id = '$login_id'";
    $query = mysqli_query($conn,$sql);
    
?>
<script>
    history.back();
</script>