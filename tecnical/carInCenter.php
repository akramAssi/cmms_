<?php

session_start();
if(!isset($_SESSION['user']))
{
    header("REFRESH:0;URL=../index.php");
}
?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/history1.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <?php
    // echo $_POST['message'];
        
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
            $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime,h.no from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin and `tech name` LIKE '%{$_SESSION['user']}%' order by h.arrivaltime desc";
            $result = $conn->query($sql);
    ?>

<body>
    <div class="history" title="more title" id="hiis">
        <?php
        if ($result->num_rows > 0)
        {
            while($rows = $result->fetch_assoc())
            {
                echo '<section onclick= " show'." (' ".$rows['no']. " '); " .'">'
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
                <img src='brand/{$rows['brand']}.png'>
                </section>" ;
            } 
        } 
      
        ?>


    </div>
    <div id="id01" class="modal">
        <div class="pop" id="inf">
           
        </div>
    </div>

    <script type="text/javascript">
        
        // When the user clicks anywhere outside of the modal, close it
        var modal = document.getElementById('id01');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        
        function show(id) 
        {
            document.getElementById('id01').style.display="block";
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("inf").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "detail.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        xmlhttp.send("id="+id);
        
        }

        
    </script>
</body>

</html>