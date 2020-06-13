 <?php
    // echo $_POST['message'];
    session_start();
    $servername = "sql302.epizy.com";
            $username = "epiz_25613163";
            $password = "FA3c2XY3aWljTX";
            $dbname='epiz_25613163_CMMS';

            // Create connection
            $conn = new mysqli($servername, $username, $password,$dbname);
            $uu=($_SESSION['id']);
            
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT c.brand,c.model,c.year,h.arrivaltime,h.starttime,h.endtime,v.status from `customer` cu,`car` c,`history`h,`vic` v WHERE cu.id=c.ownerid AND h.no=v.hno AND c.vin=h.carvin AND cu.id={$uu}";
           
            $result = $conn->query($sql);
            
    ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" type="text/css" href="css\custHomePageStyle.css">
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<script src="js\countUp\countUp.js"></script>
<script src="js\clock.js"></script>
</head>
<body style="background:#F5F5F5;">
<div class="mainDiv" style="top:0%;">
 <?php
 
        if ($result->num_rows > 0)
        {
            while($rows = $result->fetch_assoc())
            { 
                echo"
<div class='carStatusDiv'>
	
		<table class='table1'>
        <tr >
			<td style='border-bottom: 1px solid'>{$rows['brand']}</td>
			<td style='border-bottom: 1px solid'>{$rows['model']}</td>
			<td style='border-bottom: 1px solid'>{$rows['year']}</td>
		</tr>
	    <tr>
			<td style='font-size: 2.5vw'>Arrived time</td>
			<td style='font-size: 2.5vw'>Start time</td>
			<td style='font-size: 2.5vw'>End time</td>
		</tr>
		<tr>
			<td><span id='time' style='font-size:1.7vw'>{$rows['arrivaltime']}</span></td>
			<td><span id='time' style='font-size:1.7vw'>{$rows['starttime']}</span></td>
			<td><span id='time' style='font-size:1.7vw'>{$rows['endtime']}</span></td>
		</tr>
		
	</table>
         
	<table width='98%' class='table2'>";
    if($rows['status']=='waiting'){
		echo"<tr>
			<td><img class='img' src='image/carcust.svg' style='float: left;margin-left: 15%;'></td>
			<td><img class='img' src='image/carcust.svg' style='margin-right: 10%;display: none;'></td>
			<td><img class='img' src='image/carcust.svg' style='float: right;margin-right: 15%;display: none;'></td>
		</tr>";
        }
        else if($rows['status']=='inservice'){
		echo"<tr>
			<td><img class='img' src='image/carcust.svg' style='float: left;margin-left: 15%;display: none;'></td>
			<td><img class='img' src='image/carcust.svg' style='margin-right: 10%;'></td>
			<td><img class='img' src='image/carcust.svg' style='float: right;margin-right: 15%;display: none;'></td>
		</tr>";
        }
         else if($rows['status']=='finished'){
		echo"<tr>
			<td><img class='img' src='image/carcust.svg' style='float: left;margin-left: 15%;display: none;'></td>
			<td><img class='img' src='image/carcust.svg' style='margin-right: 10%;display: none;'></td>
			<td><img class='img' src='image/carcust.svg' style='float: right;margin-right: 15%;'></td>
		</tr>";
        }
	echo"</table>
         
	<div style='margin-left: 1%;margin-bottom: 1%;text-align: center;'>
		<div style='display: inline-block;background-color: red; border-bottom-left-radius: 20px;border-top-left-radius: 20px;width: 29%;
    padding: 7px;margin-right: -1%;'>Waiting</div>
				<div style='display: inline-block;background-color: orange;width: 29%;
    padding: 7px;;margin-right: -1%;'>In service</div>
			<div class='colorLine' style='display: inline-block;background-color: green;border-bottom-right-radius: 20px;border-top-right-radius: 20px;width: 29%;
    padding: 7px;'>Finished</div>
		</div>
</div>";}
        }?>
<?php 
$sql = "SELECT c.plateno FROM `customer` cu,`car`c ,`history` h WHERE c.`vin`=h.carvin AND cu.id=c.ownerid AND cu.id={$uu}";

    $result = $conn->query($sql);

     $plateno =array();
if ($result->num_rows > 0)
        {
 while($rows = $result->fetch_assoc())
            {
               
                if(in_array($rows['plateno'], $plateno)==0){
                    $plateno[] =$rows['plateno'];
            
               
            }
        }
                }
                  
 for($j=0;$j<count($plateno);$j++){
                
             
$sql1 = "SELECT  MAX(h.`arrivaltime`) as mtime,MAX(h.`kilometer`) as mkilo ,c.year,c.model,c.brand FROM `customer` cu,`car`c ,`history` h WHERE c.`vin`=h.carvin AND c.plateno={$plateno[$j]} AND cu.id=c.ownerid AND cu.id={$uu}";
            $result1 = $conn->query($sql1);     
           
            if ($result1->num_rows > 0)
        {
 while($rows1 = $result1->fetch_assoc())
            {
                
    echo"        
<div class='carStatusDiv'>

	<table class='table1'  style='text-align-last: left;height: 17vw;'>
	<tr style='text-align-last: center;'>
			<td colspan='2' style='border-bottom: 1px solid;'>
			<span style='margin-right: 10%'>{$rows1['brand']}</span>
			<span style='margin-right: 10%'>{$rows1['model']}</span>
			<span>{$rows1['year']}</span></td>
		</tr>
	    <tr>
			<td style='font-size: 2vw'><span>Last arrived: </span><span id='time'>{$rows1['mtime']}</span></td>
		</tr>
		<tr >
			<td style='font-size: 2vw'><span>Last kilometer: </span><span id='time'>{$rows1['mkilo']}</span></td>
		</tr>
		<tr>
			<td colspan='2'>
			<input type='number' name='kilometer' title ='kilometer' placeholder='kilometer' class='kilometer' id='kilometer{$j}'>
			</td>
		</tr>
	</table>
	<div class='persant'>
			<div style='font-size: 4vw;margin-top:30%;width:100%;height:50%;' id='prsant{$j}'>0%</div></div>
	<div id='viewHistDiv'><a onclick='openzz({$plateno[$j]})' class='ViewHist'>View car history ></a></div>
	<div class='calculaterImg'>
		<img src='image\calculator.svg' id='calculator' title='calculat' onclick='calculat(fu({$j}),{$rows1['mkilo']},{$j})' >
	</div>
</div>";
}
        }
            }
            ?>
<script type='text/javascript'>
	function fu(id){
		return document.getElementById('kilometer'+id).value;
	}
   function openzz(pl)
{
    var sql="SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime,h.no from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin and c.plateno='"+pl+"' order by h.arrivaltime desc";
    console.log(sql);
    location.href='his_car.php?pl='+pl;
} 
    </script>
</body>
</html>