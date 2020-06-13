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
    $id=$_POST['id'];
    $sql = "SELECT `tech name` FROM `history` WHERE `no`={$id}";
    $result = $conn->query($sql);
    $rows = $result->fetch_assoc();
    session_start();
    if($rows['tech name']!=$_SESSION['user'])
    {
        echo "The technician {$rows['tech name']} ended the process, not you";
        exit();
    }
    $date=date('Y-m-d H:i', strtotime(str_replace('-', '/', date('Y/m/d h:i ', time()))));
    $sql = "UPDATE `history` SET `endtime`='{$date}' WHERE `no`={$id}";
    if ($conn->query($sql) === TRUE)
    {
        $sql = "UPDATE `vic` SET `status`='finished' WHERE `hno`={$id}";
        if ($conn->query($sql) === TRUE)
        {
            echo "finished" ;
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    ?>