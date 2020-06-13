<?php

  $id = $_GET['id'];
  session_start();
  // do some validation here to ensure id is safe
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
        echo "Connected successfully";
        if(isset($_SESSION['user']))
        {
            $user= $_SESSION['user'];
        $password= $_SESSION['id'];
        echo $password;
        }
        else
        {
            exit();
        }
        
        // echo $user;
        $sql = "SELECT photo FROM `Employee` WHERE `user id`=102 AND name='osama'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo"dsadassa";
        }
        $row = $result->fetch_assoc();
        echo "yes1";
        // header("Content-type: image/jpg");
        echo $row['photo']);
        // echo '<img src="data:image/jpeg;base64,'.base64_encode( stripslashes($row['photo']) ).'"/>';
        echo "yes2";
        mysql_close($link);
?>