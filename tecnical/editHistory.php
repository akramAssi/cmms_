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
    $note=$_POST['note'];
    $sql = "UPDATE `history` SET `othernote`='{$note}' WHERE `no`={$id}";
    if ($conn->query($sql) === TRUE)
    {
        echo "note is send to expert";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    ?>