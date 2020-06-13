<?php

session_start();
if(!isset($_SESSION['user']))
{
    header("REFRESH:0;URL=../../index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="..\CSS osama\menuStyle.css">
    <link rel="stylesheet" type="text/css" href="..\CSS osama\homePageContant.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="..\js osama\clock.js"></script>
    <title>Center Maintenance Management System</title>
    <link rel="icon" href="..\img\car.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>



    <div class="d1">
        <iframe src="home.php" height="100%" width="100%" style="border: none;" name="iframe_a"></iframe>
    </div>


    <!--end right big div-->
    <div class="menu">
        <div class="secandDiv">
            <img src="..\img\logo.png" id="img1">
            <a id="cmms">CMMS</a>
            <p id="line"></p>
        </div>
        <!--logo name line-->
        <div class="thiredDiv">
        <?php
                if(!empty($_SESSION['img'])=="")
                {
                    $src= '../img/my.png';
                }
                else
                {   
                    $src= 'data:image/jpg;charset=utf8;base64,'.base64_encode($_SESSION['img']);
                }
            ?>
            
            <img src="<?php echo $src ?>" onclick="infopage();" alt="image does not found" title="Edit profile" id="img2">
            <p id="name"><?php echo $_SESSION['user']; ?></p>
            <a href="logout.php" title="logout" class="buttonlog">
                <span id="logout">logout</span>
                <img src="..\img\logout.png" id="buttonLogout"></a>

            <div id="myDIV" target="iframe_a">

                <a href="home.php" title="Home" class="buttonMenu act" target="iframe_a">
                    <img src="..\img\home.png" class="buttonIcon">
                    <span class=" buttonText">Home</span>
                </a>

                <a href="partPage.php" title="Part" class="buttonMenu" target="iframe_a">
                    <img src="..\img\car-parts.png" class="buttonIcon">
                    <span class=" buttonText">Part</span>
                </a>

                <a href="problem.php" title="Problem" class="buttonMenu" target="iframe_a">
                    <img src="..\img\problem.png" class="buttonIcon">
                    <span class=" buttonText"> Problem</span>
                </a>

                <a href="mainhistory.php" title="History" class="buttonMenu" target="iframe_a">
                    <img src="..\img\history.png" class="buttonIcon">
                    <span class=" buttonText"> History</span>
                </a>

                <a href="carInCenter.php" title="Car in center" class="buttonMenu" id="car" target="iframe_a">
                    <img src="..\img\list.png" class="buttonIcon">
                    <span class=" buttonText">Car in center</span>
                </a>

                <a href="custamer.php" title="Customer" id="custamer" class="buttonMenu" target="iframe_a">
                    <img src="..\img\customers.png" class="buttonIcon">
                    <span class=" buttonText">Customer</span>
                </a>

                <a href="infoPage.php" title="setting" class="setting" target="iframe_a">
                    <img src="..\img\gear.png" style="height: 100%;width: 100%" target="iframe_a">
                </a>

                <a href="logout.php" title="logout" class="buttonlogdown">
                    <img src="..\img\logout.png">
                </a>
            </div>



            <script src="..\js osama\active.js"></script>
        </div>

    </div>
<?php
    if(!empty($_GET['message']))
        {
            echo "<script>alert('{$_GET['message']}');</script>";
            // echo $_GET['message'] ;
        }
    ?>
</body>

</html>