<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="..\CSS osama\menuStyle.css">
    <link href="..\CSS osama\css-circular-prog-bar.css" media="all" rel="stylesheet" />
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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="..\CSS osama\problem0.css">

    <title></title>
    <style>
        /* table thead { display:block; } */
        #table11 { height:300px; overflow-y:scroll; display:block; }
        
    </style>
    
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

            $sql = "SELECT `plateno` FROM `car`";
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
        <p>Please check the number plate or car record</p>
        <a href="AddCar.php">
        <img src="../img/finger.png" id="ar_lef" width="30px;">
        <img src="../img/findCar0.png"width="30px" style="margin-left:10px;">
        </a>
        <span onclick="document.getElementById('cardms').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <div class="container">

        <form action="NewService.php" method="POST">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex align-items-end flex-column">
                        <div class="col-sm-4">
                            <label for="pwd" id="owner">Owner name: </label>
                            <p class="formRight">
                                
                                <input list="plate" name="OwnerName" class="form-control" id="usr1"  onkeyup="findCar()" autocomplete="off" placeholder="palte no." >
                                <datalist id="plate">
                                    
                                    <?php
                                    if ($result->num_rows > 0) 
                                    {
                                        while($row = $result->fetch_assoc())
                                        {
                                            echo '<option value=" '.$row['plateno'].' ">';
                                        }
                                    }
                                    ?>

                                </datalist>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-7">
                    <label for="comment">Describe the problem from a customer:</label>
                    <textarea class="form-control form-rounded" name="DescribeCustomer" id="desc" style="border-radius:20px ; border: 2px solid;padding: 10px;padding-left: 20px;font-size: 20px;" rows="6"></textarea>
                </div>


                <div class="col-sm-4 bodyDivs2O1">
                    <!-- <h1 style="text-align: center;font-size: 500%;">%10</h1> -->
                    <div class="c100 p0 blue" id='persen'>
                        <span id="spanpe">0%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>

                </div>



            </div>

            <div class="row">
                <div style="margin-top:20px ;" class="col-sm-6">
                    <label for="pwd" id="date">last service:</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="pwd" id="kilo">last kilometer:</label>
                </div>
            </div>
            <div class="row">

                <div class="text">
                    <p class="formRight">
                        <input type="text" class="form-control" name="LastKilometer" onkeypress="return isNumberKey(event)" autocomplete="off" id="usr">
                    </p>
                </div>
                <div class="">
                    <button type="button" onclick="cal();" class="bodybuttonC"><i class="fa fa-calculator"
              style="font-size: large; color: #fff;"></i>
          </button>
                </div>

            </div>


            <div class="row">
                <div class="bto">
                    <div class="d-flex align-items-start flex-column">
                        <button type="button" class="bodybuttonaadd" onclick="save()">Add</button>
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
        <p id="demo"></p>
        <div class="container mt-3">
            <input class="form-control" id="myInput" type="text" placeholder="Search..">
            <br>
            <table id="table1" class="table table-bordered">

                <thead>
                    <tr>
                        <th>problem</th>
                        <th>Price</th>
                    </tr>
                </thead>
            </table>

           <div id="table11">
            <table id="table" class="table table-bordered" style="cursor:default;">   
                <tbody id="myTable" onclick="myfun()">
                <?php
                    $sql = "SELECT * FROM `service1`";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc())
                    {
                        echo 
                        "
                            <tr>
                            <td>{$row['name']}</td>
                            <td>{$row['price']}$</td>
                            <td style='display:none;'>{$row['no']}</td>
                            <td style='display:none;'>service</td>
                            </tr>
                        ";
                    }
                    echo 
                    "
                            <tr>
                            <td style='border-top:3px solid #ee510f;'>part</td>
                            <td style='border-top:3px solid #ee510f;'>-------</td>
                            <td style='display:none;'>0</td>
                            <td style='display:none;'>none</td>
                            </tr>
                    ";
                    $sql = "SELECT * FROM `part`";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc())
                    {
                        echo 
                        "
                            <tr>
                            <td>{$row['name']}</td>
                            <td>{$row['price']}$</td>
                            <td style='display:none;'>{$row['no']}</td>
                            <td style='display:none;'>part</td>
                            </tr>
                        ";
                    }
                
                ?>
                </tbody>
            </table>
           </div>

            <hr style="border:3px solid #ee510f; border-radius: 50px;">
            <table id="Table" class="table table-bordered">

                <tr>
                    <th>problem</th>
                    <th>Price</th>
                </tr>
            </table>
            

            
        </div>
    </div>

    <script>
    var kil=0;
    var vin=NaN;
        var part =new Array();
        var problem =new Array();
        $(document).ready(function() {

            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        function findCar() 
        {
            var id=document.getElementById('usr1').value;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var xx=this.responseText.split(",");
                document.getElementById("owner").innerHTML = xx[0];
                document.getElementById("date").innerHTML = xx[2];
                document.getElementById("kilo").innerHTML = xx[3];
                kil=xx[3].split(";");
                kil=kil[2];
                vin=xx[1];
                if(vin=="noCarIsFound")
                {
                    document.getElementById('cardms').style.display='block';
                }
                else
                {
                    document.getElementById('cardms').style.display='none';
                }
            }
        };
        xmlhttp.open("POST", "findCar.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        xmlhttp.send("id="+id.trim());
        
        }
        function cal()
        {
            var valKilo=document.getElementById('usr').value;
            valKilo=parseInt(valKilo);
            kil=parseInt(kil);
            
            var val=(valKilo-kil)/100;
            if(val>100)
                val=100;
            if(val<0)
                val=0;
            document.getElementById("persen").className="c100 p"+Math.floor(val)+" blue";
            document.getElementById("spanpe").innerHTML=val+"%";
            
            
;
        }
        function myfun() 
        {
            var table = document.getElementById('table');
            var table1 = document.getElementById("Table");
            var row = table1.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);

            for (var i = 0; i < table.rows.length; i++) {
                table.rows[i].onclick = function() {
                    if(this.cells[3].innerHTML=="part")
                    {
                        cell1.innerHTML = this.cells[0].innerHTML;
                        cell2.innerHTML = this.cells[1].innerHTML;
                        part.push(this.cells[2].innerHTML);
                        console.log("part: "+this.cells[2].innerHTML); 
                    }
                    if(this.cells[3].innerHTML=="service")
                    {
                        cell1.innerHTML = this.cells[0].innerHTML;
                        cell2.innerHTML = this.cells[1].innerHTML;
                        problem.push(this.cells[2].innerHTML);
                        console.log("problem: "+this.cells[2].innerHTML); 
                    }

                };
            }
        }
        function save()
        {
            // xcxc1=part.length;
            // for (var i = 0; i < xcxc1; i++)
            // {
            //  console.log(part.pop());   
            // }
            // console.log("fin part"); 
            // console.log(problem);
            // console.log(problem.length);
            // xcxc=problem.length;
            // for (var i = 0; i < xcxc ; i++)
            // {
            //  console.log(problem.pop());   
            // }
            var error="please enter :";
            if(document.getElementById('usr1').value.length == 0)
            {
                error+="\tPlate No.";
            }
            if(document.getElementById('usr').value.length == 0)
            {
                error+="\tcurrent kilometer";
            }
            if(problem.length<=0)
            {
                error+="\t at lest one service";
            }
            if(error!="please enter :")
            {
                alert(error);
                return;
            }
            var kilm=document.getElementById('usr').value;
            var kkol=document.getElementById('desc').value;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if(this.responseText=="addWithOutError")
                {
                    window.parent.document.getElementById("car").click();
                }
                else{
                alert(this.responseText);
                }
            }
            };
            xmlhttp.open("POST", "saveHistory.php", true);
            xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
            xmlhttp.send("KILO="+kilm+"&desc="+kkol+"&vin="+vin+"&part="+part+"&problem="+problem);

            //   window.open("saveHistory.php?KILO="+kilm+"&desc="+kkol+"&vin="+vin+"&part="+part+"&problem="+problem);

            
        }
            function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
        
    </script>
</body>

</html>