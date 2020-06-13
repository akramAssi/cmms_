<?php 
$servername = "sql302.epizy.com";
$username = "epiz_25613163";
$password = "FA3c2XY3aWljTX";
$dbname='epiz_25613163_CMMS';
$conn = new mysqli($servername, $username, $password,$dbname);
 if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
if(isset($_POST['searchVal']))
{
    $valueToSearch = $_POST['searchVal'];
    $sql = "SELECT * FROM `customer` WHERE `name` LIKE '%".$valueToSearch."%' or id LIKE '%{$valueToSearch}%' ";
    // $result= mysqli_query($conn,$sql);
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc())
    {
        $pho=$row['photo'];
        $output.="
            <section >
                <div>
                    <span>ID :</span>
                <span> {$row['id']}</span>
                <span class='name'>name :</span>
                <span class='name1'>{$row['name']}</span>
                </div>
                <div>
                <span>phone :</span><span>{$row['phone']}</span>
                <span>address :</span><span>{$row['address']}</span>
                </div>
                <div>
                <span>email :</span> <span> {$row['email']}</span>
                </div>
                <div></div>
                <img src='{$pho}'>
            </section>
";
    }
}
            echo ($output);  
            
?>
