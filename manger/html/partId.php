<?php 
$servername = "sql302.epizy.com";
$username = "epiz_25613163";
$password = "FA3c2XY3aWljTX";
$dbname='epiz_25613163_CMMS';
$conn = new mysqli($servername, $username, $password,$dbname);
if(isset($_POST['searchVal'])){
    $valueToSearch = $_POST['searchVal'];
    $sql = "SELECT  m.name as partname,  m.price as partprice,  m.no as partno , c.name as mname, c.resdate,  c.phone ,c.count,c.mno FROM part m , merchant c where c.pno = m.no and m.no=$valueToSearch";
    $result= mysqli_query($conn,$sql);
                if ($result->num_rows > 0){

               $row = mysqli_fetch_array($result);
               
                    for ($i = 0; $i < count($row); $i++) {
                    echo $row[$i] . ",";
                }
                }
                else
                {
                    echo "not";
                }

}
            
?>