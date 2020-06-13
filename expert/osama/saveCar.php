<?php
 if($_SERVER['REQUEST_METHOD']=='POST')
    {
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
        
   
        $sql = "INSERT INTO `car`(`plateno`, `vin`, `model`, `brand`, `fuel`, `year`, `ownerid`) VALUES ('{$_POST['PalteNumber']}','{$_POST['Vin']}','{$_POST['model']}','{$_POST['Manufacturer']}','{$_POST['Fuel']}',{$_POST['Year']},{$_POST['id']})";
        if ($conn->query($sql) === TRUE) 
        {
            $msg= "New record created successfully";
            header("Location:home.php?message={$msg}");
            
            
            
        } else {
            $msg= "Error: " . $sql . "<br>" . $conn->error;
            header("Location:home.php?message={$msg}");
            
        }
    
        
    }
    else
    {
        $msg="You Can't Brwose This Page Directly ";
        header("Location:home.php?message={$msg}");
    }
?>