<?php

session_start();
if(!isset($_SESSION['user']))
{
    header("REFRESH:0;URL=../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/menuStyle.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <title>Center Maintenance Management System</title>
    <link rel="icon" href="image\car.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div class="d1">
        <iframe src="tecCarIn.php" height="100%" width="100%" name="iframe_a" style="border: none;"></iframe>
    </div>
    <!--end right big div-->
    <div class="menu">
        <div class="secandDiv">
            <img src="image/logo.png" id="img1">
            <a id="cmms">CMMS</a>
            <p id="line"></p>
        </div>
        <!--logo name line-->
        <div class="thiredDiv">
            <?php
                if(!empty($_SESSION['img'])=="")
                {
                    $src= 'image/my.png';
                }
                else
                {   
                    $src= 'data:image/jpg;charset=utf8;base64,'.base64_encode($_SESSION['img']);
                }
            ?>
            <img src="<?php echo $src ?>"  alt="image does not found" title="Edit profile" id="img2">
            <p id="name"><?php echo$_SESSION['user'] ?></p>
            <a href="logout.php" title="logout" class="buttonlog">
                <span id="logout">logout</span>
                <img src="image/logout.png" id="buttonLogout"></a>



            <!--image name logoutButton-->
            <div id="myDIV" class='myDIV'>

                <a href="tecCarIn.php" title="Home" class="buttonMenu act" target="iframe_a">
                    <img src="image/home.png" class="buttonIcon">
                    <span class=" buttonText">Home</span>
                </a>

                <a href="carInCenter.php" title="Employee" class="buttonMenu" target="iframe_a">
                    <img src="image\wrench.svg" class="buttonIcon">
                    <span class=" buttonText">My work</span>
                </a>

                <a href="infoPage.php" title="setting" class="setting" target="iframe_a">
                    <img src="image/gear.png" style="height: 100%;width: 100%">
                </a>

                <a href="logout.php" title="logout" class="buttonlogdown">
                    <img src="image/logout.png">
                </a>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/active.js"></script>
    <script src="js/clock.js"></script>
</body>

</html>