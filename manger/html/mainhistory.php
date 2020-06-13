<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/history.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/foopicker.css">
    <script type="text/javascript" src="../js/foopicker.js"></script>
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
            $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.deliverytime,h.no from `customer` a,`car` c,`history`h WHERE a.id=c.ownerid and c.vin=h.carvin order by h.arrivaltime desc";
            $result = $conn->query($sql);
    ?>

<body>
    <header>
        <button class="search" type="submit"><i class="fa fa-search" onclick="searchService()"></i></button>
        <input type="text" name="search" placeholder="search" onkeyup="searchService();">
        <img src="../img/arrow.png" alt="arrow" id="arrow" onclick="fun()">
        <div id="connt">
        </div>
        
        <div id="cm">
        <input type="text" name="start" id="startDate" value="" placeholder="start date" oninput="searchService();" readonly/>
            <input type="text" name="end" id="endDate" value="" placeholder="end date" oninput="searchService();" readonly />
            <button><img src="../img/printer.png"><a href="../../print/pdf.php" style="color:#1C232C;  text-decoration: none;" target="_blank">print</a></button>
        </div>
        
    </header>
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
                <img src='../brand/{$rows['brand']}.png'>
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
        var foopicker = new FooPicker({
            id: 'startDate',
            dateFormat: 'dd/MM/yyyy',
        });
        var foopicker2 = new FooPicker({
            id: 'endDate',
            dateFormat: 'dd/MM/yyyy'
        });
        var op=false;
        // function open()
        // {consel.log(op);
        //     if(op==false)
        //     {
        //         consel.log('dsd');
        //         document.getElementById('cm').style.display='block';
        //         document.getElementById('connt').style.display='block';
        //         document.getElementById('arrow').style.transform='rotate('+ 180 +'deg)';
        //         op=true;
        //     }
        //     else
        //     {
        //         document.getElementById('cm').style.display='none';
        //         document.getElementById('connt').style.display='none';
        //         document.getElementById('arrow').style.transform='rotate('+ 0 +'deg)';
        //         op=false;
        //     }

        // }
        // When the user clicks anywhere outside of the modal, close it
        var modal = document.getElementById('id01');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        function fun()
        {
            if(op==false)
            {
                document.getElementById('cm').style.display='block';
                document.getElementById('connt').style.display='block';
                document.getElementById('arrow').style.transform='rotate('+ -180 +'deg)';
                op=true;
            }
            else
            {
                document.getElementById('cm').style.display='none';
                document.getElementById('connt').style.display='none';
                document.getElementById('arrow').style.transform='rotate('+ 0 +'deg)';
                op=false;
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

        function searchService(){
            var searchText = $("input[name='search']").val().toLowerCase();
            var startDate = $("input[name='start']").val().toLowerCase();
            var endDate = $("input[name='end']").val().toLowerCase();
            $.post("searchHistory.php", {searchVal:searchText,start:startDate,end:endDate},function(output){
                 $("#hiis").html(output);

            });
        }
    </script>
</body>

</html>