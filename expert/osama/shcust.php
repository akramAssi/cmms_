<?php
    $servername = "sql302.epizy.com";
    $username = "epiz_25613163";
    $password = "FA3c2XY3aWljTX";
    $dbname='epiz_25613163_CMMS';


    $conn = new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $valueToSearch = $_POST['searchVal'];
    $sql = "SELECT id FROM `customer` WHERE `name` = '{$valueToSearch}' or id = '{$valueToSearch}'";
    
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        echo $row['id'];
        echo ",isExist";
    }
    else
    {
        echo "0";
         echo ",noCarIsFound";
    }

    
?>

