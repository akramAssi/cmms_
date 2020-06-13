    <?php
 if($_SERVER['REQUEST_METHOD']=='POST')
    {
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
        
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $photo = "../img/download.jpeg";
        echo $_POST['img'];
         if (is_uploaded_file($_FILES['img']['tmp_name'])) 
         {
             $file = addslashes(file_get_contents($_FILES["img"]["tmp_name"]));
             $sql_img="UPDATE `customer` SET `photo`='{$file}' WHERE `id`= {$_SESSION['id']}";
             if ($conn->query($sql_img) === TRUE) 
             {
              $_SESSION['img']=file_get_contents($_FILES["img"]["tmp_name"]);
             }

         }
         
        $sql = "UPDATE `customer` SET `address`='$address',`phone`=$phone,`email`='$email' where `id`= {$_SESSION['id']} ";    
        
        if ($conn->query($sql) === TRUE) 
        {
            echo
            "
            <script>
            parent.location.reload();
            </script>
            ";
            
            exit;
            } else {
                echo
            "
            <script>
            parent.location.reload();
            </script>
            ";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else
    {
        echo
            "
            <script>
            parent.location.reload();
            </script>
            ";
        echo "You Can't Brwose This Page Directly ";
    }
?>
