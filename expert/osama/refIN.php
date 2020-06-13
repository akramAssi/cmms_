<?php 
$servername = "sql302.epizy.com";
$username = "epiz_25613163";
$password = "FA3c2XY3aWljTX";
$dbname='epiz_25613163_CMMS';
$conn = new mysqli($servername, $username, $password,$dbname);
$sSQL= 'SET CHARACTER SET utf8';                                                               
mysqli_query($conn,$sSQL) or die ('Can\'t charset in Base');

$sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.`tech name`,v.status, h.no from customer a,`car` c,`history`h,`vic` v WHERE a.id=c.ownerid and c.vin=h.carvin and h.no=hno order by h.arrivaltime desc";
$result= mysqli_query($conn,$sql);
//     if ($result->num_rows > 0) 
// {
    while($rows = mysqli_fetch_array($result)){
        
        $output.= '<section onclick= "show('." '{$rows['no']}') " .'">'
                . "<div>".
                "<span class='h'>{$rows['brand']}</span><span class='h'>{$rows['model']}</span> <span class='h'>{$rows['year']}</span> <span class='row'>Plate NO. :</span> <span>{$rows['plateno']}</span><span class='row'>States :</span><span style='color:red'>{$rows['status']}</span>".
                "</div>".
                "<div>".
                "<span>Time arrived :</span><span>{$rows['arrivaltime']}</span><span class='row'>Technical name :</span><span>{$rows['tech name']}</span>".
                "</div>". 
                "<div>".
                "<span>Name :</span> <span>{$rows['name']}</span>".
                "</div>
                <div></div>
                <img src='../brand/{$rows['brand']}.png'>
                </section>" ;
            }
            echo ($output);
// }
// else
// {
//  $output.='no car in center';
//  echo ($output);
// }     
            
?>