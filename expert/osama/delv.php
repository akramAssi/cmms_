<?php
    // echo $_POST['message'];
    session_start();
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
    
    $id=$_GET['id'];
    $date=date('Y-m-d H:i', strtotime(str_replace('-', '/', date('Y/m/d h:i ', time()))));
    $sql = "UPDATE `history` SET `deliverytime`='{$date}'  WHERE `no`={$id} and `starttime` IS NOT NULL and `endtime` IS NOT NULL";
    $conn->query($sql);
    
    if ($conn-> affected_rows > 0 == TRUE)
    {
        echo "yes";
        $sql = "DELETE FROM `vic` WHERE `hno`={$id}";
        if ($conn->query($sql) === TRUE)
        {
            $msg= "Vehicle delivered successfully";
            header("Location:carInCenter.php?message={$msg}"); 
        }
        else
        {
            $msg= "Error: " . $sql . "<br>" . $conn->error;
            header("Location:carInCenter.php?message={$msg}");
            
        }

    }
    else
    {
        $msg= "Please end the service before delivering a car";
        header("Location:carInCenter.php?message={$msg}"); 
        
    }


    ?>