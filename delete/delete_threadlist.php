<?php
include "../server/conn.php";
    
    $threadlist_id = $_GET['threadlist_id'];
    // $title_id = $_GET['title_id'];

    $sql = "delete from threadlist where threadlist_id = '$threadlist_id' ";
    $query = mysqli_query($conn, $sql);

    $sql2 = "delete from comment where comment_threadlist_id = '$threadlist_id' ";
    $query2 = mysqli_query($conn, $sql2);

    $sql3 = "delete from bmark where bmark_threadlist_id = '$threadlist_id' ";
    $query3 = mysqli_query($conn, $sql3);

    $sql5 = "delete from likes where like_threadlist_id = '$threadlist_id' or dislike_threadlist_id = '$threadlist_id' ";
    $query5 = mysqli_query($conn, $sql5);

    mysqli_close($conn);
    
?>

<script>
    alert("deleted")
    
    // if(prompt("are u sure")){
    // }
    history.back();
    // history.go(-2);
</script>