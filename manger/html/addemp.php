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
        $name= $_POST['name'];
        $job= $_POST['job'];
        $id= $_POST['id'];

        $sql = "SELECT work,department FROM `Employee` where `user id`={$id}";
        $yes="n";
        $test=false;
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            $rows = $result->fetch_assoc();
            if(strcmp($rows["work"],$yes) == 0)
            {
              $sql = "UPDATE `Employee` SET `work`='y' WHERE `user id` ={$id}";
              if ($conn->query($sql) === TRUE) 
              {
                  $msg= "update record  successfully";
                  header("Location:employee.php?message={$msg}");
                } 
                else
                {
                      $msg= "Error: " . $sql . "<br>" . $conn->error;
                      header("Location:employee.php?message={$msg}");
                }
                $test=true;
            }
            if(strcmp($rows["department"],$job) != 0)
            {
              $sql = "UPDATE `Employee` SET `department`='{$job}' WHERE `user id` ={$id}";
              if ($conn->query($sql) === TRUE) 
              {
                  $msg= "update record  successfully";
                  header("Location:employee.php?message={$msg}");
                } 
                else
                {
                      $msg= "Error: " . $sql . "<br>" . $conn->error;
                      header("Location:employee.php?message={$msg}");
                }  
                $test=true;
            }
            if(!$test)
            {
                header("Location:employee.php?message=  employee is is already exists");
            }
        }
        else
        {

        
        $sql = "INSERT INTO `Employee`(`user id`, `name`, `work`, `department`) VALUES ({$id},'{$name}','y','{$job}')";
        if ($conn->query($sql) === TRUE) 
        {
            $msg= "New record created successfully";
            // $msg= "update record  successfully";
            header("Location:employee.php?message={$msg}");
            // header("REFRESH:0;URL=employee.php");
            
        } else {
            $msg= "Error: " . $sql . "<br>" . $conn->error;
            header("Location:employee.php?message={$msg}");
        }
    
        }
    }
    else
    {
        $msg="You Can't Brwose This Page Directly ";
        header("Location:employee.php?message={$msg}");
    }
?>