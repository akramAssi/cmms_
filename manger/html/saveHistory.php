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
    
    $sql = "select count(*) as num from history";
    $result = $conn->query($sql);
    $history=0;
    if($result->num_rows > 0)
    {
        $rows = $result->fetch_assoc()
        $history=$rows['num'];

    }
    else
    {
        echo "have error";
        exit();
    }
    session_start();
    

    $sql = "INSERT INTO `history`(`no`, `kilometer`,`desowner`, `arrivaltime`, `expert name`, `carvin`) VALUES ({$history},{$_GET['KILO']},{$_GET['desc']},".date('Y-m-d H:i', strtotime(str_replace('-', '/', date('Y/m/d h:i ', time()))).",{$_SESSION['user']},{$_GET['vin']})";
    if ($conn->query($sql) === TRUE) 
    {
        
        while(count($part)>0)
        {
            $pop= array_pop($part);
            
            $sql = "INSERT INTO `descpart`(`hno`, `pno`) VALUES ({$history},{$pop})";
            if ($conn->query($sql) === false) 
            {
                echo ="have error in part ";
                // $sql="DELETE FROM `history` WHERE `no`={$history}";
                exit();
            }
            
        }
        while(count($problem)>0)
        {
            $pop1= array_pop($problem);
            
            $sql = "INSERT INTO `descservice`(`hno`, `sno`) VALUES ({$history},{$pop1})";
            if ($conn->query($sql) === false) 
            {
                echo ="have error in service";
                // $sql="DELETE FROM `history` WHERE `no`={$history}";
                exit();
            }
            
        }
        $sql = "select c.ownerid ,o.nvisit FROM `customer` o,`car` c WHERE c.`vin`={$_GET['vin']}";
        $result = $conn->query($sql);
        if($result->num_rows > 0)
        {
            $rows = $result->fetch_assoc()
            $id=$rows['ownerid'];
            $nvisit=$rows['nvisit'];
            $nvisit=$nvisit+1;
            $sql = "UPDATE `customer` SET `nvisit`={$nvisit} WHERE `id`={$id}";
            if ($conn->query($sql) === false) 
            {
                echo ="have error in customer ";
                // $sql="DELETE FROM `history` WHERE `no`={$history}";
                exit();
            }
        }
        $sql = "INSERT INTO `vic`(`status`, `hno`) VALUES ('waiting',{$history})";
            if ($conn->query($sql) === false) 
            {
                echo ="have error in carInCenter ";
                // $sql="DELETE FROM `history` WHERE `no`={$history}";
                exit();
            }

        echo "add with out error";
    }
     else 
     {
        $msg= "Error: " . $sql . "<br>" . $conn->error;
        header("Location:employee.php?message={$msg}");
    }
            
?>