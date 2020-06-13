<?php
    $servername = "sql302.epizy.com";
    $username = "epiz_25613163";
    $password = "FA3c2XY3aWljTX";
    $dbname='epiz_25613163_CMMS';


    $conn = new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $id=$_POST['id'];
    $sql = "SELECT `user id`, `name`, `address`, `phone number`, `email`, `work` FROM `Employee` WHERE `user id` ={$id}";
    $result = $conn->query($sql);
?>

<?php 
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
?>
<table>
<tr>
    <td>name</td>
    <td style="width: 1px;">:</td>
    <td style="word-break: break-all;"><?php echo $row['name'];  ?></td>
</tr>
<tr>
    <td>ID</td>
    <td style="width: 1px;">:</td>
    <td style="word-break: break-all;"><?php echo $row['user id'];  ?></td>
</tr>
<tr>
    <td>phone</td>
    <td style="width: 1px;">:</td>
    <td style="word-break: break-all;">0<?php echo $row['phone number'];  ?></td>
</tr>
<tr>
    <td>email</td>
    <td style="width: 1px;">:</td>
    <td style="word-break: break-all;"><?php echo $row['email'];  ?></td>
</tr>
<tr>
    <td>address</td>
    <td style="width: 1px;">:</td>
    <td style="word-break: break-all;"><?php echo $row['address'];  ?></td>
</tr>
<tr>
    <td>work</td>
    <td style="width: 1px;">:</td>
    <td style="word-break: break-all;">
    <?php 
    $yes="n";
    if(strcmp($row["work"],$yes) !== 0)
       echo "is work";
    else
    {
      echo "not work yet";
    } 
     ?></td>
</tr>
</table> 
<?php
        }
        else 
        { $msg= "0 results";
        header("Location:employee.php?message={$msg}"); }
        $conn->close();
 ?>
<span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>