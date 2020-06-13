<?php
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
$sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.`tech name`,v.status, h.no from customer a,`car` c,`history`h,`vic` v WHERE a.id=c.ownerid and c.vin=h.carvin and h.no=hno order by h.arrivaltime desc";
            $result = $conn->query($sql);
            
?>    
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="..\CSS osama\history.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="history" title="more title" id="hiis">
        
        <?php
                
                if ($result->num_rows > 0) 
                {
                    while($rows = $result->fetch_assoc())
                    {
                ?>
                        <section onclick= "show('<?php echo $rows['no'];?>');" >
                            <div>
                                <span class='h'><?php echo $rows['brand']; ?></span>
                                <span class='h'><?php echo $rows['model']; ?></span>
                                <span class='h'><?php echo $rows['year']; ?></span>
                                <span class='row'>Plate NO. :</span>
                                <span><?php echo $rows['plateno']; ?></span>
                                <span class='row'>States :</span>
                                <span style="color:red"><?php echo  $rows['status']; ?></span>
                            </div>
                            <div>
                                <span>Time arrived :</span>
                                <span><?php echo $rows['arrivaltime']; ?></span>
                                <span class='row'>Technical name :</span>
                                <span><?php echo $rows['tech name']; ?></span>
                                
                            </div>
                            <div>
                                <span>Name :</span> 
                                <span><?php echo $rows['name']; ?></span>
                            </div>
                            <div></div>
                            <img src='../brand/<?php echo $rows['brand'];?>.png'>
                        </section>

                <?php
                        }
                    }
                    else { echo "no car in center"; }
                $conn->close();
                ?>

        

    </div>
    <div id="id01" class="modal">
        <div class="pop20" id="inf">
           
        </div>
     </div>
     <script>
         function delivery(id)
         {
          window.location.href = "delv.php?id="+id;   
         }
         function show(id) 
        {
            document.getElementById('id01').style.display="block";
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("inf").innerHTML = this.responseText;
                var ed=document.getElementById("delv");
                ed.addEventListener('click', function() { 
                delivery(id);
                });
            }
        };
        xmlhttp.open("POST", "note.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        xmlhttp.send("id="+id);
        
        }
        setInterval(reff, 2500);
        function reff(){
            
            $.post("refIN.php", {searchVal:123},function(output){
                 $("#hiis").html(output);

            });
        }
     </script>
        <?php
    if(!empty($_GET['message']))
        {
            echo "<script>alert('{$_GET['message']}');</script>";
            // echo $_GET['message'] ;
        }
    ?>
</body>

</html>