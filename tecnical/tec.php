
<?php

session_start();
if(!isset($_SESSION['user']))
{
    header("REFRESH:0;URL=../index.php");
}
?><!DOCTYPE html>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="css\menuStyle.css">
	<link rel="stylesheet" type="text/css" href="css\tecnical.css">
	<link rel="stylesheet" type="text/css" href="css\expHistory.css">
    <link rel="stylesheet" type="text/css" href="css\foopicker.css">
	<script src="js\clock.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>tecnical page</title>
	<style type="text/css">
		table{
			font-size: 2vw;
		}
		.margin{
			margin-left: 2vw;
		}
	</style>
</head>
<body>
<div class="upperdiv">
	<div class="leftDiv">
		<table>
			<tr>
				<td><img src="image\logo.png"></td>
				<td><span>CMMS</span></td>
			</tr>
		</table>
	</div>
	<div class="pageButton">
		<a href="tecWork.php"><img src="image\wrench.svg" title="My work"></a>
		<a href="tec.php"><img src="image\list.png" class="act" title="Car in center"></a>
	</div>
	<div class="rightDiv">
		<div style="position: absolute;">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['img']); ?>" onclick="infopage('tecInfoPage.php');" alt="image does not found" title="Edit profile" id="img2">
		</div>
		<div id="tecName">
			<label style="color: #C9CCD0;font-size: 1.2vw;"><?php echo$_SESSION['user'] ?></label>
		</div>
		<div class="log">
			<a href="logout.php" style="cursor: pointer;" title="logout">
			<span>logout</span>
			<img src="image\logout.png" style="height: 1vw"></a>
		</div>
	</div>
</div>
<div class="d1" style="width: 100%;height: 86vh;">
<iframe width="100%" height="100%" src="tecCarIn.php" style="border: none;background:none;"></iframe>
</div>
</body>
</html>