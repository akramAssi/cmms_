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
        $password = $_SESSION['id'];
        $user = $_SESSION['user'];
        $sql = "SELECT * FROM `Employee` WHERE `user id`= $password AND name='{$user}'";
        $result = $conn->query($sql);
        $info = $result->fetch_assoc();
        


?>
<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css\infoPageStyle.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <title>information page</title>
    <link rel="icon" href="image\car.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="content">
        <form  action="editemp.php" method="post" enctype="multipart/form-data">
            <div class="edit" onclick="edit();"><img src="image/edit.png"></div>

            <div class="image">
                <?php
                if(!empty($_SESSION['img'])=="")
                {
                    echo '<img class="v" src="image/my.png"></img>';
                }
                else
                {   
                    echo '<img class="v" src="data:image/jpg;charset=utf8;base64,'.base64_encode($_SESSION['img']).'"></img>';
                }
            ?>
                <span class="active"><img src="image/plus.png" width="70%"></span>
                <input class="active" type="file" id="img" name="img" accept="image/*">

            </div>
            <div class="form" >
                <div>
                    <span>Name : </span>
                    <input type="text" id="editName" name="name" disabled value=<?php echo $info['name']; ?>>
                    <!-- noor mohammad fade kalily</span> -->
                </div>
                <div>
                    <span>ID :</span>
                    <input type="text" id="id" disabled name="id" value='<?php echo $info['user id']; ?>'>
                    <!-- 4 45456445</span> -->
                </div>
                <div>
                    <span>Email :</span>
                    <input type="text" id="email" disabled name="email" value=<?php echo $info['email']; ?>>
                    <!-- noor125@gmail.com</input> -->
                </div>
                <div>
                    <span>Address :</span>
                    <input type="text" id="address" name="address" disabled value=<?php echo $info['address']; ?>>
                    <!-- Nablus</span> -->
                </div>
                <div>
                    <span style="font-size: 170%;">phone number :</span>
                    <input type="text" id="phone" name="phone" maxlength="10" disabled value=<?php echo $info['phone number']; ?> >
                    <!-- 05921358854</span> -->
                </div>
            </div>
            <div class="button active">
                <input type="submit" class="save" value="save">
                <INPUT TYPE="button" onClick="history.go(0)" VALUE="cancel" class="cancel">
            </div>
        </form>
    </div>
    <script>
        function edit() {
            var dis = document.getElementsByClassName("active");
            for (i = 0; i < dis.length; i++) {
                dis[i].style.display = "block";
            }
            document.getElementById("email").disabled = false;
            document.getElementById("address").disabled = false;
            document.getElementById("phone").disabled = false;
        }
        window.addEventListener('load', function() {
        document.querySelector('input[type="file"]').addEventListener('change', function() {
            if (this.files && this.files[0]) {
            var img = document.querySelector('.v'); // $('img')[0]
            img.src = URL.createObjectURL(this.files[0]); // set src to file url
            }
        });
        });

    </script>
</body>

</html>