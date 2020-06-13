<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="..\CSS osama\menuStyle.css">
    <link rel="stylesheet" type="text/css" href="..\CSS osama\homePageContant.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <script src="..\js osama\clock.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>




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

    $sql = "SELECT `name`FROM `customer`";
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
    <div id="cardms"  >
        <p>Please check customer name or customer record</p>
        <a onclick="window.parent.document.getElementById('custamer').click();">
        <img src="../img/finger.png" id="ar_lef" width="30px;">
        <img src="../img/plus.png"width="30px" style="margin-left:10px;">
        </a>
        <span onclick="document.getElementById('cardms').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <div class="container">
        <form action="saveCar.php" method="POST">

            <div class="row">
                <div class="col-sm-4" >
                    <p class="formRight">
                        
                        <input list="namecust" class="form-control" id="usr1" name="namecust" placeholder="Name Customer" autocomplete="off" onkeyup="findCar();" required>
                        <input type="text" name="id" id="oid" value="" style="display:none;" required>
                        <datalist id="namecust">
                            <?php
                                    if ($result->num_rows > 0) 
                                    {
                                        while($row = $result->fetch_assoc())
                                        {
                                            echo '<option value="'.$row['name'].'">';
                                        }
                                    }
                            ?>
                        </datalist>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="pwd">Manufacturer:</label>
                </div>

                <div class="col-sm-4">
                    <p class="formRight">
                        <select id="leadType" class="box2" name="Manufacturer" onchange="selectModel()" required>
                        <option data-tokens="empty">---</option>
                        <option data-tokens="BMW">BMW</option>
                        <option data-tokens="audi">audi</option>
                        <option data-tokens="ford">ford</option>
                        <option data-tokens="mercedes">mercedes</option>
                        <option data-tokens="opel">opel</option>
                        <option data-tokens="peugeot">peugeot</option>
                        <option data-tokens="seat">seat</option>
                        <option data-tokens="vw">vw</option>
                        </select>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label for="pwd">Model:</label>
                </div>
                
                <div class="col-sm-4">
                    <p class="formRight">
                        <input list="model" class="form-control" name="model" placeholder="model"  autocomplete="off"required>
                        <datalist id="model">
                          
                      </datalist>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="pwd">Vin:</label>
                </div>

                <div class="col-sm-4">
                    <p class="formRight">
                        <input type="text" class="form-control" name="Vin" onkeyup="findVin();" id="vin"  maxlength="17" pattern="[A-Za-z0-9]{17}" autocomplete="off" id="usr" required>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="pwd">Plate number:</label>
                </div>

                <div class="col-sm-4">
                    <p class="formRight">
                        <input type="text" class="form-control" name="PalteNumber" maxlength="7" onkeyup="findPl();" id="plate" pattern="[a-z0-9]{6-7}" autocomplete="off" required>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label for="pwd">Year:</label>
                </div>

                <div class="col-sm-4">
                    <p class="formRight">
                        <input type="text" class="form-control" name="Year" maxlength="4"  pattern="\d{4}" autocomplete="off" id="usr required">
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <label for="pwd">Fuel:</label>
                </div>

                <div class="col-sm-4">
                    <p class="formRight">
                        <select id="leadType" class="box2" name="Fuel"  required>
                        <option data-tokens="AAAAA mustard">Petrol</option>
                        <option data-tokens="BBBBB">diesel</option>
                       </select>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="bto">
                    <div class="d-flex align-items-start flex-column">
                        <input type="submit" name="submit" class="bodybuttonaadd">
                    </div>
                </div>
                <div class="bto">
                    <div class="d-flex align-items-end flex-column">
                        <a href='home.php'>
                            <button type="button" class="bodybuttoncancel">Cancel</button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script>
var ownerid;
function findCar() 
    {
        var id=document.getElementById('usr1').value;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                var xx=this.responseText.split(",");
                ownerid=xx[0];
                if(xx[1].includes("noCarIsFound")==true)
                {
                    document.getElementById('cardms').style.display='block';//1
                    document.getElementById('usr1').style.borderColor="#FF5050";
                    document.getElementById('oid').value=ownerid;
                }
                else
                {
                    document.getElementById('oid').value=ownerid;
                    document.getElementById('cardms').style.display='none';//1
                    document.getElementById('usr1').style.borderColor="#66FF66";
                }
            }
        };
        xmlhttp.open("POST", "shcust.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        xmlhttp.send("searchVal="+id);
    
    }
    function findVin() 
    {
        var id=document.getElementById('vin').value;
        var id1=document.getElementById('plate').value;
        xmlhttp = new XMLHttpRequest();
       
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                var xx=this.responseText.split(",");
                if(xx[1].includes("noCarIsFound")==false)
                {
                    
                    document.getElementById('vin').style.borderColor="#FF5050";
                    
                }
                else
                {
                    document.getElementById('vin').style.borderColor="#66FF66";
     
                }
                
                if( id==''){
                    document.getElementById('vin').style.borderColor=" #E5E5E5";
                }
                 
            }
            
        };
         
        xmlhttp.open("POST", "chickvinpl.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        xmlhttp.send("searchVal="+id);
    
    }
    function findPl() 
    {
        var id=document.getElementById('plate').value;
        xmlhttp = new XMLHttpRequest();
       
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                var xx=this.responseText.split(",");
                if(xx[1].includes("noCarIsFound")==false)
                {
                    
                    document.getElementById('plate').style.borderColor="#FF5050";
                    
                }
                else
                {
                    document.getElementById('plate').style.borderColor="#66FF66";
     
                }
                
                if( id==''){
                    document.getElementById('plate').style.borderColor=" #E5E5E5";
                }
                 
            }
            
        };
         
        xmlhttp.open("POST", "chipl.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        xmlhttp.send("searchVal="+id);
    
    }
    function selectModel() 
    {
        var id=document.getElementById('leadType').value;
        // console.log(document.getElementById('oid').value);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                document.getElementById('model').innerHTML=this.responseText;
                
            }
        };
        xmlhttp.open("POST", "selectModel.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        xmlhttp.send("searchVal="+id);
    
    }
</script>
</body>

</html>