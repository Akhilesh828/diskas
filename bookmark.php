<?php
session_start();
include "./server/conn.php";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
    $login_id = $_SESSION['loginid'];

    $threadlist_id = $_GET['id'];
    //if a user try to access this page it will redirect to index
    if(!$threadlist_id>0){
        ?>
        <script>
            window.location.href="./index.php";
        </script>
        <?php
    }

    $sql = "select * from bmark where bmark_user_id = '$login_id' && bmark_threadlist_id = '$threadlist_id' ";
    $query = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($query);

    if (!$num) {
        $sql2 = "insert into bmark(bmark_user_id,bmark_threadlist_id) values('$login_id','$threadlist_id') ";
        $query2 = mysqli_query($conn, $sql2);
    } else {
    ?>
        <Script>
            alert("already added");
        </Script>
    <?php
    }
    ?>
    <Script>
        history.back();
    </Script>
<?php

} else {
    // $login_id = 0;

    $_SESSION['user_role'] = "regular";
    header("Location: http://localhost/forum/4/login.php");
}


?>