<?php 
$servername = "sql302.epizy.com";
$username = "epiz_25613163";
$password = "FA3c2XY3aWljTX";
$dbname='epiz_25613163_CMMS';
$conn = new mysqli($servername, $username, $password,$dbname);
$sSQL= 'SET CHARACTER SET utf8';                                                               
mysqli_query($conn,$sSQL) or die ('Can\'t charset in Base');
if(isset($_POST['submit']))
{
    if(isset($_POST['name']) && isset($_POST['price']))
    {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sql = "INSERT INTO `service1`(`price`, `name`) VALUES($price, '$name')";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $msg= "New record created successfully";
            header("Location:problem.php?message={$msg}");  
        }
        else{
            $msg= "Error: " . $sql . "" . mysqli_error();
            header("Location:problem.php?message={$msg}");
        }

    }

}

?>