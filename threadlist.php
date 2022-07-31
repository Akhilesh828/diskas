<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "./server/conn.php";
include "./partials/_links.php";
include "./partials/navbar.php";

?>

<body>
    <title>threadlist</title>
    <link rel="stylesheet" href="./threadlist.css?1" />
    <!-- <link rel="stylesheet" href="./th.css"/> -->

    <?php
        include "./components/without_login.php";
    ?>

    <?php
    $title_id = $_GET['title_id'];

    //if a user try to access this page it will redirect to index


    $sql = "select * from titles where title_id = '$title_id' ";
    $query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($query)){
        $title_topic = $row["title_topic"];
        $title_description = $row["title_description"];
    }
    ?>

    <?php
    if(isset($_POST['submit'])){
        $threadlist_title = mysqli_real_escape_string($conn, $_POST['threadlist_title']);
        $threadlist_title = str_replace("<","&lt", $threadlist_title);
        $threadlist_title = str_replace(">","&gt", $threadlist_title);
        $threadlist_description = mysqli_real_escape_string($conn, $_POST['threadlist_description']);
        if(!empty(trim($threadlist_title)) && !empty(trim($threadlist_description))){
            $sql = "insert into threadlist(threadlist_title,threadlist_description,threadlist_title_id,threadlist_user_id)
                values('$threadlist_title','$threadlist_description','$title_id','$login_id')";
            $query = mysqli_query($conn, $sql);
            if($query){
            ?>
                <script>
                    alert("threadlist inserted");
                    history.back();
                </script>
            <?php
                die();
            }
        }else{
            ?>
            <script>
                alert("plz enter valid details");
            </script>
            <?php
        }
    }
    ?>


    <div class="block"></div>

    <div class="threadList_container">
        <div class="threadList_pro">
            <h2><?php echo $title_topic; ?></h2>
            <hr>
            <p><?php echo $title_description ?></p>
            <button class="btn"><a href="<?php echo "https://en.wikipedia.org/wiki/$title_topic" ?>">Know More</a></button>
        </div>
        <div class="threadList_parent">
            <?php
                
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true && $_SESSION['is_verified'] === "yes" ){
            ?>
                <h1>Start Discussion</h1>

                <div class="threadList_discussion">
                    <form action="" method="POST">
                        <input type="text" name="threadlist_title" class="text" placeholder="Ask your q">
                        <textarea name="threadlist_description" id="editor" cols="30" rows="10"></textarea>
                        <button class="btn" name="submit" type="submit">submit</button>
                    </form>
                </div>

            <?php

            } else {
                ?>
                <div class="threadList_discussion">
                    <form action="" method="POST">
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

            <div class="threadList_details">
                <!-- <div class="left_detail"></div> -->
                <div class="middle_detail">
                    <h2>Browser Question</h2>

                    <?php
                    $sql = "select * from threadlist where threadlist_title_id = '$title_id' order by threadlist_id desc  ";
                    $query = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($query);
                    // echo $num;
                    if ($num) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $threadlist_id = $row['threadlist_id'];
                            $threadlist_title = $row['threadlist_title'];
                            $threadlist_description = $row['threadlist_description'];
                            // $threadlist_description = nl2br($threadlist_description);

                            $threadlist_curr_time = $row['threadlist_curr_time'];
                            $threadlist_user_id = $row['threadlist_user_id'];
                            $threadlist_likes = $row['threadlist_likes'];
                            $threadlist_dislikes = $row['threadlist_dislikes'];
                            $threadlist_views = $row['threadlist_views'];

                            // ?Authore name
                            $sql2 = "select user_name from users where user_id = '$threadlist_user_id' ";
                            $query2 = mysqli_query($conn, $sql2);

                            if(!$query2){
                                $user_name = "unknown";
                            }else{
                                $row2 = mysqli_fetch_assoc($query2);
                                $user_name = $row2['user_name'];
                            }
                            // echo $user_name;
                            // print_r($user_name);


                            // ?comments
                            $sql3 = "select * from comment where comment_threadlist_id = '$threadlist_id' order by comment_id desc ";
                            $query3 = mysqli_query($conn, $sql3);
                            $threadlist_comment = mysqli_num_rows($query3);

                            // echo $num3;
                            ?>
                            <!--//?  --- like display blue button -->
                            <?php
                            $sql4 = "select * from likes where like_user_id = '$login_id' && like_threadlist_id = '$threadlist_id' ";
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
                            $sql5 = "select * from likes where dislike_user_id = '$login_id' && dislike_threadlist_id = '$threadlist_id' ";
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

                            <div class="column">
                                <div class="question">
                                    <a href="comment.php?threadlist_id=<?php echo $threadlist_id ?>">
                                        <div><?php echo $threadlist_title ?></div>
                                    </a>
                                    <div class="description">
                                        <p><?php echo $threadlist_description ?></p>
                                    </div>
                                    <div class="likes">
                                        <a href="./likesystem/threadlist_like.php?id=<?php echo $threadlist_id ?> "><i <?php echo $like ?> class="fas fa-thumbs-up"></i><span class="icons"><?php echo $threadlist_likes ?></span></a>
                                        <a href="./likesystem/threadlist_dislike.php?id=<?php echo $threadlist_id ?> "><i <?php echo $dislike ?> class="fa-solid fa-thumbs-down"></i><span class="icons"> <?php echo $threadlist_dislikes ?> </span></a>
                                        <a href="javascript:void(0)"><i class="fas fa-eye"></i><span class="icons"><?php echo $threadlist_views ?> </span></a>
                                        <a href="javascript:void(0)"><i class="fas fa-pen-square"></i><span class="icons"><?php echo $threadlist_comment ?></span></a>
                                    </div>
                                </div>
                                <?php


                                //?----------------- for deleting threadist auth -----------------------
                                if ($_SESSION['user_role'] === "regular") {

                                    if ($threadlist_user_id === $login_id) {
                                    ?>
                                        <div class="delete"><a href="./delete/delete_threadlist.php?threadlist_id= <?php echo $threadlist_id ?> ">
                                                <i class="fa-solid fa-trash-can"></i></a>
                                        </div>
                                        <div class="edit"><a href="./edit_threadlist.php?id= <?php echo $threadlist_id ?> ">
                                                <i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                    <?php
                                    } else {
                                        echo ' ';
                                    }
                                } else if ($_SESSION['user_role'] === "moderator") {

                                    /* -------------------------------------------------------------------------- */
                                    $sql4 = "select * from users where user_id = '$threadlist_user_id'  ";
                                    $query4 = mysqli_query($conn, $sql4);
                                    $row = mysqli_fetch_assoc($query4);
                                    $user_role = $row['user_role'];

                                    //? for deleting threaldist auth

                                    if ($user_role === "moderator" || $user_role === "regular") {
                                    ?>
                                        <div class="delete"><a href="./delete/delete_threadlist.php?threadlist_id= <?php echo $threadlist_id ?> ">
                                                <i class="fa-solid fa-trash-can"></i></a>
                                        </div>
                                        <div class="edit"><a href="./edit_threadlist.php?id= <?php echo $threadlist_id ?> ">
                                                <i class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                    <?php
                                    } else {
                                        echo ' ';
                                    }
                                } else if ($_SESSION['user_role'] === "admin") {

                                    ?>
                                    <div class="delete"><a href="./delete/delete_threadlist.php?threadlist_id=<?php echo $threadlist_id ?> ">
                                        <i class="fa-solid fa-trash-can"></i> </a>
                                    </div>
                                    <div class="edit"><a href="./edit_threadlist.php?id= <?php echo $threadlist_id ?> ">
                                        <i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>

                                <?php
                                    /* -------------------------------------------------------------------------- */
                                }else{
                                    
                                }
                                ?>

                                <div class="time">
                                    <p>asked by<b> <?php echo $user_name ?></b></p>
                                    <p> <?php echo $threadlist_curr_time ?></p>
                                </div>
                            </div>
                        <?php
                        }
                    }else{
                        ?>
                        <div class="column_comment">
                            <form action="" method="POST">
                                <h3 id="plz_answer"> Be the first to Ask here !!! </h3>
                            </form>
                        </div>
                        <?php
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

    <!-- <script src="./js/jquery-1.11.1.min.js"></script> -->

    <script>
        CKEDITOR.replace('editor');
    </script>

</body>

</html>