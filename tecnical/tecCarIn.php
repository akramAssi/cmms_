    <!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css\menuStyle.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js\clock.js"></script>
    <script>
    function ch(st,e,en,s)
        {
            // console.log("ok1");
            if(document.getElementById(s).innerHTML=="inservice")
            {
                document.getElementById(st).style.display="none";
                document.getElementById(e).style.display="inline-block";
                document.getElementById(en).style.display="inline-block";
            }
            if(document.getElementById(s).innerHTML=="finished")
            {
                document.getElementById(st).style.display="none";
                document.getElementById(e).style.display="none";
                document.getElementById(en).style.display="none";
            }
        }
    </script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/history.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
    // echo $_POST['message'];
    session_start();
    if(!isset($_SESSION['user']))
    {
        header("REFRESH:0;URL=../../index.php");
        echo
            "
            <script>
            window.parent.location='../index.php'
            </script>
            ";
    }

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
<body>
    <div class="history" id="hiis">
        <?php
                
                if ($result->num_rows > 0) 
                {
                    $i=1;
                    while($rows = $result->fetch_assoc())
                    {
                ?>
                        
                        <?php echo '<section  ondblclick= " show'." (' ".$rows['no']. " '); " .'">' ?>
                            <div>
                                <span class='h'><?php echo $rows['brand']; ?></span>
                                <span class='h'><?php echo $rows['model']; ?></span>
                                <span class='h'><?php echo $rows['year']; ?></span>
                                <span class='row'>Plate NO. :</span>
                                <span><?php echo $rows['plateno']; ?></span>
                                <span class='row'>States :</span>
                                <span style="color:red" id="<?php echo  's'.$i;?>"><?php echo  $rows['status']; ?></span>
                            </div>
                            <div>
                                <span>Time arrived :</span>
                                <span><?php echo $rows['arrivaltime']; ?></span>
                                <span class='row'>Technical name :</span>
                                <span id="<?php echo  'tm'.$i;?>"><?php echo $rows['tech name']; ?></span>
                                
                            </div>
                            <div>
                                <span>Name :</span> 
                                <span><?php echo $rows['name']; ?></span>
                            </div>
                            <div></div>
                            <img src='./brand/<?php echo $rows['brand'];?>.png' class='img' onload="ch('<?php echo  'st'.$i;?>','<?php echo  'e'.$i;?>','<?php echo  'en'.$i;?>','<?php echo  's'.$i;?>');">
                             <mydiv  class='hisBut' style=';'>
                            <img src='image/play.png' title='start' id="<?php echo  'st'.$i;?>" style='position:static;width: 30px;display:inline-block;'  onclick="start(<?php echo  $rows['no'];?>,'<?php echo  'st'.$i;?>','<?php echo  'e'.$i;?>','<?php echo  'en'.$i;?>','<?php echo  's'.$i;?>','<?php echo  'tm'.$i;?>');">
                            <img src='image/edit.png' title='edit' id="<?php echo  'e'.$i;?>" style='position:static;width: 30px;display:none;' onclick="openEdit(<?php echo  $rows['no'];?>)">
                            <img src='image/end.png' title='end' id="<?php echo  'en'.$i;?>" style='position:static;width: 30px;display:none;' onclick="end(<?php echo  $rows['no'];?>,'<?php echo  'st'.$i;?>','<?php echo  'e'.$i;?>','<?php echo  'en'.$i;?>','<?php echo  's'.$i;?>','<?php echo  'tm'.$i;?>')">
                            </mydiv>
                        </section>

                <?php
                        $i++;
                        }
                    }
                    else { echo "0 results"; }
                $conn->close();
                ?>
       
       
    </div>

    <div id="id02" class="modal">
        <div class="pop20" id="inf">
           <textarea id="dd"></textarea>
           <div id="downside" >
            <input type="submit" value="send"  class="butt cancel" id="edit"> 
            <input type="button" value="cancel" class="butt save" 
                onclick="document.getElementById('id02').style.display='none'">  
        </div>
        <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
     </div>
     
    <div id="id01" class="modal">
        <div class="pop" id="inff">
           
        </div>
    </div>
    <script type="text/javascript">
    function openEdit(id)
    {
        document.getElementById('id02').style.display="block";
        var ed=document.getElementById("edit");
        ed.addEventListener('click', function() { 
           edit(id);
        }); 
        xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('dd').value=this.responseText;
                    console.log(this.responseText);
                }
            };
            xmlhttp.open("POST", "showNote.php", true);
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
            xmlhttp.send("id="+id); 

    }
          function edit(id) {
            // document.getElementById('myBtn').style.display='inline';
            document.getElementById('id02').style.display="none";
            var val=document.getElementById('dd').value;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                }
            };
            xmlhttp.open("POST", "editHistory.php", true);
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
            xmlhttp.send("id="+id+"&note="+val); 
          }

          var modal = document.getElementById('id02');
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
        }
        ///////////////
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
                    document.getElementById("inff").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("POST", "detail.php", true);
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
            xmlhttp.send("id="+id); 
        
        }
        
        function start(id,st,e,en,s,tm)
        {
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() 
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                        document.getElementById(st).style.display="none";
                        document.getElementById(e).style.display="inline-block";
                        document.getElementById(en).style.display="inline-block";
                        document.getElementById(s).innerHTML = this.responseText;
                        document.getElementById(tm).innerHTML = "<?php echo  $_SESSION['user'];?>";
                        
                    }
                };
                xmlhttp.open("POST", "startService.php", true);
                xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
                xmlhttp.send("id="+id);

        }
        setInterval(reff, 2500);
        function reff(){
            
            $.post("ref.php", {searchVal:123},function(output){
                 $("#hiis").html(output);

            });
        }
        function end(id,st,e,en,s,tm)
        {
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() 
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                        if (this.responseText=="finished")
                        {
                            document.getElementById(st).style.display="none";
                            document.getElementById(e).style.display="none";
                            document.getElementById(en).style.display="none";
                            document.getElementById(s).innerHTML = this.responseText;
                        }
                        else{
                            alert(this.responseText);
                        }
                        
                    }
                };
                xmlhttp.open("POST", "endService.php", true);
                xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
                xmlhttp.send("id="+id);

        }
    </script>


</body>

</html>