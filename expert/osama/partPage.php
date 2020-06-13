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
            $sql = "SELECT m.name as partname, m.price as partprice, m.no as partno , c.name as mname,c.mno, c.resdate, c.phone ,c.count FROM part m , merchant c where c.pno = m.no GROUP BY c.pno HAVING max(c.resdate) order by partno asc";
            // echo "\n".$sql;
            $result = $conn->query($sql);
       
?>
<!DOCTYPE html>
<htm>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../CSS osama/part.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>

        <header>
            <button class="search" type="submit"><i class="fa fa-search"></i></button>
            <input type="text" name="search" placeholder="search" onkeyup="searchService();">
            <img src="../img/plus.png" alt="" onclick="document.getElementById('id01').style.display='block' ">
        </header>

        <div class="table">
            <table id="tablesev">
            <tr>
                <th>PartNo.</th>
                <th>name</th>
                <th>count</th>
                <th>price</th>

            </tr>

                <?php
                
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc())
                    {
                ?>
                        <tr style="text-align:center;">
                            
                            <td style=" width:13% "><span class="details" title="more details"><img src="../img/d_arrow.png" ></span> <?php echo $row["partno"]; ?> </td>
                            <td style=" width:40%;"><?php echo $row["partname"]; ?></td>
                            <td style=" width:20%"><?php echo $row["count"]; ?></td>
                            <td ><?php echo $row["partprice"]; ?>$</td>
                        </tr>
                        
                        <tr style="display:none">
                            <td > <?php echo $row["mno"]; ?> </td>
                            <td > <?php echo $row["mname"]; ?> </td>
                            <td ><?php echo $row["phone"]; ?></td>
                            <td ><div style=" width:240px"><?php echo $row["resdate"]; ?></div></td>
                        </tr>
                <?php
                        }
                    }
                    else { echo "0 results"; }
                $conn->close();
                ?>
            </table>
        </div>

        <div id="id01" class="modal" >
            <div class="pop poppart" style="height:450px; margin-top:0;" >
                <form action="addpart.php" method="post">
                    <input type="text" name="partno" placeholder="part no" onkeyup="partId();">
                    <input type="text" name="partname" placeholder="part name ">
                    <input type="text" name="count" placeholder="count of part">
                    <input type="text" name="price" placeholder="price">
                    <input type="text" name="mno" placeholder="merchant id" onkeyup="mnoId();">
                    <input type="text" name="mname" placeholder="merchant name">
                    <input type="text" name="phone" placeholder="merchant phone">
                    <div id="downside">
                        <input type="submit" value="Add" name="submit" class="butt save">
                        <input type="button" value="Cancel" class="butt cancel" onclick="document.getElementById('id01').style.display='none'">
                    </div>
                </form>
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <!-- <img src="./close.png" onclick="document.getElementById('id01').style.display='none'"> -->
            </div>
        </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type "text/javascript">
        function searchService(){
            var searchText = $("input[name='search']").val().toLowerCase();
            $.post("searchpart.php", {searchVal:searchText},function(output){
                 $("#tablesev").html(output);

            });
        }
        function partId(){
            var searchText = $("input[name='partno']").val().toLowerCase();
            $.post("partId.php", {searchVal:searchText},function(output){
                
               if(output=="not"){
                $("input[name='partname']").val("");
                $("input[name='price'").val("");
                $("input[name='count']").val("");
                $("input[name='mname']").val("");
                $("input[name='phone']").val("");
                $("input[name='mno']").val("");
               }
               else{
                words = output.split(',');
               
                $("input[name='partname']").val(words[0]);
                $("input[name='price'").val(words[1]);
                $("input[name='count']").val(words[6]);
                $("input[name='mname']").val(words[3]);
                $("input[name='phone']").val(words[5]);
                $("input[name='mno']").val(words[7]);
               }
            });
        }
        
        function mnoId(){
            var searchText = $("input[name='mno']").val().toLowerCase();
            $.post("mnoId.php", {searchVal:searchText},function(output){
                
               if(output=="not"){
                
                $("input[name='count']").val("");
                $("input[name='mname']").val("");
                $("input[name='phone']").val("");
               }
               else{
                word = output.split(',');
                console.log(word);
                
                $("input[name='mname']").val(word[0]);
                $("input[name='phone']").val(word[2]);
               }
            });
        }
         </script>
        <script>
            var modal = document.getElementById('id01');
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";

                }
            }
            $('body').on("click",".details",function(){
              $(this).parent().parent().next().toggle();
            });
        </script>
         <?php
            if(!empty($_GET['message']))
                {
                    echo "<script>alert('{$_GET['message']}');</script>";
                }
            ?>
    </body>
</htm>