<?php   
session_start();
session_destroy(); 
header("REFRESH:0;URL=../../index.php");
exit();
?>