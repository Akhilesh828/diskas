<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "partials/_links.php";

include "./server/conn.php";
include "./partials/navbar.php";

?>



<body>
    <title>edit_comment</title>
    <link rel="stylesheet" href="./threadlist.css" />
    
    <?php
    $comment_id = $_GET['id'];
    // echo $comment_id;

        //if a user try to access this page it will redirect to index
        if(!$comment_id>0){
            ?>
            <script>
                window.location.href="./index.php";
            </script>
            <?php
        }
        
        if(isset($_POST['submit'])){
    
            $comment_content = mysqli_real_escape_string($conn, $_POST['comment_content']);
    
                $sql = "update comment set comment_content = '$comment_content' 
                        where comment_id = '$comment_id' ";
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
        
        $sql = "select * from comment where comment_id = '$comment_id' ";
        $query = mysqli_query($conn,$sql);
        
        $row = mysqli_fetch_assoc($query);

        $comment_content = $row['comment_content'];

        
        
    ?>
<?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
            ?>
            <div class="threadList_container">
                <div class="threadList_parent">
                    <br>
                    <br>
                    <h1>Editing...</h1>

                    <div class="threadList_discussion">
                        <form action="" method="POST">
                            <textarea name="comment_content" id="editor" cols="30" rows="10"><?php echo $comment_content ; ?></textarea>
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