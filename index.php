<!DOCTYPE html>
<html lang="en">

<title>DisKas - The Forum</title>
<link rel="stylesheet" href="./index.css" />

<body>
    <?php
    session_start();
    include "./server/conn.php";
    include "./partials/_links.php";
    include "./partials/navbar.php";
    ?>

<?php
include_once "./components/without_login.php";

// echo  $_SESSION['is_verified'];
?>

    <!-- //! <img src="https://source.unsplash.com/500x200/?'. $title_topic .',programming" alt="" /> -->

    <div class="block"></div>

    <div class="forum_container">
        <div class="row">
        <?php
            // echo $_SESSION['user_role']

        ?>
            <?php
            $sql = "select * from titles";
            $query = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($query)) {
                $title_id = $row['title_id'];
                $title_image = $row['title_image'];
                $title_topic = $row['title_topic'];
                $title_description = $row['title_description'];
                echo '<div class="pro_card">
                            <div class="pro_detail">
                                <div class="img">';
                                    echo'
                                    
                                    <img src="./admin/Titleimage/'.$title_image.'" alt=" '.$title_image.' " />
                                </div>
                                <div class="forum_title">
                                    <h2> <a href="threadlist.php?title_id=' . $title_id . ' ">' . $title_topic . '</a></h2>
                                    <p>
                                        ' . substr($title_description, 0, 250) . '....
                                    </p>
                                    
                                </div>
                            </div>
                    
                    </div>
                ';
            }
            ?>

        </div>
    </div>

    <?php
    include "./partials/footer.php"

    ?>
</body>

</html>