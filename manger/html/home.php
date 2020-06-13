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
            $sql = "SELECT name ,COUNT(*) as num FROM `descpart` dp, `part` p WHERE dp.pno= p.no group by no order by num DESC limit 5";
            $result = $conn->query($sql);
            $novisitstmt = "SELECT name,address FROM customer order by nvisit desc limit 5";
            $novisit= $conn->query($novisitstmt);
            $vic = "select no FROM vic";
            $vicrows=$conn->query($vic);
           
            
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/homePageContant.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="../js/clock.js"></script>
    <title></title>
</head>

<body onload="startTime()" style="overflow-y: scroll;">
    <p style="text-align: right;margin-right: 2%;" id="demo"></p>
    <div style="height: 100%;width: 100%;">
        <div class="bodyDivs">
            <table class="tables">
                
                <?php
                
                if ($result->num_rows > 0) 
                {
                    while($rows = $result->fetch_assoc())
                    {
                ?>
                        <tr>
                             <td><?php echo $rows["name"]; ?></td>
                            <td><?php echo $rows["num"]; ?></td>
                        </tr>
                <?php
                    }
                }
                else { echo "0 results"; }
                
                ?>
                
            </table>
        </div>
        <!--1th div in right-->
        <div class="bodyDivs2">
            <table id="Table">
                <tr>
                    <td class="carClass"><?php echo ($vicrows->num_rows); ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">car in center</td>
                </tr>
            </table>
        </div>
        <!--2th div in right-->
        <div class="bodyDivs2">
            <table id="Table">
                <tr>
                <?php
                    $ssql = "SELECT COUNT(*) as num FROM `history` WHERE `arrivaltime` BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
                    $ress=$conn->query($ssql);
                    if ($ress->num_rows > 0) 
                    {
                        $rows = $ress->fetch_assoc();
                        echo "<td class='carClass'>{$rows['num']}</td>";
                    }
                ?>
                    
                </tr>
                <tr>
                    <td style="text-align: center;">car service pre month</td>
                </tr>
            </table>
        </div>
        <!--3th div in right-->
        <div class="bodyDivs">
            <table class="tables">
            <?php
                
                if ($novisit->num_rows > 0) 
                {
                    while($crows = $novisit->fetch_assoc())
                    {
                ?>
                        <tr>
                             <td><?php echo $crows["name"]; ?></td>
                             <td><?php echo $crows["address"]; ?></td>
                        </tr>
                <?php
                    }
                }
                else { echo "0 results"; }
                // $conn->close();
                ?>
              
            </table>
        </div>
        <!--4th div in right-->
        <div class="bodyDivs">
            <table class="tables">
             <?php
                $ssql = "SELECT `brand` ,`model` ,count(*) as num FROM `car` GROUP BY `brand`,`model` ORDER BY num DESC LIMIT 5";
                $ress=$conn->query($ssql);
                if ($ress->num_rows > 0) 
                {
                    while($rows = $ress->fetch_assoc())
                    {
                ?>
                        <tr>
                             <td><?php echo $rows["brand"]; ?></td>
                            <td><?php echo $rows["model"]; ?></td>
                        </tr>
                <?php
                    }
                }
                else { echo "0 results"; }
                
                ?>
            </table>
        </div>
        <!--5th div in right-->
    </div>
</body>

</html>