<?php
include "../server/conn.php";
    
    $comment_id = $_GET['comment_id'];

    $sql = "delete from comment where comment_id = '$comment_id' ";
    $query = mysqli_query($conn, $sql);

    $sql2 = "delete from likes where like_comment_id = '$comment_id' ";
    $query2 = mysqli_query($conn, $sql2);

    $sql3 = "delete from likes where dislike_comment_id = '$comment_id' ";
    $query3 = mysqli_query($conn, $sql3);

    mysqli_close($conn);
    
?>

<script>
    alert("deleted")
    // prompt("are u sure");
    history.back();
    // history.go(-2);
</script>