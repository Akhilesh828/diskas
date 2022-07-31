<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "./server/conn.php";
include "./partials/_links.php";
include "./partials/navbar.php";

include "./components/with_login.php";


?>



<body>
    <title>edit_threadlist</title>
    <link rel="stylesheet" href="./threadlist.css" />
    <!-- <link rel="stylesheet" href="./th.css"/> -->
    
    <?php
    $threadlist_id = $_GET['id'];
    
    //if a user try to access this page it will redirect to index
    if(!$threadlist_id>0){
        ?>
        <script>
            window.location.href="./index.php";
        </script>
        <?php
    }

        
        if(isset($_POST['submit'])){
            $threadlist_title = mysqli_real_escape_string($conn, $_POST['threadlist_title']);
            $threadlist_title = str_replace("<", "&lt", $threadlist_title);
            $threadlist_title = str_replace(">", "&gt", $threadlist_title);
    
            $threadlist_description = mysqli_real_escape_string($conn, $_POST['threadlist_description']);
    
                $sql = "update threadlist set threadlist_title ='$threadlist_title' , threadlist_description = '$threadlist_description' 
                        where threadlist_id = '$threadlist_id' ";
                    $query = mysqli_query($conn,$sql);
                
                if ($query) {
                ?>
                    <script>
                        alert("Updated");
                        history.go(-2);
                    </script>
                <?php
    
                    die();

                }
        }
    ?>
    <?php
        
        $sql = "select * from threadlist where threadlist_id = '$threadlist_id' ";
        $query = mysqli_query($conn,$sql);
        
        $row = mysqli_fetch_assoc($query);
//         echo $row['threadlist_title'];
// echo $row['threadlist_description'];
        $threadlist_title = $row['threadlist_title'];
        $threadlist_description = $row['threadlist_description'];

        
        
    ?>
<?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
            ?>
            <div class="threadList_container">
        <!-- <div class="threadList_pro"> -->
            <div class="threadList_parent">
                <br>
                <br>
                <h1>Editing...</h1>

                <div class="threadList_discussion">
                    <form action="" method="POST">
                        <input type="text" name="threadlist_title" class="text" value="<?php echo $threadlist_title ; ?>" >
                        <textarea name="threadlist_description" id="editor" cols="30" rows="10"><?php echo $threadlist_description ; ?></textarea>
                        <button class="btn" name="submit" type="submit">Update</button>
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

<script>
        CKEDITOR.replace('editor');
</script>


</body>

</html>