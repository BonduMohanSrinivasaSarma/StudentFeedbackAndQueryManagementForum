<?php 
session_start();
$r=$_SESSION['Username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Faculty</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        function select(t)
        {
            if(t!="noner")
            {
                document.getElementById('jij').style.display="none";
                if(t=="feedback")
                {
                    document.getElementById('dou').style.display="none";
                    document.getElementById('fed').style.display="block";
                }
                if(t=="doubts")
                {
                    document.getElementById('fed').style.display="none";
                    document.getElementById('dou').style.display="block";
                }
            }
            if(t=="noner")
            {
                document.getElementById('fed').style.display="none";
                document.getElementById('dou').style.display="none";
                document.getElementById('jij').style.display="block";
            }
        }
        function thisp(t)
        {
            var top=document.getElementById("tb"+t).value
            document.getElementById('kio').value=top;
            document.getElementById('call').value=t;
            document.getElementById('lkp').submit();
            document.getElementById('jij').value="Successful";
        }
    </script>
</head>
<body class="bg">
    <div style="padding-top: 20px;"></div>
    <input type="button" value="Logout" class="but" style="float: right; margin-right:10px" onclick="location.href='logout.php'">
    <?php echo "<p class='intro'>Welcome ".$r."</p>"; ?>
    
    <div>
        <select  onchange=select(this.value)  name="jikp" class="h2d">
            <option value="noner">Please Select the Option</option>
            <option value="feedback">View Feedback</option>
            <option value="doubts">View Queries And Reply</option>
        </select>
    </div>
    <form hidden method="POST" name="inp" id="lkp">
        <input type="text" id="call" name="nkji">
        <textarea name="ghi" id="kio"></textarea>
    </form>
    <div class="in1" style="display: block; padding-top:50px" id="jij">Choose the Option from Dropdown to display here</div>
    <div style="display: none; padding-top:70px" id="fed"><?php feed(); ?></div>
    <div style="display: none; padding-top:70px" id="dou"><?php doubt(); ?></div>
    <p id="op"></p>
    
</body>
</html>

<?php
function doubt()
{
    $_SESSION['var']=0;
    $r=$_SESSION['Username'];
    $connection = mysqli_connect('sql302.epizy.com', 'epiz_28810806', 'IiDZQFiD0nm','epiz_28810806_Labproject');
    $query = $connection->query("SELECT * FROM doubts WHERE Facultyname=(SELECT Facultyname FROM users WHERE username='$r')");
    echo '<div class="container-fluid" style="width:1000px"><table style="background-color:white; font-size:17.5px" class="table table-bordered  table-hover">';
    echo '<tr style="background-color:ivory;" class="thead-dark"><th class="tbh">Course</th><th class="tbh">Slot</th><th class="tbh">Query</th><th class="tbh">Answer</th><th></th><tr>';
    while ($row =mysqli_fetch_array($query)) 
    {
        echo  '<tr><td style="width:100px">'.$row['course'].'</td><td style="width:100px">'.$row['slot'].'</td><td style="width:260px"><textarea class="ji3"  readonly>'.$row['doubt'].'</textarea></td>';
        if($row['reply']!=null)
            echo '<td style="width:260px"><textarea  class="ji3" id="tb'.$row["doubt"].'" name="ckj">'.$row['reply'].'</textarea></td>';
        else
            echo '<td style="width:260px" id="'.$row["reply"].'"><textarea class="ji3" id="tb'.$row["doubt"].'" name="ckj"></textarea></td>';     
        echo '<td style="width:150px"><button type="submit" class="but" style="marin-left:0px" name="ji" onclick="thisp(this.id)" id="'.$row["doubt"].'">Reply</button></td></tr>';
    } 
    echo '</table></div>';
    if(isset($_POST['nkji']))
    {
        $r1=$_POST['nkji'];
        $r2=$_POST['ghi'];
        $connection = mysqli_connect('sql302.epizy.com', 'epiz_28810806', 'IiDZQFiD0nm','epiz_28810806_Labproject');
        $query = "UPDATE doubts SET reply='$r2' WHERE doubt='$r1'"; 
        mysqli_query($connection,$query);
        @$_SESSION['var']=1;
    }
}
function feed()
{
    $r=$_SESSION['Username'];
    $connection = mysqli_connect('sql302.epizy.com', 'epiz_28810806', 'IiDZQFiD0nm','epiz_28810806_Labproject');
    $query = $connection->query("SELECT * FROM feedback WHERE Facultyname=(SELECT Facultyname FROM users WHERE username='$r')");
    echo '<div class="container-fluid" style="width:800px"><table class="table table-hover" style="background-color:white; font-size:17.5px">';
    echo '<tr style="background-color:ivory;" class="thead-dark"><th class="tbh">Course</th><th class="tbh">Slot</th><th class="tbh">Feedback</th></tr>';
    while ($row =mysqli_fetch_array($query)) 
    {
        echo  '<tr><td>'.$row['course'].'</td><td>'.$row['slot'].'</td><td style="width:300px"><textarea readonly class="ji4">'.$row['Feedback'].'</textarea></td></tr>';
    } 
    echo '</table></div>';
}

if($_SESSION['var']==1)
echo "<div class='in1' style='display: block; padding-top:20px' id='jij'>Successfully Submitted.Refresh the page and Continue</div>";
unset($_SESSION['var']);
?>

