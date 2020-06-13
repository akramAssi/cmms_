<html>

<head>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8" />
    <style>
        * {
            font-family: Roboto;
            color: #1C232C;
        }
        
        /* html {
            max-width: 595px;
        } */
        
        body {
            max-width: 595px;
            margin-left: auto;
            margin-right: auto;
            /* border: 1px dashed black;
            padding: 20px; */
            box-sizing: border-box;
        }
        
        header {
            /* width: 595px; */
            overflow: auto;
            padding-bottom: 10px;
            border-bottom: 1px solid #1C232C;
        }
        
        header img {
            float: left;
            margin-left: -3px;
        }
        
        #logo {
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            font-size: 38px;
            margin-top: 2px;
            float: left;
        }
        
        .date {
            /* clear: both; */
            float: right;
            font-style: normal;
            font-weight: normal;
            font-size: 20px;
            margin-top: 24px;
        }
        
        p {
            text-align: center;
        }
        
        .info div,
        .row div {
            margin-bottom: 8px;
        }
        
        .info span,
        .row span {
            margin-right: 7px;
        }
        
        .row {
            background-color: rgb(238, 184, 84);
            padding: 15px;
            border-radius: 25px;
        }
        
        .desc {
            /* width: 555px; */
            background-color: #EEEEEE;
            margin: 20px 0px;
            padding: 14px;
            border-radius: 25px;
        }
        
        table tr td:first-child {
            width: 460px;
        }
        
        table th {
            text-align: left;
            padding-bottom: 15px;
        }
    </style>

</head>
<?php
    date_default_timezone_set("Asia/Jerusalem");// echo $_POST['message'];
        
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

    $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,c.fuel ,c.vin from  `customer` a , `car` c WHERE a.id=c.ownerid and c.plateno LIKE '%{$_GET['plate']}%'";
    $result = $conn->query($sql);
    $sql1="SELECT min(`arrivaltime`) as 'start' FROM `history`";
    $res= $conn->query($sql1);
    $row1 = $res->fetch_assoc();
?>

<body>
    <header>
        <img src="logo.png" alt="logo" width="63px">
        <div id="logo">CMMS</div>
        <div class="date"><?php echo date('m/d/Y h:i a', time()); ?></div>
    </header>

    <p><?php echo $row1['start'].' &ensp; to &ensp;'.date('Y/m/d h:i:s', time())?> </p>
<?php
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        echo 
        "
        <div class='info'>
        <div>
            <span>Name :</span><span>{$row['name']}</span>
        </div>
        <div>
            <span>Model :</span><span>{$row['brand']}</span><span>{$row['model']}</span><span>{$row['year']}</span> <span>Plate NO. :</span><span>{$row['plateno']}</span>
            <span>fuel :</span><span>{$row['fuel']}</span>
        </div>
        <div>
            <span>VIN :</span><span>{$row['vin']}</span>
        </div>
    </div>
    
        ";
    }

    $sql = "SELECT `arrivaltime`,`kilometer`,`desowner`,`no` FROM `history` h,`car`c WHERE c.vin=h.carvin and c.plateno LIKE '%{$_GET['plate']}%'";
    $result = $conn->query($sql);

    while($rows = $result->fetch_assoc())
    {
        echo 
        "
        <div class='row'>
            <div>
                <span>Data :</span><span>{$rows['arrivaltime']}</span><span style='float: right;'>kilometer : {$rows['kilometer']}</span>
            </div>
            <div>
                <span>Description from customer :</span>
            </div>
            <div>
            {$rows['desowner']}
            </div>
        </div>
        ";
        $id=$rows['no'];
        $sql0 = "select p.name,p.price FROM `part` p,`descpart` d WHERE d.pno=p.no and d.hno ={$id} UNION select p.name,p.price FROM `service1` p,`descservice` d WHERE d.sno=p.no and d.hno ={$id}";
        $result0 = $conn->query($sql0);
        if ($result->num_rows > 0)
        {
            echo
            "
            <div class='desc'>
                <table>
                    <tr>
                        <th>Description </th>
                        <th>price</th>
                    </tr>
            ";
            while($row0 = $result0->fetch_assoc())
            {
                echo 
                "
                    <tr>
                        <td>{$row0['name']} </td>
                        <td>{$row0['price']}</td>
                    </tr>
                ";
            }
            echo
            "
                    </table>
                </div>
            ";
        }
    }

?>
</body>

</html>