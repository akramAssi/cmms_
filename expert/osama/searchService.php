<?php 
$servername = "sql302.epizy.com";
$username = "epiz_25613163";
$password = "FA3c2XY3aWljTX";
$dbname='epiz_25613163_CMMS';
$conn = new mysqli($servername, $username, $password,$dbname);
$sSQL= 'SET CHARACTER SET utf8';                                                               
mysqli_query($conn,$sSQL) or die ('Can\'t charset in Base');
if(isset($_POST['searchVal'])){
    $valueToSearch = $_POST['searchVal'];
    $sql = "SELECT * FROM `service1` WHERE `name` LIKE '%".$valueToSearch."%'";
    $result= mysqli_query($conn,$sql);
    echo "<tr>
            <th>service</th>
            <th>Price</th>
                </tr>";
    while($row = mysqli_fetch_array($result)){
        $output.=" <tr>
         <td>".$row['name']."</td> <td>".$row['price']."</td>
        </tr> ";
            }
            }
            echo ($output);  
            
?>