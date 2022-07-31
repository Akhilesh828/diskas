
<?php
// ? ----- user comment number icons ----------------

$sql3 = "select comment_id from comment where comment_user_id = '$comment_user_id' ";
$query3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($query3);
$comment = mysqli_num_rows($query3);
// echo $num;

if ($user_role === "admin") {
    $comment_icons = '<i style="color:#fc7703; font-size:20px" class="fa-solid fa-jedi"></i>';
} elseif ($user_role === "moderator") {
    $comment_icons = '<i style="color: black; font-size:20px" class="fa-solid fa-user-secret"></i>';
} elseif ($comment > 5) {
    $comment_icons = '<i style="color: red; font-size:20px" class="fa-brands fa-redhat"></i>';
} elseif ($comment > 3) {
    $comment_icons = '<i style="color: blue; font-size:20px" class="fa-brands fa-redhat"></i>';
} elseif ($comment > 1) {
    $comment_icons = '<i style="color: #80fc; font-size:20px" class="fa-brands fa-redhat"></i>';
} else {
    $comment_icons = "";
}

$comment_no_count = $comment;


?>

<?php
// ? ----- user threadlist likes icons ----------------

$sql8 = "select SUM(threadlist_likes) from threadlist where threadlist_user_id = '$comment_user_id' ";
$query8 = mysqli_query($conn, $sql8);
$threadlist = mysqli_fetch_assoc($query8);
// print_r($threadlist);
// echo implode("",$threadlist);
$threadlist = implode("", $threadlist);
if ($user_role === "admin" || $user_role === "moderator") {
    $threadlist_like_icons = "";
} else {
    if ($threadlist > 5) {
        $threadlist_like_icons = '<i style="color: red; font-size:25px" class="fa-brands fa-centos"></i>';
    } elseif ($threadlist > 3) {
        $threadlist_like_icons = '<i style="color: blue; font-size:20px" class="fa-brands fa-sketch"></i>';
    } elseif ($threadlist > 1) {
        $threadlist_like_icons = '<i style="color: #80fc; font-size:20px"  class="fa-brands fa-ethereum"></i>';
    } else {
        $threadlist_like_icons = "";
    }
}

$threadlist_like_count = $threadlist;



?>

<?php
// ? ----- user comment likes icons ----------------

$sql9 = "select SUM(comment_likes) from comment where comment_user_id = '$comment_user_id' ";
$query9 = mysqli_query($conn, $sql9);
$comment_like = mysqli_fetch_assoc($query9);
// print_r($comment);
// echo implode("",$comment_like);
$comment_like = implode("", $comment_like);
if ($user_role === "admin" || $user_role === "moderator") {
    $comment_like_icons = "";
} else {
    if ($comment_like > 5) {
        $comment_like_icons = '<i style="color: red; font-size:25px" class="fa-solid fa-cannabis" ></i>';
    } elseif ($comment_like > 3) {
        $comment_like_icons = '<i style="color: blue; font-size:20px"  class="fa-solid fa-fan"></i>';
    } elseif ($comment_like > 1) {
        $comment_like_icons = '<i style="color: #80fc; font-size:20px" class="fa-brands fa-battle-net"></i>';
    } else {
        $comment_like_icons = "";
    }
}

$comment_like_count = $comment_like;


?>
<!-- <i class="fa-brands fa-battle-net"></i> -->