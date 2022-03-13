<?php
session_start();
?>
<?php
if(isset($_SESSION['succd']))
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
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
<input type="button" value="Logout" class="but" style="float: right; margin-right:10px" onclick="location.href='logout.php'">
    <h1 class="h1d" style="font-size: 40px; padding-left:120px">Data Entry</h1>
    <div class="ji1">
    <h2 class="h1d" style="font-size:32px">User Entry</h2>
    <form name="afr" method="POST" style="font-size: 23px;" onsubmit="fk()"> 
        <table align="center" class="tlb">
        <tr><td><label for="Name">Faculty Name:</label></td><td><input type="text" pattern="[a-zA-Z\s]+" name="Name" title="Text Only" size="20" style="font-size: 22px;" placeholder="Enter Faculty Name"required></td></tr>
        <tr><td><label for="uName">User Name:</label></td><td><input type="text" name="UName" maxlength="9" pattern="[0-9]{5,9}" title="Must Contain Only Numbers with minimum of 5 and maximum 9 in length" size="20" style="font-size: 22px;" placeholder="Faculty Id" required></td></tr>
        <tr><td><label for="Password">Password:</label></td><td><input type="password" maxlength="15" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}" title="Must Contain atleast 8 and atmost 15 Characters with the number and Character Present" name="Password" size="20" id="jis" style="font-size: 22px;" placeholder="Enter Password" required></td></tr>
        <tr><td></td><td><input type="checkbox" onclick="showpass()">Show Password</td></td></tr>
        <tr><td style="padding-top: 10px;"><input style="margin-left: auto;" type="reset" value="Reset" class="but"></td><td style="padding-top:10px;"> <input style="margin-left: 100px;" type="submit" value="Submit" name="ki" class="but"></td></tr>
        </table>
    </form>
    </div>
    <div class="ji2">
    <h2 class="h1d" style="font-size:32px">Course Information Entry</h2>
    <form name="afr2" method="POST" style="font-size: 23px;"> 
        <table align="center" class="tlb">
        <tr><td><label for="UN">User Name:</label></td>
        <td>
        <?php
        $connection = mysqli_connect('sql302.epizy.com', 'epiz_28810806', 'IiDZQFiD0nm','epiz_28810806_Labproject');
        $query = $connection->query("SELECT username FROM users");
        echo '<select name="UName" style="font-size:22px; width:280px"; required>';
        echo '<option value="null" class="cl">Faculty id</option>';
        while ($row =mysqli_fetch_array($query)) 
        {
            echo '<option value="'.$row['username'].'">'.$row['username'].'</option>\n';
        } 
        echo '</select><br>';
        ?>
        </td></tr>
        <tr><td><label for="cr">Course:</label></td><td><input type="text" name="cour" size="20" id="jis" style="font-size: 22px;" placeholder="Course id" required></td></tr>
        <tr><td><label for="sl">Slot:</label></td><td><input type="text" name="slo" size="20" id="jis" style="font-size: 22px;" placeholder="Slot" required></td></tr>
        <tr><td style="padding-top: 10px;"><input style="margin-left: auto;" type="reset" value="Reset" class="but"></td><td style="padding-top:10px;"> <input style="margin-left: 100px;" type="submit" value="Submit" name="pi" class="but"></td></tr>
        </table>
    </form>
    </div>
    <p id="msg" style="display: none;">Successfully Submitted.</p>
</body>
</html>
<?php
    if(isset($_POST['ki']))
    {
        $r1=$_POST['Name'];
        $r2=$_POST['UName'];
        $r3=md5($_POST['Password']);
        $connection = mysqli_connect('sql302.epizy.com', 'epiz_28810806', 'IiDZQFiD0nm','epiz_28810806_Labproject');
        $query="SELECT * FROM users WHERE username='$r2'";
        $ans=mysqli_query($connection,$query) or die(mysqli_error($connection));
        $count=mysqli_num_rows($ans);
        if($count==0)
        {
            $query ="INSERT INTO users VALUES('$r1','$r2','$r3')";
            mysqli_query($connection,$query);
            echo '<p class="print1">Successfully Submitted.<br>Please the Refresh Page.</p>';
        }
        else
        echo '<p class="print1" style="color:red">The User Already Exists</p>';
    }
    if(isset($_POST['pi']))
    {
        $r1=$_POST['UName'];
        $r3=str_replace(' ','',$_POST['cour']);
        $r4=$_POST['slo'];
        $connection = mysqli_connect('sql302.epizy.com', 'epiz_28810806', 'IiDZQFiD0nm','epiz_28810806_Labproject');
        $query="SELECT * FROM users WHERE username='$r1'";
        $ans=mysqli_query($connection,$query) or die(mysqli_error($connection));
        $count=mysqli_num_rows($ans);
        if($r1!="null")
        {
            $query="SELECT * FROM facultyinfo WHERE username='$r1' AND course='$r3' AND slot='$r4'";
            $ans=mysqli_query($connection,$query) or die(mysqli_error($connection));
            $count=mysqli_num_rows($ans);
            if($count==0)
            {
                $query="SELECT * FROM facultyinfo WHERE username='$r1' AND slot='$r4'";
                $ans=mysqli_query($connection,$query) or die(mysqli_error($connection));
                $count=mysqli_num_rows($ans);
                if($count==0)
                {
                $query="SELECT Facultyname FROM users WHERE username='$r1'";
                $ra=mysqli_query($connection,$query);
                $raa=mysqli_fetch_row($ra);
                $r2=$raa[0];
                $query ="INSERT INTO facultyinfo VALUES('$r1','$r2','$r3','$r4')";
                mysqli_query($connection,$query);
                echo '<p class="print1" style="padding-left:1060px">Successfully Submitted.<br>Please the Refresh Page.</p>';
                }
                else
                echo '<p class="print1" style="color:red; padding-left:920px">The Faculty Assigned to Other Course in Chosen Slot</p>';
            }
            else
            echo '<p class="print1" style="color:red; padding-left:1060px">The Faculty Already Exists with the assigned class details</p>';
        }
        else
        echo '<p class="print1" style="color:red; padding-left:1060px">Please Enter Faculty ID</p>';
    }
  
?>
<?php
} 
else
echo "<p style='text-align:center; font-size:22px'>Unauthorized Entry.<p>";
?>