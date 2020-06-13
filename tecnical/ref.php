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
    $sql = "SELECT a.name,c.brand,c.model,c.plateno,c.year,h.arrivaltime,h.`tech name`,v.status, h.no from customer a,`car` c,`history`h,`vic` v WHERE a.id=c.ownerid and c.vin=h.carvin and h.no=hno order by h.arrivaltime desc";
    $result = $conn->query($sql);
                   
?>

 <?php
                
                if ($result->num_rows > 0) 
                {
                    $i=1;
                    while($rows = $result->fetch_assoc())
                    {
                ?>
                        
                        <?php echo '<section  ondblclick= " show'." (' ".$rows['no']. " '); " .'">' ?>
                            <div>
                                <span class='h'><?php echo $rows['brand']; ?></span>
                                <span class='h'><?php echo $rows['model']; ?></span>
                                <span class='h'><?php echo $rows['year']; ?></span>
                                <span class='row'>Plate NO. :</span>
                                <span><?php echo $rows['plateno']; ?></span>
                                <span class='row'>States :</span>
                                <span style="color:red" id="<?php echo  's'.$i;?>"><?php echo  $rows['status']; ?></span>
                            </div>
                            <div>
                                <span>Time arrived :</span>
                                <span><?php echo $rows['arrivaltime']; ?></span>
                                <span class='row'>Technical name :</span>
                                <span id="<?php echo  'tm'.$i;?>"><?php echo $rows['tech name']; ?></span>
                                
                            </div>
                            <div>
                                <span>Name :</span> 
                                <span><?php echo $rows['name']; ?></span>
                            </div>
                            <div></div>
                            <img src='./brand/<?php echo $rows['brand'];?>.png' class='img' onload="ch('<?php echo  'st'.$i;?>','<?php echo  'e'.$i;?>','<?php echo  'en'.$i;?>','<?php echo  's'.$i;?>');">
                             <mydiv  class='hisBut' style=';'>
                            <img src='image/play.png' title='start' id="<?php echo  'st'.$i;?>" style='position:static;width: 30px;display:inline-block;'  onclick="start(<?php echo  $rows['no'];?>,'<?php echo  'st'.$i;?>','<?php echo  'e'.$i;?>','<?php echo  'en'.$i;?>','<?php echo  's'.$i;?>','<?php echo  'tm'.$i;?>');">
                            <img src='image/edit.png' title='edit' id="<?php echo  'e'.$i;?>" style='position:static;width: 30px;display:none;' onclick="openEdit(<?php echo  $rows['no'];?>)">
                            <img src='image/end.png' title='end' id="<?php echo  'en'.$i;?>" style='position:static;width: 30px;display:none;' onclick="end(<?php echo  $rows['no'];?>,'<?php echo  'st'.$i;?>','<?php echo  'e'.$i;?>','<?php echo  'en'.$i;?>','<?php echo  's'.$i;?>','<?php echo  'tm'.$i;?>')">
                            </mydiv>
                        </section>

                <?php
                        $i++;
                        }
                    }
                    else { echo "0 results"; }
                $conn->close();
                ?>
