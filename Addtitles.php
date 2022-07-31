<!DOCTYPE html>
<html lang="en">
<?php
session_start();

include "./server/conn.php";
include "./partials/_links.php";

?>

<?php
include "./partials/navbar.php";



?>
<link rel="stylesheet" href="./threadlist.css" />

<body>
    <title>Addtitles</title>
    <?php



    if (isset($_FILES['imageupload'])) {
        $title_topic = mysqli_real_escape_string($conn, $_POST['title_topic']);
        $title_topic = str_replace("<", "&lt", $title_topic);
        $title_topic = str_replace(">", "&gt", $title_topic);

        $title_description = mysqli_real_escape_string($conn, $_POST['title_description']);
        $title_description = str_replace("<", "&lt", $title_description);
        $title_description = str_replace(">", "&gt", $title_description);

        /* -------------------------------------------------------------------------- */
        // if(isset($_FILES['imageupload'])){
            $errors = array();
    
            $file_name = $_FILES['imageupload']['name'];
            $file_size = $_FILES['imageupload']['size'];
            $file_tmp = $_FILES['imageupload']['tmp_name'];
            $file_type = $_FILES['imageupload']['type'];
            $file_ext = strtolower(end(explode('.',$file_name)));
            $extensions = array("jpeg","jpg","png");

            ?>
            <script>
                alert("before error upload");
                history.back();
            </script>
    <?php
    
            // if(in_array($file_ext,$extensions) === false){
            //     $errors[] = "this extension file is not allowed, plz choose jpg or png";
            // }
            ?>
            <script>
                alert("after upload");
                history.back();
            </script>
    <?php
    
            // if($file_size > 5242880){
            //     $errors[] = "file size must be 2mb or lower.";
                
                // if(empty($error) === true){
                    move_uploaded_file($file_tmp,"./admin/Titleimage/".$file_name);

                // }else{
                //     print_r($errors);
                //     die();

                // }
            // }
    
        // }
        /* -------------------------------------------------------------------------- */

        $sql = "insert into titles(title_topic,title_description,title_image)
            values('$title_topic','$title_description','$file_name');";

        $query = mysqli_query($conn, $sql);

        if ($query) {
    ?>
            <script>
                alert("titles inserted");
                history.back();
            </script>
    <?php
    die();
        }
    }

    ?>








    <div class="threadList_container">

        <div class="threadList_parent">
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
            ?>
                <h1>Add Titles</h1>

                <div class="threadList_discussion">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" name="imageupload" class="">
                        <input type="text" name="title_topic" class="" placeholder="Title">
                        <textarea name="title_description" id="" placeholder="Description" cols="30" rows="10"></textarea>
                        <button class="btn" name="submit" type="submit">Add</button>
                    </form>
                </div>
            <?php

            } else {
            ?>
                <div class="threadList_discussion">
                    <form action="" method="POST">
                        <h3 id="plz_login"> Plz login before asking your question !!! </h3>
                    </form>
                </div>
            <?php
            }



            ?>

        </div>
    </div>

    <?php
    include "./partials/footer.php"

    ?>


</body>

</html>