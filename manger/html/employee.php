<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/employee.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <div class="button">
        <img src="../img/plus.png" onclick="document.getElementById('id01').style.display='block';">
        <img src="../img/min.png" onclick="document.getElementById('id02').style.display='block';">
    </div>
    <?php
    
            if(!empty($_GET['message']))
        {
            echo "<script>alert('{$_GET['message']}');</script>";
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
            $sql = "SELECT `user id` ,name,photo,department,work FROM `Employee` ORDER BY work DESC";
            $result = $conn->query($sql);
    ?>
    <div class="addinfo">
        <div id="id01" class="modal">
            <div class="pop">
                <form action="addemp.php" method="POST">
                    <div class="input">
                        <input type="text" name="name" placeholder="employee name" required><br>
                        <input type="text" name="id"  placeholder="employee ID" required >

                        <select id="leadType" class="box2" name="job" required>
                        <option data-tokens="manger">manger</option>
                        <option data-tokens="expert mustard">expert</option>
                        <option data-tokens="technical">technical</option>
                       </select>
                    
                    </div>
                    <div id="downside">
                        <input type="submit" value="Add" class="butt save">
                        <input type="button" value="Cancel" class="butt cancel" onclick="document.getElementById('id01').style.display='none'">
                    </div>
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                </form>
            </div>

        </div>

        <div id="id02" class="modal">
            <div class="pop" style="height: 230px;">
                <form action="delemp.php" method="POST">
                    <div class="input">
                        <input type="text" name="id" placeholder="employee id" ><br>
                    </div>
                    <div id="downside">
                        <input type="submit" value="remove" class="butt save">
                        <input type="button" value="Cancel" class="butt cancel" onclick="document.getElementById('id02').style.display='none'">
                    </div>
                    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                </form>
            </div>

        </div>

        <div id="id03" class="modal">
            <div class="pop"  id="inf">
                    
            </div>

        </div>

    </div>
    <!-- ////////////////////////////////////////// -->

    <div class="info">
        <?php
         if ($result->num_rows > 0)
        {
            $yes="y";
            while($rows = $result->fetch_assoc())
            {
                
                if(!empty($rows['photo'])=="")
                {
                    $img='<img src="../img/my.png"></img>';
                }
                else
                {
                    $img='<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($rows['photo']).'"></img>';
                }
                if(strcmp($rows["work"],$yes) !== 0)
                {
                    echo ' <div style="background:#ddd;" class="rectangle" onclick="show'." (' ".$rows['user id']. " '); ".' "> 
                    '.$img.'
                    <div style="text-overflow: ellipsis;white-space: nowrap;width: 160px;overflow: hidden;">'.$rows['name'].'</div>
                    <div >'.$rows['department'].'</div>
                    </div>';
                }
                else
                {
                    echo ' <div class="rectangle" onclick="show'." (' ".$rows['user id']. " '); ".' "> 
                    '.$img.'
                    <div style="text-overflow: ellipsis;white-space: nowrap;width: 160px;overflow: hidden;">'.$rows['name'].'</div>
                    <div >'.$rows['department'].'</div>
                    </div>';
                }
            }
        }
        ?>
    </div>

    <script>
        var modal = document.getElementById('id01');
        var modal1 = document.getElementById('id02');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            } else if (event.target == modal1) {
                modal1.style.display = "none";
            }
        }
        function show(id) 
        {
            document.getElementById('id03').style.display="block";
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("inf").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "build_info.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        xmlhttp.send("id="+id);
        
    }
    
    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
    </script>
    <?php

    ?>

</body>

</html>