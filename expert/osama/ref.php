<?php 
$servername = "sql302.epizy.com";
$username = "epiz_25613163";
$password = "FA3c2XY3aWljTX";
$dbname='epiz_25613163_CMMS';
$conn = new mysqli($servername, $username, $password,$dbname);
$sSQL= 'SET CHARACTER SET utf8';                                                               
mysqli_query($conn,$sSQL) or die ('Can\'t charset in Base');

$sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime,h.no from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin order by h.arrivaltime desc";

$result= mysqli_query($conn,$sql);
    
    while($rows = mysqli_fetch_array($result)){
        
        echo '<section onclick= " show'." (' ".$rows['no']. " '); " .'">'
                . "<div>".
                "<span class='h'>{$rows['brand']}</span><span class='h'>{$rows['model']}</span> <span class='h'>{$rows['year']}</span> <span class='row'>Plate NO. :</span> <span>{$rows['plateno']}</span>".
                "</div>".
                "<div>".
                "<span>Time arrived :</span><span>{$rows['arrivaltime']}</span><span class='row'>Time delvariy :</span><span>{$rows['deliverytime']}</span>".
                "</div>". 
                "<div>".
                "<span>Name :</span> <span>{$rows['name']}</span>".
                "</div>
                <div></div>
                <img src='../brand/{$rows['brand']}.png'>
                </section>" ;
            }

            echo ($output);  
            
?>

