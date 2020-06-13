<?php 
$servername = "sql302.epizy.com";
$username = "epiz_25613163";
$password = "FA3c2XY3aWljTX";
$dbname='epiz_25613163_CMMS';
$conn = new mysqli($servername, $username, $password,$dbname);
$sSQL= 'SET CHARACTER SET utf8';                                                               
mysqli_query($conn,$sSQL) or die ('Can\'t charset in Base');
if(!empty($_POST['searchVal'])&&!empty($_POST['start'])&&!empty($_POST['end']))
{
    $valueToSearch = $_POST['searchVal'];
    $valueToStart = $_POST['start'];
    $valueToStart = str_replace('/', '-', $valueToStart);
    $x=strtotime($valueToStart);
    $valueToStart=strval(date('Y-m-d', $x));

    $valueToEnd = $_POST['end'];
    $valueToEnd = str_replace('/', '-', $valueToEnd);
    $x=strtotime($valueToEnd);
    $valueToEnd=strval(date('Y-m-d', $x));

    $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin and c.plateno LIKE '%".$valueToSearch."%' and h.arrivaltime >= '{$valueToStart}' and h.arrivaltime <= '{$valueToEnd}' order by h.arrivaltime desc";
}
else if(!empty($_POST['searchVal'])&&!empty($_POST['start']))
{
    $valueToSearch = $_POST['searchVal'];
    $valueToStart = $_POST['start'];
    $valueToStart = str_replace('/', '-', $valueToStart);
    $x=strtotime($valueToStart);
    $valueToStart=strval(date('Y-m-d', $x));
    $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin and c.plateno LIKE '%".$valueToSearch."%' and h.arrivaltime >= '{$valueToStart}' order by h.arrivaltime desc";
}
else if(!empty($_POST['searchVal'])&&!empty($_POST['end']))
{
    $valueToSearch = $_POST['searchVal'];
    $valueToEnd = $_POST['end'];
    $valueToEnd = str_replace('/', '-', $valueToEnd);
    $x=strtotime($valueToEnd);
    $valueToEnd=strval(date('Y-m-d', $x));
    $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin and c.plateno LIKE '%".$valueToSearch."%' and h.arrivaltime <= '{$valueToEnd}' order by h.arrivaltime desc";
}
else if(!empty($_POST['start'])&&!empty($_POST['end']))
{
    $valueToStart = $_POST['start'];
    $valueToStart = str_replace('/', '-', $valueToStart);
    $x=strtotime($valueToStart);
    $valueToStart=strval(date('Y-m-d', $x));

    $valueToEnd = $_POST['end'];
    $valueToEnd = str_replace('/', '-', $valueToEnd);
    $x=strtotime($valueToEnd);
    $valueToEnd=strval(date('Y-m-d', $x));
    $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin and h.arrivaltime >= '".$valueToStart."' and h.arrivaltime <= '{$valueToEnd}' order by h.arrivaltime desc";
}
else if(!empty($_POST['end']))
{
    $valueToEnd = $_POST['end'];
    $valueToEnd = str_replace('/', '-', $valueToEnd);
    $x=strtotime($valueToEnd);
    $valueToEnd=strval(date('Y-m-d', $x));
    $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin and h.arrivaltime <= '".$valueToEnd."' order by h.arrivaltime desc";
}
else if(!empty($_POST['start']))
{
    $valueToStart = $_POST['start'];
    $valueToStart = str_replace('/', '-', $valueToStart);
    $x=strtotime($valueToStart);
    $valueToStart=strval(date('Y-m-d', $x));
    $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin and h.arrivaltime >= '".$valueToStart."' order by h.arrivaltime desc";
}
else 
{


    $valueToSearch = $_POST['searchVal'];
    $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin and c.plateno LIKE '%".$valueToSearch."%' order by h.arrivaltime desc";
}
if(isset($_POST['start'])||isset($_POST['end'])||isset($_POST['searchVal'])){

    $result= mysqli_query($conn,$sql);
    
    while($rows = mysqli_fetch_array($result)){
        // $output.=" <tr>
        //  <td>".$row['name']."</td> <td>".$row['price']."</td>
        // </tr> ";
        $output.= '<section onclick= " '."document.getElementById('id01').style.display='block' " .'">'
                . "<div>".
                "<span class='h'>{$rows['brand']}</span><span class='h'>{$rows['model']}</span> <span class='h'>{$rows['year']}</span> <span class='row'>Plate NO. :</span> <span>{$rows['plateno']}</span>".
                "</div>".
                "<div>".
                "<span>Time arrived :</span><span>{$rows['arrivaltime']}</span><span class='row'>Time delvariy :</span><span>{$rows['deliverytime']}</span>".
                "</div>". 
                "<div>".
                "<span>Name :</span> <span>{$rows['name']}</span>".
                "</div>
                <div></div>
                <img src='../brand/{$rows['brand']}.png'>
                </section>" ;
            }
            }
            echo ($output);  
            
?>

