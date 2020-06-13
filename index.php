<?php
session_start();

    if(isset($_SESSION['dept'])&&$_SESSION['dept']=='m')
    {
        header("REFRESH:0;URL=manger/html/cmms.php");
        exit();
    }
    else if(isset($_SESSION['dept'])&&$_SESSION['dept']=='e')
    {
        header("REFRESH:0;URL=expert/osama/expert.php");
        exit();
    }
    else if(isset($_SESSION['dept'])&&$_SESSION['dept']=='t')
    {
        header("REFRESH:0;URL=tecnical/mainPage.php");
        exit();
    }
    else if(isset($_SESSION['dept'])&&$_SESSION['dept']=='c')
    {
        header("REFRESH:0;URL=customer/custHomePage.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale = 1.0" />
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="manger\img\car.svg">
</head>

<body>
    <div id="div1"></div>
    <div id="div2">
        <div class="content">
            <div class="header">
                <img src="img/logo.png" alt="logo" width="139px" height="98px" />
                <h5>Center Maintenance Management System</h5>
            </div>
            <div class="form_login">
                <form  action="chk.php" method="POST">
                    <h1>Login</h1>
                    <input type="text" name="user_name" placeholder="user name" required>
                    <input type="password" name="password" placeholder="password" required>
                    <input type="submit" value="Login">
                </form>
            </div>
        </div>
        <div id="icon">
            <img src="img/vw.png">
            <img src="img/benz.png">
            <img src="img/sh.png">
            <img src="img/audi.png">
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