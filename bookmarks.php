<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<title>Bookmarks</title>
<link rel="stylesheet" href="./bookmarks.css"/>

<body>
    <?php
    include "./server/conn.php";
    include "./partials/_links.php";
    include "./partials/navbar.php";

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true){
        $login_id = $_SESSION['loginid'];
        
        }else{
        $login_id = 0;
        header("Location: http://localhost/forum/4/login.php");
        }

    ?>


    <div class="threadList_container">

    <div class="threadList_details">
        <div class="middle_detail">
                <br><br>
            <?php

            // $searched = $_GET["search"];

            $sql = "select * from bmark where bmark_user_id = '$login_id'";
            // $query = mysqli_query($conn, $sql);
            $query = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($query);
            if ($num>0) {
                // echo 'yeah';
                // echo $query;
                while ($row = mysqli_fetch_assoc($query)) {
                    $bmark_threadlist_id = $row['bmark_threadlist_id'];

                    $sql2 = "select * from threadlist where threadlist_id = '$bmark_threadlist_id'";
                    $query2 = mysqli_query($conn,$sql2);
                    $row = mysqli_fetch_assoc($query2);
                    $threadlist_id = $row['threadlist_id'];
                    $threadlist_title = $row['threadlist_title'];
                    $threadlist_description = $row['threadlist_description'];
                    $url = "comment.php?threadlist_id=". $threadlist_id;

                    ?>
                        <div class="column">
                            <div class="question">
                                <a href="<?php echo $url ?>"><h3> <?php echo $threadlist_title ?> </h3></a>
                                    <div class="bookmark" ><a href="./delete/bookmark_delete.php?id=<?php echo $threadlist_id ?>"><i class="fa-solid fa-bookmark"></i></a></div>

                                <div class="description">
                                    <p> <?php echo $threadlist_description ?></p>
                                </div>
                            </div>

                        </div>
                    <?php
                }
                // echo 'yeah2';

            }else{
                // echo 'yeah4';

            
                // echo"hello";
                echo '
                        <div class="column">
                        <div class="question">
                        <h3>No bookmark found !!!</h3>

                        </div>

                        </div>
                    ';
            }


            ?>


        </div>
    </div>

    </div>









    <?php
    include "./partials/footer.php";

    ?>
</body>

</html>