<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\CSS osama\menuStyle.css">
    <link rel="stylesheet" type="text/css" href="..\CSS osama\homePageContant.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="..\js osama\clock.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



    <title></title>
</head>
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
    $sql = "SELECT o.name,c.brand,v.`status` FROM `vic` v,`car` c,`history` h,`customer` o WHERE o.id=c.ownerid and c.vin=h.carvin and h.no=v.hno LIMIT 3";
    $result = $conn->query($sql);
    
           
            
?>
<body onload="startTime()" style="overflow-y: scroll;">
    <div class="row">
        <div class="col-sm-11 ">
            <b>
        <p style="text-align: right;margin-right: 2%; margin-top: 2%;" id="demo"></p>
      </b>
        </div>
    </div>
    <div class="container1">
        <div class="row">
            <div class="bodyDivsO">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <h3 class="hee"><b>Owner</b></h3>
                            </th>
                            <th>
                                <h3 class="hee"><b>Brand</b></h3>
                            </th>
                            <th>
                                <h3 class="hee"><b>Status</b></h3>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result->num_rows > 0) 
                    {
                        while($row = $result->fetch_assoc())
                        {
                            echo
                            "
                            <tr>
                                <td>{$row['name']}</td>
                                <td>{$row['brand']}</td>
                                <td>{$row['status']}</td>
                            </tr>
                            ";
                        }
                    }
                    ?>
                        
                    </tbody>
                </table>
            </div>
            <?php
            $sql = "SELECT count(*) as no FROM `vic`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
                $row = $result->fetch_assoc();
                $no=$row['no'];
                echo
                "
                <div class='bodyDivs2O'>
                <h1 style='text-align: center;font-size: 900%;' id='countCar'>{$no}</h1>
                <h3 style='text-align: center;'>car in center</h3>
                </div>
                ";
            }
            ?>
            
        </div>
        <div class="row rowButton ">

            <div class="butt d-flex justify-content-between">
                <a href='AddCar.php'>
                    <button type="button" class="bodybutton1car">Add car</button>
                </a>
                <a href='NewService.php'>
                    <button type="button" class="bodybutton1">New service</button>
                </a>
            </div>
        </div>

        <div class="row rowButton ">

            <div class="col-sm-8 d-flex justify-content-between">
                <a href='#'>
                    <button type="button" class="bodybutton1" onclick="document.getElementById('id01').style.display='block' ">New cutamer</button>
                </a>
            </div>
        </div>


    </div>
    </div>
    <div id="id01" class="modal">
        <div class="pop">
            <form action="customerF.php" method="post">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <input type="text" name="name" placeholder="Custamer name">
                <input type="text" name="id" placeholder="Custamer ID">
                <input type="text" name="phone" placeholder="phone number">
                <input list="address" name="address" placeholder="address">
                <datalist id="address">
                  <option value="Jerusalem">
                  <option value="Nablus">
                  <option value="Hebron">
                  <option value="Tulkarm">
                  <option value="Qalqilyah">
                  <option value="Bayt Hanun">
                  <option value="Janin">
                  <option value="Tubas">
                  <option value="Salfit">
                  <option value="Birqin">
                  <option value="Ramallah">
              </datalist>
                <input type="text" name="email" placeholder="Email">

                <div id="downside">
                    <input type="submit" value="Add" class="butt save">
                    <input type="button" value="Cancel" class="butt cancel" onclick="document.getElementById('id01').style.display='none'">
                </div>
            </form>
            
            <!-- <img src="./close.png" onclick="document.getElementById('id01').style.display='none'"> -->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type "text/javascript">
    setInterval(fcount, 5000);
    function fcount()
    {
        $.post("countCar.php",function(output){
                $("#countCar").html(output);

        });
    }
        
    
    
    
    </script>
    <?php
    if(!empty($_GET['message']))
        {
            $cxxx=$_GET["message"];
            echo '<script>alert("'.$cxxx.'");</script>';
            // echo $_GET['message'] ;
        }
    ?>
</body>

</html>