<?php
    session_start();
    session_destroy(); 
    session_start();
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
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
        $user= $_POST['user_name'];
        $password= $_POST['password'];
        $sql = "SELECT department ,photo FROM `Employee` WHERE `user id`={$password} AND name='{$user}'  and `work`='y'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            if ($row['department']=="manger")
            {
                $_SESSION['user']=$user;
                $_SESSION['id']=$password;
                $_SESSION['img']=$row['photo'];
                $_SESSION['dept']='m';
                mysqli_close($conn); 
                header("REFRESH:0;URL=manger/html/cmms.php");
            }
            else if($row['department']=="expert")
            {
                $_SESSION['user']=$user;
                $_SESSION['id']=$password;
                $_SESSION['img']=$row['photo'];
                $_SESSION['dept']='e';
                mysqli_close($conn); 
                header("REFRESH:0;URL=expert/osama/expert.php");
            }
            else if($row['department']=="technical")
            {
                $_SESSION['user']=$user;
                $_SESSION['id']=$password;
                $_SESSION['img']=$row['photo'];
                $_SESSION['dept']="t";
                mysqli_close($conn); 
                header("REFRESH:0;URL=tecnical/mainPage.php");
            }
            

            
        }
        else if(true)
            {

                $sql = "SELECT photo FROM `customer` WHERE `id`={$password} AND name='{$user}'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0)
                {
                    $row = $result->fetch_assoc();

                    $_SESSION['user']=$user;
                    $_SESSION['id']=$password;
                    $_SESSION['img']=$row['photo'];
                    $_SESSION['dept']='c';
                    mysqli_close($conn); 
                    header("REFRESH:0;URL=customer/custHomePage.php");

                }
                else
        {
            
            mysqli_close($conn); 

            $msg="Please check your username and password";
            header("Location:index.php?message={$msg}");

        }

            }
        else
        {
            mysqli_close($conn); 
            $msg="Please check your username and password";
            header("Location:index.php?message={$msg}");

        }
        // if(in_array($user,$manger))
        // {
        //     $_SESSION['user']=$user;
        //     $_SESSION['password']=$password;
        //     header("REFRESH:10;URL=manger/html/cmms.php");
        // }
        // else
        // {
        //     if(in_array($user,$expert))
        //     {
        //         $_SESSION['user']=$user;
        //         $_SESSION['password']=$password;
        //         header("REFRESH:0;URL=expert/osama/expert.php");
        //     }
        // }
    }
    else
    {
        $msg="You Can't Brwose This Page Directly ";
        header("Location:index.php?message={$msg}");
    }
?>