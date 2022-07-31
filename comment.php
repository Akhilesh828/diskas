<!DOCTYPE html>
<html lang="en">
<?php
include "partials/_links.php";
?>
<title>Comment</title>
<?php
session_start();
include "./components/without_login.php";
include "./server/conn.php";
include "./partials/navbar.php";
?>

<link rel="stylesheet" href="./comment.css" />

<body>

    <?php
    $threadlist_id = $_GET['threadlist_id'];

    if(!$threadlist_id>0){
        ?>
        <script>
            window.location.href="./index.php";
        </script>
        <?php
    }

    $sql = "select * from threadlist where threadlist_id = '$threadlist_id' ";
    $query = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($query)) {
        $threadlist_id = $row["threadlist_id"];
        $threadlist_title = $row["threadlist_title"];
        $threadlist_description = $row["threadlist_description"];
        $threadlist_title_id = $row["threadlist_title_id"];
        // $threadlist_description = nl2br($threadlist_description);
        $threadlist_views = $row['threadlist_views'];
    }
    ?>

    <?php

    $_SESSION["views"] = $threadlist_views;

    if (isset($_SESSION["views"])) {
        $_SESSION['views']++;
    } else {
        $_SESSION['views'] = 1;
    }
    $views = $_SESSION['views'];

    $sql = "update threadlist set threadlist_views = '$views' where threadlist_title = '$threadlist_title' ";
    $query = mysqli_query($conn, $sql);

    ?>


    <?php
    if (isset($_POST['submit'])) {
        $comment_content = mysqli_real_escape_string($conn, $_POST['comment_content']);

        if (!empty(trim($comment_content))) {

            $sql = "insert into comment(comment_content,comment_title_id,comment_threadlist_id,comment_user_id)
                values('$comment_content','$threadlist_title_id','$threadlist_id','$login_id')";

            $query = mysqli_query($conn, $sql);

            if ($query) {
            ?>
                <script>
                    alert("comment inserted");
                    history.back();
                </script>
            <?php
            }

            die();
        } else {
            ?>
            <script>
                alert("plz enter valid details");
            </script>
    <?php
        }
    }

    ?>

    <?php
    $sql = "select * from bmark where bmark_user_id = '$login_id' && bmark_threadlist_id = '$threadlist_id' ";
    $query = mysqli_query($conn, $sql);
    if ($num = mysqli_num_rows($query)) {
        $row = mysqli_fetch_assoc($query);
        $mark = $row['bmark_threadlist_id'];
        if ($mark) {
            $bookmark = 'style="color: blue"';
        } else {
            $bookmark = '';
        }
    } else {
        $bookmark = '';
    }
    ?>


    <div class="block"></div>
    <!-- style="color: blue;" -->

    <div class="threadList_container">
        <div class="threadList_comment">
            <h2><?php echo $threadlist_title ?></h2>
            <div class="bookmark"><a href="./bookmark.php?id=<?php echo $threadlist_id ?>"><i <?php echo $bookmark ?> class="fa-solid fa-bookmark"></i></a></div>
            <hr>
            <div class="description">
                <p><?php echo $threadlist_description ?></p>
            </div>
        </div>
        <div class="threadList_parent">
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true && $_SESSION['is_verified'] === "yes") {
            ?>
                <h1>Comment</h1>

                <div class="threadList_discussion">
                    <form action="" method="POST">
                        <textarea name="comment_content" id="editor" cols="30" rows="10"></textarea>
                        <button class="btn" name="submit" type="submit">submit</button>
                    </form>
                </div>

            <?php
            } else {
                ?>
                <div class="threadList_discussion">
                    <form action="" method="">
                    <?php
                        if($_SESSION['is_verified'] === "no"){
                            echo '<h3 id="plz_login">Please verified your account ! </h3>
                            
                            <h3 id="plz_login">Check your email !!! </h3>';
                        }else{
                            echo'<h3 id="plz_login">Please login before asking your question !!! </h3>';
                        }
                    ?>
                    </form>
                </div>
                <?php

            }


            ?>

            <div class="threadList_details_comment">
                <!-- <div class="left_detail"></div> -->
                <div class="middle_detail">
                    <h1>Answers</h1>
                    <?php
                    $sql = "select * from comment where comment_threadlist_id = '$threadlist_id' order by comment_id desc ";
                    $query = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($query);
                    if ($num) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $comment_id = $row['comment_id'];
                            $comment_content = $row['comment_content'];
                            // $comment_content = str_replace("<br>","",$comment_content);
                            // $comment_content = nl2br($comment_content);
                            $comment_curr_time = $row['comment_curr_time'];
                            $comment_user_id = $row['comment_user_id'];
                            $comment_likes = $row['comment_likes'];
                            $comment_dislikes = $row['comment_dislikes'];

                            $sql2 = "select * from users where user_id = '$comment_user_id' ";
                            $query2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($query2);
                            $user_id = $row2['user_id'];
                            $user_name = $row2['user_name'];
                            $user_role = $row2['user_role'];
                    ?>


                            <!--//?  --- like display blue button -->
                            <?php
                            $sql4 = "select * from likes where like_user_id = '$login_id' && like_comment_id = '$comment_id' ";
                            $query4 = mysqli_query($conn, $sql4);
                            if ($num = mysqli_num_rows($query4)) {
                                if ($query4) {
                                    $like = 'style="color: blue"';
                                } else {
                                    $like = '';
                                }
                            } else {
                                $like = '';
                            }
                            ?>
                            <?php
                            $sql5 = "select * from likes where dislike_user_id = '$login_id' && dislike_comment_id = '$comment_id' ";
                            $query5 = mysqli_query($conn, $sql5);
                            if ($num = mysqli_num_rows($query5)) {
                                if ($query5) {
                                    $dislike = 'style="color: blue"';
                                } else {
                                    $dislike = '';
                                }
                            } else {
                                $dislike = '';
                            }
                            ?>

                            <?php 
                            //?------ icons ---------
                            include "./icons/icons.php";
                            ?>

                            <div class="column_comment">
                                <div class="question">
                                    <a href="./othersprofile.php?id=<?php echo $user_id ?>"> <div><?php echo $user_name ?> 
                                    
                                    <?php echo $comment_icons ?> <?php echo $threadlist_like_icons ?> <?php echo $comment_like_icons ?>
                                    </div></a>
                                    <div class="description">
                                        <p><?php echo $comment_content ?></p>
                                    </div>
                                    <div class="likes">
                                        <a href="./likesystem/comment_like.php?id=<?php echo $comment_id ?> "><i <?php echo $like ?> class="fas fa-thumbs-up"></i><span class="icons"><?php echo $comment_likes ?></span></a>
                                        <a href="./likesystem/comment_dislike.php?id=<?php echo $comment_id ?> "><i <?php echo $dislike ?> class="fa-solid fa-thumbs-down"></i><span class="icons"> <?php echo $comment_dislikes ?> </span></a>
                                    </div>
                                </div>
                                <?php


                                //? for deleting threaldist auth

                                if ($_SESSION['user_role'] === "regular") {

                                    if ($comment_user_id === $login_id) {
                                    ?>
                                        <div class="delete"><a href="./delete/delete_comment.php?comment_id=<?php echo $comment_id ?> ">
                                                <i class="fa-solid fa-trash-can"></i></a>
                                        </div>
                                        <div class="edit"><a href="./edit_comment.php?id= <?php echo $comment_id ?> ">
                                                <i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                    <?php
                                    } else {
                                        echo ' ';
                                    }
                                } else if ($_SESSION['user_role'] === "moderator") {
                                    $sql4 = "select * from users where user_id = '$comment_user_id'  ";
                                    $query4 = mysqli_query($conn, $sql4);
                                    $row = mysqli_fetch_assoc($query4);
                                    $user_role = $row['user_role'];
                                    // echo $user_role;

                                    if ($user_role === "moderator" || $user_role === "regular") {
                                        ?>
                                        <div class="delete"><a href="./delete/delete_comment.php?comment_id=<?php echo $comment_id ?> ">
                                                <i class="fa-solid fa-trash-can"></i></a>
                                        </div>
                                        <div class="edit"><a href="./edit_comment.php?id= <?php echo $comment_id ?> ">
                                                <i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                    <?php
                                    } else {
                                        echo ' ';
                                    }
                                } else {

                                    ?>
                                        <div class="delete"><a href="./delete/delete_comment.php?comment_id=<?php echo $comment_id ?> ">
                                                <i class="fa-solid fa-trash-can"></i></a>
                                        </div>
                                        <div class="edit"><a href="./edit_comment.php?id= <?php echo $comment_id ?> ">
                                                <i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                    <?php
                                }



                                echo '
                                <div class="time">
                                    <p>' . $comment_curr_time . '</p>
                                </div>
                            </div>
                            ';
                            }
                        } else {
                            echo '
                        <div class="column_comment">
                        <form action="" method="POST">
                        <h3 id="plz_answer" > Be the first to comment here !!! </h3>
                        </form>
                        </div>
                        ';
                        }


                        ?>

                            </div>
                            <!-- <div class="right detail"></div> -->


                </div>
            </div>
        </div>


        <?php
        include "./partials/footer.php"

        ?>


        <script>
            CKEDITOR.replace('editor');
        </script>
        <!-- <i class="fa-duotone fa-star-of-life"></i> -->
        <!-- <i class="fa-solid fa-star-of-life"></i> -->
        <!-- <i class="fa-brands fa-galactic-republic"></i> -->
        <!-- <i class="fa-solid fa-sparkles"></i> -->
        <!-- <i class="fa-solid fa-cannabis"></i> -->
        <!-- <i class="fa-solid fa-fan"></i> -->


        <!-- 
<i style="color: orange; font-size:20px"  class="fa-brands fa-ethereum"></i>
<i style="color: blue; font-size:20px" class="fa-brands fa-sketch"></i>
<i style="color: red; font-size:25px" class="fa-brands fa-centos"></i>
<i class="fa-solid fa-jedi"></i>
<i style="color: black; font-size:20px" class="fa-solid fa-user-secret"></i>  -->


</body>

</html>