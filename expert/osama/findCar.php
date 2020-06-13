<?php
    $servername = "sql302.epizy.com";
    $username = "epiz_25613163";
    $password = "FA3c2XY3aWljTX";
    $dbname='epiz_25613163_CMMS';


    $conn = new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $id=$_POST['id'];
    $sql = "SELECT o.name , c.vin from `customer` o,`car`c WHERE c.`ownerid`=o.id and `plateno`='{$id}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        echo 'Owner name:&nbsp;&nbsp;'.$row['name'];
        echo ",".$row['vin'];
    }
    else
    {
         echo 'Owner name:&nbsp;&nbsp;';
         echo ",noCarIsFound";
    }

    $sql = "SELECT MAX(h.`kilometer`) as kilo,MAX(h.`arrivaltime`) as time FROM `history` h ,`car` c WHERE h.`carvin`= c.vin and c.`plateno`='{$id}'";
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        echo ',last service: &nbsp;&nbsp;'.$row['time'];
        echo ',last kilometer: &nbsp;&nbsp;'.$row['kilo'];
    }
    else
    {
         echo ',last service: &nbsp;&nbsp;';
        echo ',last kilometer: &nbsp;&nbsp;';
    }
    
?>

