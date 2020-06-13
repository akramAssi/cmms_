<?php
    session_start();
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
            $sql = "SELECT * FROM customer";
            // echo "\n".$sql;
            $result = $conn->query($sql);
            
?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="..\CSS osama\custamer.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header id='header'>
        <button class="search" type="submit"><i class="fa fa-search"></i></button>
        <input type="text" name="search" placeholder="search" onkeyup="searchService();">
        <img src="../img/plus.png" alt="" onclick= "document.getElementById('id01').style.display='block' ">
        
    </header>
    <div class="history" title="more title" id="tablesev" >
                <?php
                
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc())
                    {
                         
                ?>
                        <section ondblclick="iframe('<?php echo $row['id']; ?>')">
                            <div>
                                <span>ID :</span>
                            <span> <?php echo $row["id"]; ?></span>
                            <span class='name'>name :</span>
                            <span class='name1'><?php echo $row["name"]; ?></span>
                            </div>
                            <div>
                            <span>phone :</span><span><?php echo $row["phone"]; ?></span>
                            <span>address :</span><span><?php echo $row["address"]; ?></span>
                            </div>
                            <div>
                            <span>email :</span> <span><?php echo $row["email"]; ?></span>
                            </div>
                            <div></div>
                            <?php
                            if(!empty($row['photo'])=="")
                            {
                                echo '<img src="../img/my.png"></img>';
                            }
                            else
                            {   
                                echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row['photo']).'"></img>';
                            }
                            ?>
                            
                            
                        </section>

                <?php
                        }
                    }
                    else { echo "0 results"; }
                $conn->close();
                ?>
               

                <!--

            <table>
                <tr>
                    <td>ID :</td><td>3131286</td><td>name :</td><td>jamal ahmad noor shaksheer</td><td rowspan="4" ><img src='./download.jpeg'></td>
                </tr>
                <tr>
                    <td>phone :</td><td>0568888813</td><td>address :</td><td>nablus</td>
                </tr>
                <tr>
                    <td>email :</td><td colspan=3> est.2020hhhj@samemail.com </td>
                </tr>
            </table>
        </section> -->

    </div>
    <div id="id01" class="modal">
        <div class="pop">
            <form action="customerF.php" method="post">
                <input type="text" name="name" placeholder="Custamer name">
                <input type="text" name="id" placeholder="Custamer ID">
                <input type="text" name="phone" placeholder="phone number">
                <input list="address" name="address" placeholder="address" >
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

                <div id="downside" >
                    <input type="submit" value="Add"  class="butt save"> 
                    <input type="button" value="Cancel" class="butt cancel" 
                       onclick="document.getElementById('id01').style.display='none'">  
                </div>
                 </form>
                 <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                  <!-- <img src="./close.png" onclick="document.getElementById('id01').style.display='none'"> -->
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type "text/javascript">
    function searchService(){
        var searchText = $("input[name='search']").val().toLowerCase();
        $.post("searchCust.php", {searchVal:searchText},function(output){
            $("#tablesev").html(output);

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
    <script type="text/javascript">
    function iframe(f){
    document.getElementById('header').style.display="none";
    document.getElementById("tablesev").style.height="100%";
document.getElementById("tablesev").innerHTML = '<iframe src="custCar.php" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>';
var sql="SELECT a.name from `customer` a WHERE a.id="+f;
    console.log(sql);
    location.href='custCar.php?pl='+f;
}
</script>
</body>

</html>