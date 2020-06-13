<?php
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
$sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.`tech name`,v.status, h.no from customer a,`car` c,`history`h,`vic` v WHERE a.id=c.ownerid and c.vin=h.carvin and h.no=hno
";
            $result = $conn->query($sql);
            
?>    
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/history.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="history" title="more title">
                <?php
                
                if ($result->num_rows > 0) 
                {
                    while($rows = $result->fetch_assoc())
                    {
                ?>
                        <section style="cursor: default;">
                            <div>
                                <span class='h'><?php echo $rows['brand']; ?></span>
                                <span class='h'><?php echo $rows['model']; ?></span>
                                <span class='h'><?php echo $rows['year']; ?></span>
                                <span class='row'>Plate NO. :</span>
                                <span><?php echo $rows['plateno']; ?></span>
                                <span class='row'>States :</span>
                                <span style="color:red"><?php echo  $rows['status']; ?></span>
                            </div>
                            <div>
                                <span>Time arrived :</span>
                                <span><?php echo $rows['arrivaltime']; ?></span>
                                <span class='row'>Technical name :</span>
                                <span><?php echo $rows['tech name']; ?></span>
                                
                            </div>
                            <div>
                                <span>Name :</span> 
                                <span><?php echo $rows['name']; ?></span>
                            </div>
                            <div></div>
                            <img src='../brand/<?php echo $rows['brand'];?>.png'>
                        </section>

                <?php
                        }
                    }
                    else { echo "0 results"; }
                $conn->close();
                ?>
               
            
        
    </div>
    
</body>

</html>