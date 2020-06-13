<?php 
$servername = "sql302.epizy.com";
$username = "epiz_25613163";
$password = "FA3c2XY3aWljTX";
$dbname='epiz_25613163_CMMS';
$conn = new mysqli($servername, $username, $password,$dbname);
if(isset($_POST['searchVal'])){
    $valueToSearch = $_POST['searchVal'];
    $sql = "SELECT  m.name as partname,  m.price as partprice,  m.no as partno , c.name as mname,c.mno, c.resdate,  c.phone ,c.count FROM part m , merchant c where c.pno = m.no and m.name LIKE'%".$valueToSearch."%'";
    $result= mysqli_query($conn,$sql);
    echo "<tr>
            <th>PartNo.</th>
            <th>name</th>
            <th>count</th>
            <th>price</th>
        </tr>";
                
               while($row = mysqli_fetch_array($result))
                    {
                       $output.=" <tr style='text-align:center;'>
                            
                            <td style=' width:13% '><span class='details' title='more details' ><img src='../img/d_arrow.png' style='padding-right: 5px;'></span>". $row["partno"]."</td>
                            <td style' width:40%'>".$row["partname"]."</td>
                            <td style' width:20'>".$row["count"]."</td>
                            <td >".$row["partprice"]."$</td>
                        </tr>
                        <tr style='display:none'>
                            <td>".$row["mno"]."</td>
                            <td>".$row["mname"]."</td>
                            <td>".$row["phone"]."</td>
                            <td>". $row["resdate"]."</td>
                        </tr>";
                
                        }
                
                
}
            echo($output);
?>