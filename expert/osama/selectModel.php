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
    $valueToSearch = $_POST['searchVal'];
    $sql = "SELECT DISTINCT `model` from car WHERE `brand`='{$valueToSearch}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
        while($row = $result->fetch_assoc())
        {
            echo '<option value="'.$row['model'].'">';
        }
    }
            
?>

