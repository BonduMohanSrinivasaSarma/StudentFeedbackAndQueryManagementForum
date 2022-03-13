<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="Content-Security-Policy: default-src * https://19bcn7015.epizy.com/signin.php">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Faculty Sign in</title>
    <script>
        function showpass()
        {
            var x = document.getElementById("jis");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
        }
    </script>
</head>

<body class="bg">
    <input type="button" value="Home" style="float: right; margin-right:10px" class="but" onclick="location.href='index.php'">
    <input type="button" value="Admin" style="float: right; margin-right:10px" class="but" onclick="location.href='admin.php'">
    <h1 class="h1d" style="padding-left: 230px;">Faculty Sign in</h1>
    <div class="div1">
        <h1 style="font-size:26px; color:black" class="h1d">Login</h1>
    <form name="Regform" method="POST" style="font-size: 23px;"> 
        <table class="tlb">
        <tr><td><label for="Name">User Name:</label></td><td><input maxlength="9" title="Please Check if Username is between 5 to 9 Characters" type="text" name="UName" size="20" style="font-size: 22px;" placeholder="Faculty ID" required></td></tr>
        <tr><td><label for="Password">Password:</label></td><td><input  type="password" maxlength="15" name="Password" size="20" id="jis" style="font-size: 22px;" placeholder="Password" required></td></tr>
        <tr><td></td><td><input type="checkbox" onclick="showpass()">Show Password</td></tr>
        <tr><td></td><td></td></tr>
        <tr><td style="padding-top: 20px;" align="center" colspan="2"><input  type="submit" value="Submit" name="ki" class="but"></td></td></tr>
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
    $pas=md5($_POST['Password']);
    $connection = mysqli_connect('sql302.epizy.com', 'epiz_28810806', 'IiDZQFiD0nm','epiz_28810806_Labproject');
    if(!$connection)
    echo "Connection is not Successful";
    $query = $connection->query("SELECT * FROM users WHERE username='$us'");
    while ($row =mysqli_fetch_array($query)) 
        {
            if($row['username']==$us && $row['passcode']==$pas){
            $_SESSION['Username']=$us;
            header("Location:user.php?user=".md5($us));
            }
        }
        $_SESSION['error']="Invalid Credentials";
}
if(isset($_SESSION['error']))
echo "<script> document.getElementById('err').innerHTML='Invalid usename or password'; </script>";

unset($_SESSION["error"]);

?>

