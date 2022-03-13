<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Administrator Login</title>
    <script>
        function showpass()
        {
            var x = document.getElementById("jis");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
            document.getElementById('div1').innerHTML=document.getElementById('lio').innerText;
        }

    </script>
</head>

<body class="bg">
    <input type="button" value="Home" style="float: right; margin-right:10px" class="but" onclick="location.href='index.php'"> 
    <input type="button" value="Sign in" style="float: right; margin-right:10px" class="but" onclick="location.href='signin.php'">
    <h1 class="h1d" style="padding-left: 260px;">Administrator</h1>
    <div class="div1">
        <h1 style="font-size:26px; color:black" class="h1d">Admin</h1>
    <form name="Regform" method="POST" style="font-size: 23px;"> 
        <table class="tlb">
        <tr><td><label for="Name">User Name:</label></td><td><input type="text" name="UName" size="20" style="font-size: 22px;" placeholder="Username:admin" required></td></tr>
        <tr><td><label for="Password">Password:</label></td><td><input type="password" name="Password" size="20" id="jis" style="font-size: 22px;" placeholder="Password:admin" required></td></tr>
        <tr><td></td><td><input type="checkbox" onclick="showpass()">Show Password</td></tr>
        <tr><td align="center" style="padding-top: 20px;" colspan="2"><input type="submit" value="Submit" name="ki" class="but"></td></tr>
        </table>
    </form>

    <p id="err" class="er1"></p>

    </div>
</body>
</html>

<?php
if(isset($_POST['ki']))
{
Check();
}

function Check()
{
    $us=$_POST['UName'];
    $pas=$_POST['Password'];
    if($us=="admin" && $pas=="admin")
    {
    header("location:rights.php");
    $_SESSION['succd']=1;
    }
    $_SESSION['error']=1;           
}

if(isset($_SESSION['error']))
echo "<script> document.getElementById('err').innerHTML='Invalid Usename or Password'; </script>";
unset($_SESSION["error"]);

?>

