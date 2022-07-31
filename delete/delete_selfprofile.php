<?php
include "../server/conn.php";

    $user_id = $_GET['user_id'];
    // $title_id = $_GET['title_id'];

    $sql = "delete from users where user_id = '$user_id' ";
    $query = mysqli_query($conn, $sql);

    $sql2 = "delete from threadlist where threadlist_user_id = '$user_id'";
    $query2 = mysqli_query($conn,$sql2);

    $sql3 = "delete from comment where comment_user_id = '$user_id'";
    $query3 = mysqli_query($conn,$sql3);

    $sql4 = "delete from bmark where bmark_user_id = '$user_id'";
    $query4 = mysqli_query($conn,$sql4);

    $sql5 = "delete from likes where like_user_id = '$user_id'";
    $query5 = mysqli_query($conn,$sql5);

    include '../logout.php';

    mysqli_close($conn);
    
?>

<script>
    alert("deleted")
    // window.location.href='./login.php';
</script>