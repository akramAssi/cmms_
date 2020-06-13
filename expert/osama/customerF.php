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
        $name = $_POST['name'];
        $id = $_POST['id'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $sql = "INSERT INTO customer(name, id, address, phone, email, nvisit) VALUES ('$name',$id,'$address',$phone,'$email',0)";
        if ($conn->query($sql) === TRUE) 
        {
            $msg= "record created successfully";
            header("Location:custamer.php?message={$msg}");
            
            } else {
            $msg= "Error: " . $sql . "<br>" . $conn->error;
            header("Location:custamer.php?message={$msg}");
        }
    }
    else
    {
        $msg= "You Can't Brwose This Page Directly ";
        header("Location:custamer.php?message={$msg}");
    }
?>
