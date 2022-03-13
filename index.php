<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Opinion</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
    function feedback(str)
    {        
        if(str!="none" && str!="dview"){
        document.getElementById("hi").innerHTML="<iframe style='width:1200px;border:none;height:500px;margin-left:auto;margin-right:auto;' src='"+str+"'></iframe>";
        document.getElementById('hi1').style.display="none";
        }

        if(str=="dview"){
        document.getElementById('hi').innerHTML="";
        document.getElementById('hi1').style.display="block";
        }
        if(str=="none"){
        document.getElementById('hi').innerHTML="Choose the Option to Display from above Dropdown or<br> Click Description for Information about Process Flow";
        document.getElementById('hi1').style.display="none";
        }
    }
    </script>
    
</head>
<body class="bg">
<input type="button" value="Description" style="float: right; margin-right:10px" class="but" onclick="location.href='details.php'">
<input type="button" value="Sign in" style="float: right; margin-right:10px" class="but" onclick="location.href='signin.php'">
<h1 class="h1d" style="padding-left: 230px;">Submit Feedback or Ask Queries</h1>
<select  onchange=feedback(this.value) name="jikp" class="h2d">
    <option value="none">Please Select the Option</option>
    <option value="feedback.php">Post Feedback</option>
    <option value="doubts.php">Post Query</option>
    <option value="dview">View Posted Queries</option>
</select>​
<div  class="spt" id="hi"><p>Choose the Option to Display from above Dropdown or<br> Click Description for Information about Process Flow</p></div>
<div  style="display: none; padding-top:30px" id="hi1"><p><?php dis(); ?></p></div>
</body>
</html>
<?php
function dis()
{
    $connection = mysqli_connect('sql302.epizy.com', 'epiz_28810806', 'IiDZQFiD0nm','epiz_28810806_Labproject');
    $query = $connection->query("SELECT * FROM doubts");
    echo '<div class="container-fluid" style="width:1030px"><table class="table table-hover" style="background-color:white; font-size:17.5px">';
    echo '<tr style="background-color:ivory;" class="thead-dark"><th class="tbh">Course</th><th class="tbh">Faculty</th><th class="tbh">Slot</th><th class="tbh">Query</th><th class="tbh">Reply</th></tr>'; 
    while ($row =mysqli_fetch_array($query)) 
    {
        echo  '<tr><td>'.$row['course'].'</td><td>Prof.'.$row['Facultyname'].'</td><td>'.$row['slot'].'</td><td><textarea readonly class="ji3">'.$row['doubt'].'</textarea></td>';
        if(trim($row['reply'])!=null)
            echo  '<td style="padding-left:20px"><textarea readonly class="ji3">'.$row['reply'].'</textarea></td></tr>';
        else
            echo  '<td style="padding-left:20px"><textarea readonly class="ji3" placeholder="Not Yet Replied.."></textarea></td></tr>';
    }
    echo "</table>"; 
}
?>
