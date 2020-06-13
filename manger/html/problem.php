<!DOCTYPE html>
<htm>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../css/problem.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
    <?php 
                  $servername = "sql302.epizy.com";
                  $username = "epiz_25613163";
                  $password = "FA3c2XY3aWljTX";
                  $dbname='epiz_25613163_CMMS';
                  $conn = new mysqli($servername, $username, $password,$dbname);
                  $sSQL= 'SET CHARACTER SET utf8';                                                               
                  mysqli_query($conn,$sSQL) or die ('Can\'t charset in Base');
    
    ?>

        <header>
            <button class="search" type="submit"><i class="fa fa-search"></i></button>
            <input type="text" name="search" placeholder="search" onkeyup="searchService();">
            <img src="../img/plus.png" alt="" onclick="document.getElementById('id01').style.display='block' ">
        </header>

        <div class="table">
            <table id="tablesev">
                 <tr>
                    <th>service</th>
                    <th>Price</th>
                </tr>
                  <?php
                  $sql = "SELECT name,price FROM service1";
                  $result= mysqli_query($conn,$sql);
                  while($row= mysqli_fetch_array($result)){
                      echo
                       " <tr>
                       <td>".$row['name']."</td> <td>".$row['price']."</td>
                       </tr> ";
                  }
                ?>
            </table>
        </div>
        <div id="id01" class="modal">
            <div class="pop" style="height:240px;">
                <form action="insertService.php" method="post">
                    <input type="text" name="name" placeholder="service name " required>
                    <input type="text" name="price" placeholder="Price"  required>

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
            $.post("searchService.php", {searchVal:searchText},function(output){
                 $("#tablesev").html(output);

            });
        }
        
        
        // </script>
        <script>
            var modal = document.getElementById('id01');
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";

                }
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
</htm>