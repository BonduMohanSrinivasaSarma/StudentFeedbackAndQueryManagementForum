<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Doubts</title>
</head>
<body>
    <div style="padding-top: 50px;"></div>
    <form method="POST">
    <div style="margin-left:auto; margin-right:auto">
    <table align="center">
    <tr><td><label for="fn">Faculty Name:</label></td>
    <td>
    <?php
        $connection = mysqli_connect('sql302.epizy.com', 'epiz_28810806', 'IiDZQFiD0nm','epiz_28810806_Labproject');
        $query = $connection->query("SELECT DISTINCT Facultyname FROM facultyinfo ORDER BY Facultyname");
        $query1= $connection->query("SELECT DISTINCT course FROM facultyinfo ORDER BY course ");
        $query2= $connection->query("SELECT DISTINCT slot FROM facultyinfo ORDER BY slot");
        echo '<select name="Faculty" style="font-size:22px; width:300px"; required>';
         echo '<option value="null" class="cl">Faculty Name</option>';
        while ($row =mysqli_fetch_array($query)) 
        {
            echo '<option value="'.$row['Facultyname'].'">Prof.'.$row['Facultyname'].'</option>\n';
        } 
        echo '</select><br>';
        echo '</td></tr>';

        echo '<tr><td><label for="cr">Course:</label></td>';
        echo '<td><select name="course" style="font-size:22px; width:300px">';
        echo '<option value="null" class="cl">Course ID</option>';
        while ($row =mysqli_fetch_array($query1)) 
        {
            echo '<option value="'.$row['course'].'">'.$row['course'].'</option>\n';
        } 
        echo '</select></td></tr>';

        echo '<tr><td><label for="sl">Slot:</label></td>';
        echo '<td><select  name="slot" style="font-size:22px; width:300px;">';
         echo '<option value="null" class="cl">Slot</option>';
        while ($row =mysqli_fetch_array($query2)) 
        {
            echo '<option value="'.$row['slot'].'">'.$row['slot'].'</option>\n';
        } 
        echo '</select></td></tr>';
        
        echo '<tr><td><label for="fe">Query:</label></td>';
        echo '<td><textarea required rows="4" maxlength="300" name="doubt" placeholder="Enter the query without newline character(without Pressing Enter)" class="ptu" columns="15"></textarea></td></tr>';
        ?>
        <tr><td align="center" colspan="2"><input type="submit" name="jik" value="Submit" class="but"></td></tr>
    </table>
    </div>
    </form>
</body>
</html>
<?php
if(isset($_POST['jik']))
{
    if($_POST['Faculty']=="null" || $_POST['course']=="null" || $_POST['slot']=="null")
    echo '<p style="color:red">Please Enter Details</p>';
    $a1=$_POST['Faculty'];
    $a2=trim($_POST['course']);
    $a3=$_POST['slot'];
    $a4=$_POST['doubt'];
    $query="SELECT * FROM facultyinfo WHERE Facultyname='$a1' AND course='$a2' AND slot='$a3'";
    $query1 = "INSERT INTO doubts (Facultyname,course,slot,doubt) VALUES('$a1','$a2','$a3','$a4')";
    $ans=mysqli_query($connection,$query) or die(mysqli_error($connection));
    $count=mysqli_num_rows($ans);
    if($count>=1){
        mysqli_query($connection,$query1);
        $_SESSION['pi']="Successfully Submitted";
        echo '<p class="xcv" style="color:green;">'.$_SESSION["pi"].'</p>';
        }
        else
        {
        $_SESSION['pi']="Invalid Faculty Details Selected";
        echo '<p class="xcv" style="color:red;">'.$_SESSION["pi"].'</p>';
        }
        unset($_SESSION['pi']);
}
?>