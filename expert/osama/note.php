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
    $sql = "SELECT `othernote` FROM `history` WHERE `no`={$id}";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
    }

?>
 
 
 <div id="dd">
           <?php 
           if(empty($row['othernote'])||$row['othernote']==""||$row['othernote']==" ")
           {
               echo "no note";
           }
           else
           {
               echo $row['othernote'];
           }
           ?>
</div>
<div id="downside" >
    <input type="submit" value="edit"  class="butt save" style="visibility:hidden"> 
    <input type="button" value="delivery" id="delv" class="butt cancel" 
        onclick="document.getElementById('id01').style.display='none'">  
</div>
<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>