<?php
    // echo $_POST['message'];
        
    $servername = "sql302.epizy.com";
            $username = "epiz_25613163";
            $password = "FA3c2XY3aWljTX";
            $dbname='epiz_25613163_CMMS';

            // Create connection
            $conn = new mysqli($servername, $username, $password,$dbname);

            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            $pl=$_GET['pl'];
            $sql = "SELECT brand,model,year,plateno FROM car where ownerid = {$pl}";
            
            $result = $conn->query($sql);
    ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" type="text/css" href="..\CSS osama\custHomePageStyle.css">
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="..\CSS osama\custCar.css">
</head>
<body style="background:#F5F5F5; " >
<div class="firstDiv">
   
        <?php
                
                if ($result->num_rows > 0) 
                {
                    while($rows = $result->fetch_assoc())
                    {
                        $pp=$rows['plateno'];
                ?>
		<div class='carStatusDiv' onclick="openzz('<?php echo $pp; ?>')">
 <table>
		<tr >
			<td><?php echo $rows['brand']; ?></td>
			<td><?php echo $rows['model']; ?></td>
			<td><?php echo $rows['year']; ?></td>
		</tr>
	</table>
	
</div>
 <?php
                        }
                    }
                    else {}
                $conn->close();
                ?>
<img src="../img/car.svg" class="img">
</div>
<script>
function openzz(pl)
{
    var sql="SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime,h.no from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin and c.plateno='"+pl+"' order by h.arrivaltime desc";
    console.log(sql);
    location.href='his_car.php?pl='+pl;
}
</script>
</body>
</html>