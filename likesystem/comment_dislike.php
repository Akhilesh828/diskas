<?php
session_start();

    include "../server/conn.php";

    $comment_id = $_GET['id'];
    // echo $comment_id;

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true){
        $login_id = $_SESSION['loginid'];

        $sql = "select * from likes where dislike_comment_id = '$comment_id' && dislike_user_id = '$login_id'";
        $query = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($query);
        
        if(!$num){
            $sql2 = "insert into likes(dislike_user_id,dislike_comment_id) values('$login_id','$comment_id')";
            $query = mysqli_query($conn,$sql2);

            $sql3 = "update comment set comment_dislikes = comment_dislikes+1 where comment_id = '$comment_id'";
            $query = mysqli_query($conn,$sql3);
            /* -------------------------------------------------------------------------- */

            $sql = "select * from likes where like_comment_id = '$comment_id' && like_user_id = '$login_id'";
            $query = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($query);

            if($num){
                $sql6 = "delete from likes where like_comment_id = '$comment_id' && like_user_id = '$login_id' ";
                $query = mysqli_query($conn,$sql6);

                $sql7 = "update comment set comment_likes = comment_likes-1 where comment_id = '$comment_id'";
                $query = mysqli_query($conn,$sql7);
            }
    
        }else{
            $sql4 = "delete from likes where dislike_comment_id = '$comment_id' && dislike_user_id = '$login_id' ";
            $query = mysqli_query($conn,$sql4);

            $sql5 = "update comment set comment_dislikes = comment_dislikes-1 where comment_id = '$comment_id'";
            $query = mysqli_query($conn,$sql5);

            // $sql6 = "update comment set comment_likes = comment_likes-1 where comment_id = '$comment_id'";
            // $query = mysqli_query($conn,$sql6);
        }
        
    }

    
?>

<script>
    history.back();
</script>