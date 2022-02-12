<?php require('../Bootstrap/links.php');?>

<head>
<!-- CSS -->
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <div class="sidebar">
        <img src="..\assets\images\default-profile.jpg" alt="Brgy Icon" class="brgyLogo">
        <?php
        if(isset($_SESSION["useruid"])){
            echo "<h2>" . $_SESSION["useruid"] . "</h2>";
        }
        ?>
        <ul>
            <li><a href="#" class="dashboard"><i class="fa fa-home"></i> &nbsp;Dashboard</a></li>
            <li><a href="#" class="officials"><i class="fa fa-user-circle-o"></i> &nbsp;My Portfolio</a></li>
            <li><a href="#" class="certificate"><i class="fa fa-file-text"></i> &nbsp;Works</a></li>
            <li><a href="#" class="settings"><i class="fa fa-gears"></i> &nbsp;Account</a></li>
            <li><a href="../LoginModule/includes/logout.inc.php" class="logout"><i class="fa fa-sign-out">      </i> &nbsp;Logout</a></li>
        </ul>
    </div>
</body>


