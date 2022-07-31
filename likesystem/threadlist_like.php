<?php
session_start();

    include "../server/conn.php";

    $threadlist_id = $_GET['id'];
    // echo $threadlist_id;

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true){
        $login_id = $_SESSION['loginid'];

        $sql = "select * from likes where like_threadlist_id = '$threadlist_id' && like_user_id = '$login_id'";
        $query = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($query);
        
        if(!$num){
            $sql2 = "insert into likes(like_user_id,like_threadlist_id) values('$login_id','$threadlist_id')";
            $query = mysqli_query($conn,$sql2);

            $sql3 = "update threadlist set threadlist_likes = threadlist_likes+1 where threadlist_id = '$threadlist_id'";
            $query = mysqli_query($conn,$sql3);

            /* -------------------------------------------------------------------------- */

            $sql = "select * from likes where dislike_threadlist_id = '$threadlist_id' && dislike_user_id = '$login_id'";
            $query = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($query);

            if($num){
                $sql6 = "delete from likes where dislike_threadlist_id = '$threadlist_id' && dislike_user_id = '$login_id' ";
                $query = mysqli_query($conn,$sql6);
    
                $sql7 = "update threadlist set threadlist_dislikes = threadlist_dislikes-1 where threadlist_id = '$threadlist_id'";
                $query = mysqli_query($conn,$sql7);
            }
    
        }else{
            $sql4 = "delete from likes where like_threadlist_id = '$threadlist_id' && like_user_id = '$login_id' ";
            $query = mysqli_query($conn,$sql4);

            $sql5 = "update threadlist set threadlist_likes = threadlist_likes-1 where threadlist_id = '$threadlist_id'";
            $query = mysqli_query($conn,$sql5);
        }
        
    }


    
?>

<script>
    history.back();
</script>