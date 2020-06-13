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
        $name = $_POST['partname'];
        $partno = $_POST['partno'];
        $phone = $_POST['phone'];
        $mname = $_POST['mname'];
        $count = $_POST['count'];
        $price = $_POST['price'];
        $mno =$_POST['mno'];
        $sqltest = "SELECT name,no FROM `part` where `no`={$partno}";
        $resultt = $conn->query($sqltest);
        if ($resultt->num_rows > 0)
        {
            $rows = $resultt->fetch_assoc();
            if(strcmp($rows["name"],$name) != 0)
            {
              $sqll = "UPDATE `part` SET `name`= '{$name}' WHERE `no` ={$partno}";
              if ($conn->query($sqll) === TRUE) 
              {
                  $msg= "update record successfully";
                  header("Location:partPage.php?message={$msg}");
                } 
                else
                {
                      $msg= "Error: " . $sql . "<br>" . $conn->error;
                      header("Location:partPage.php?message={$msg}");
                }
            }

            if($rows["price"]!=$price)
            {
              $sqll = "UPDATE `part` SET `price`= $price WHERE `no` ={$partno}";
              if ($conn->query($sqll) === TRUE) 
              {
                  $msg= "update record successfully";
                  header("Location:partPage.php?message={$msg}");
                } 
                else
                {
                      $msg= "Error: " . $sql . "<br>" . $conn->error;
                      header("Location:partPage.php?message={$msg}");
                }
            }

        
        }
        else
        {

            $sql = "INSERT INTO part(name, no, price) VALUES ('$name',$partno,$price)";
            
            
            if ($conn->query($sql) === TRUE) 
            {
                $msg= "record created successfully";
                header("Location:partPage.php?message={$msg}");
                
                }
            else 
            {
                $msg= "Error: " . $sql . "<br>" . $conn->error;
                header("Location:partPage.php?message={$msg}");
            }
        }
           
            $sqltestt = "SELECT name,pno,count,phone FROM `merchant` where `mno`={$mno}";
        $resulttt = $conn->query($sqltestt);
        if ($resulttt->num_rows > 0)
        {
            $rows = $resulttt->fetch_assoc();
            if(strcmp($rows["name"],$mname) != 0)
            {
              $sqll = "UPDATE `merchant` SET `name`= '{$mname}' WHERE `mno` ={$mno}";
              if ($conn->query($sqll) === TRUE) 
              {
                  $msg= "update record successfully";
                  header("Location:partPage.php?message={$msg}");
                } 
                else
                {
                      $msg= "Error: " . $sqll . "<br>" . $conn->error;
                      header("Location:partPage.php?message={$msg}");
                }
            }
            if($rows["pno"]!=$partno)
            {
              $sqll = "UPDATE `merchant` SET `pno`= $partno WHERE `mno` ={$mno}";
              if ($conn->query($sqll) === TRUE) 
              {
                  $msg= "update record successfully";
                  header("Location:partPage.php?message={$msg}");
                } 
                else
                {
                      $msg= "Error: " . $sqll . "<br>" . $conn->error;
                      header("Location:partPage.php?message={$msg}");
                }
            }
             if($rows["count"]!=$count)
            {
              $sqll = "UPDATE `merchant` SET `count`= $count WHERE `mno` ={$mno}";
              if ($conn->query($sqll) === TRUE) 
              {
                  $msg= "update record successfully";
                  header("Location:partPage.php?message={$msg}");
                } 
                else
                {
                      $msg= "Error: " . $sqll . "<br>" . $conn->error;
                      header("Location:partPage.php?message={$msg}");
                }
            }
            if($rows["phone"]!=$phone)
            {
              $sqll = "UPDATE `merchant` SET `phone`= $phone WHERE `mno` ={$mno}";
              if ($conn->query($sqll) === TRUE) 
              {
                  $msg= "update record successfully";
                  header("Location:partPage.php?message={$msg}");
                } 
                else
                {
                      $msg= "Error: " . $sqll . "<br>" . $conn->error;
                      header("Location:partPage.php?message={$msg}");
                }
            }

        
        }
        else{
            $sql2 = "INSERT INTO merchant(mno,name, pno, count,phone) VALUES ($mno,'$mname',$partno,$count,$phone)";
            if ($conn->query($sql2) === TRUE) 
            {
                $msg= "record created successfully";
                header("Location:partPage.php?message={$msg}");
            } 
            else 
            {
                $msg= "Error: " . $sql2 . "<br>" . $conn->error;
                header("Location:partPage.php?message={$msg}");
            }
        }
?>
