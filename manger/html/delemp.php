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
        $id= $_POST['id'];
        $sql = "SELECT `department` FROM `Employee` WHERE `user id`={$id}";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            $rows = $result->fetch_assoc();
            $dept=$rows['department'];
            if($dept=="manger")
            {
                $sql = "SELECT count(*) as num FROM `Employee` WHERE `department`='manger' and `work`='y'";
                $result = $conn->query($sql);
                $rows = $result->fetch_assoc();
                if($rows['num']<= 1)
                {
                    $msg= "There should be at least one director";
                    header("Location:employee.php?message={$msg}");
                    exit();
                }
            }
            
        }
        $sql = "UPDATE `Employee` SET `work`='n' WHERE `user id` ={$id}";
        if ($conn->query($sql) === TRUE) 
        {
            $msg= "delete record  successfully";
            header("Location:employee.php?message={$msg}");
            } else
             {
            $msg=  "Error: " . $sql . "<br>" . $conn->error;
            header("Location:employee.php?message={$msg}");
        }
    }
    else
    {
        $msg= "You Can't Brwose This Page Directly ";
        header("Location:employee.php?message={$msg}");
    }
?>