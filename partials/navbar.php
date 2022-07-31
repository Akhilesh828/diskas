<div class="wrapper">
    <nav>
        <input type="checkbox" id="show-search" />
        <input type="checkbox" id="show-menu" />
        <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
        <div class="content">
            <div class="logo"><a href="./index.php">DisKas</a></div>
            <ul class="links">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./index.php">About</a></li>
                <?php


                ?>
                <li>
                    <a href="#" class="desktop-link">Languages</a>
                    <input type="checkbox" id="show-features" />
                    <label for="show-features">Languages</label>
                    <ul>
                        <?php
                        $sql = "select * from titles ";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <li><a href="threadlist.php?title_id=<?php echo $row['title_id'] ?>"> <?php echo $row["title_topic"] ?> </a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <!-- <li>
                        <a href="#" class="desktop-link">Services</a>
                        <input type="checkbox" id="show-services" />
                        <label for="show-services">Services</label>
                        <ul>
                            <li><a href="#">Drop Menu 1</a></li>
                            <li><a href="#">Drop Menu 2</a></li>
                            <li><a href="#">Drop Menu 3</a></li>
                            <li>
                                <a href="#" class="desktop-link">More Items</a>
                                <input type="checkbox" id="show-items" />
                                <label for="show-items">More Items</label>
                                <ul>
                                    <li><a href="#">Sub Menu 1</a></li>
                                    <li><a href="#">Sub Menu 2</a></li>
                                    <li><a href="#">Sub Menu 3</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->

                <?php

                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
                ?>
                    <li><a href="./profile.php">Profile</a></li>
                    <li><a href="./logout.php">logout</a></li>
                <?php
                } else {
                ?>
                    <li><a href="./login.php">login</a></li>
                    <li><a href="./signup.php">Signup</a></li>
                <?php
                }
                ?>

            </ul>
        </div>
        <label for="show-search" class="search-icon"><i class="fas fa-search"></i></label>
        <form action="search.php" method="GET" class="search-box">
            <input type="text" name="search" autocomplete="off" placeholder="Search..." required />
            <button name="submit" class="go-icon">
                <i class="fas fa-long-arrow-alt-right"></i>
            </button>
        </form>
    </nav>
</div>