<!DOCTYPE html>
<html lang="en">

<title>detail</title>

<link rel="stylesheet" href="./users_detail.css"/>

<body>
<?php
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true && $_SESSION['user_role'] === "admin"){
        $login_id = $_SESSION['loginid'];
        
        }else{
        $login_id = 0;
        header("Location: http://localhost/forum/4/login.php");
        }


    include "./server/conn.php";
    include "./partials/_links.php";
    include "./partials/navbar.php";

    ?>

    <?php
    ?>
<!-- //! <img src="https://source.unsplash.com/500x200/?'. $title_topic .',programming" alt="" /> -->




<div class="table_container">
        <h1>User details</h1>

        <div class="table_parent">
            <table>
                <thead cellpadding="7px">
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th>LOCATION</th>
                    <th>ABOUT</th>
                    <th>UNIVERSITY</th>
                    <th>JOB_TITLE</th>
                    <th>WEBSITE</th>
                    <th>Linkdein</th>
                    <th>GITHUB</th>
                    <!-- <th>Verification_code</th> -->
                    <th>Is_Verified</th>
                    <th>DATE</th>
                    <th colspan="2">UPDATE</th>
                </thead>
                <tbody>

                <?php
                    
                    $sql = "select * from users";
                    $query = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($query)){
                        ?>
                        
                        <tr>
                            <td><?php echo $row['user_id'] ?></td>
                            <td><?php echo $row['user_name'] ?></td>
                            <td><?php echo $row['user_email'] ?></td>
                            <td><?php echo $row['user_role'] ?></td>
                            <td><?php echo $row['user_location'] ?></td>
                            <td><?php echo $row['user_about'] ?></td>
                            <td><?php echo $row['user_university'] ?></td>
                            <td><?php echo $row['user_job_title'] ?></td>
                            <td><?php echo $row['user_website'] ?></td>
                            <td><?php echo $row['user_linkedin'] ?></td>
                            <td><?php echo $row['user_github'] ?></td>
                            <!-- <td><?php echo $row['verification_code'] ?></td> -->
                            <td><?php echo $row['is_verified'] ?></td>
                            <td><?php echo $row['user_date'] ?></td>
                            <td><button class="btn"><a href="./admin/edit_profiles.php?user_id=<?php echo $row['user_id'] ?>">edit</a></button></td>
                            <td><button class="btn"><a href="./admin/delete_profiles.php?user_id=<?php echo $row['user_id'] ?>">delete</a></button></td>
                        </tr>

                        <?php
                    }
                    
                    
                ?>
                </tbody>

            </table>
        </div>


    </div>







    <?php
        include "./partials/footer.php"
        
    ?>
</body>

</html>