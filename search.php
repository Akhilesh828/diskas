<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<title>Search</title>
<link rel="stylesheet" href="./search.css" />

<body>
    <?php
    include "./server/conn.php";
    include "./partials/_links.php";
    include "./partials/navbar.php";
    ?>


    <div class="threadList_container">

        <div class="threadList_details">
            <div class="middle_detail">
                <h2>Search result for <em>" <?php echo $_GET['search'] ?> "</em></h2>
                <br><br>
                <?php

                $searched = $_GET["search"];
                // $sql = "select * from threadlist where match (threadlist_title, threadlist_description) against ('$searched') order by threadlist_id desc";
                $sql = "select * from threadlist where threadlist_title REGEXP '$searched' || threadlist_description REGEXP '$searched' ";


                $query = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($query);
                if ($num > 0) {

                    while ($row = mysqli_fetch_assoc($query)) {
                        $threadlist_id = $row['threadlist_id'];
                        $threadlist_title = $row['threadlist_title'];
                        $threadlist_description = $row['threadlist_description'];

                        $url = "comment.php?threadlist_id=" . $threadlist_id;

                        echo '
                        <div class="column">
                            <div class="question">
                            <a href="' . $url . '"><div>' . $threadlist_title . '</div></a>
                                <div class="description">
                                    <p>' . $threadlist_description . '</p>
                                </div>
                            </div>

                        </div>
                            ';
                    }
                } else {
                ?>
                    <div class="column">
                        <div class="question">
                            <h3>No result found</h3>
                            <p>
                            <ul>Suggestions:
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords.</li>
                            </ul>
                            </p>
                        </div>
                    </div>
                <?php
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