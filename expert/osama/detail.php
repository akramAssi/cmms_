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
    $sql = "SELECT `starttime`, `endtime`, `expert name`, `tech name`,`desowner` FROM `history` WHERE `no`={$id}";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
    }

?>

 <table >
    <tr>
        <td style="width: 27%;">Name expert :</td>
        <td style="width: 77%;"><?php echo $row['expert name']  ?></td>
    </tr>
    <tr>
        <td style="width: 25%;">Name Tech :</td>
        <td style="width: 80%;"><?php echo $row['tech name']  ?></td>
    </tr>
    <tr>
        <td style="width: 25%;">Start time :</td>
        <td style="width: 80%;"><?php echo $row['starttime']  ?></td>
    </tr>
    <tr>
       
        <td style="width: 25%;">end time :</td>
        <td style="width: 80%;"><?php echo $row['endtime']  ?></td>
    </tr>
    <tr>
       
        <td style="width: 25%;">desc_owner</td>
        <td style="width: 80%;"><?php echo $row['desowner']  ?></td>
    </tr>
</table>
<section style="margin-top: 20px;">
    <table >
        <tr>
            <td>description </td>
            <td>price</td>
        </tr>
        <?php
     $id=$_POST['id'];
    $sql = "select p.name,p.price FROM `part` p,`descpart` d WHERE d.pno=p.no and d.hno ={$id} UNION select p.name,p.price FROM `service1` p,`descservice` d WHERE d.sno=p.no and d.hno ={$id}";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($rows = $result->fetch_assoc())
        {
            echo
            "
            <tr>
                <td>{$rows['name']} </td>
                <td>{$rows['price']}</td>
            </tr>
            ";
        }
    }
    ?>

    </table>
</section>
<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>