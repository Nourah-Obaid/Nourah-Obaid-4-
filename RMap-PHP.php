<?php


// Create connection
$host='localhost';
$user ='root';
$password ='';
$database ='RMap-DB';
$connect= mysqli_connect($host,$user,$password,$database);

if(mysqli_connect_errno()){

die("cant connect with database". mysqli_connect_error());
}
else{
echo"DB is connected successfully";}

?>

<!DOCTYPE html>
<html>
<head>
<title>Direct The Robot</title>
<style>
body {
	background-image: url("r.jpg");
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
	
	justify-content: center;
}
table, th, td {

  border: 1.7px solid #9c0c3c;
  border-collapse: separate;
  
  padding: 30px;
  text-align: center ;
}

h1,label{color: #9c0c3c;}


</style>
</head>
<body >
<br><br><br><br><br><br>
<h1 ><b>Direct The Robot</b></h1>

     <form action="RMap-PHP.php" method="post">

     <label> Right </label> </br><input type="text" id="right" name="right" >
	    <input style=" margin-right: 20px;margin-left: 20px;" type="submit" value="    SAVE   "name ="save" > <br><br>
    <label>Forwards</label> </br><input type="text" id="forwards" name="forwards" >
<input style=" margin-right: 20px;margin-left: 20px;" type="submit" value="   START   "name="rightt"><br><br>

    
    <label> Left </label></br> <input type="text" id="left" name="left" >
 <input style=" margin-right: 20px;margin-left: 20px;" type="submit" value="  DELETE "name ="delete"><br><br>



</form>


<?php
//START
if(isset($_POST['rightt'])) {
  $rightv=$_POST['rightt'];
  $forv=$_POST['forwards'];
  $leftv=$_POST['left'];
  for ($x = 1; $x <= $rightv; $x++) {
  echo "&rarr;";
}
echo"</br>";
  for ($x = 1; $x <= $forv; $x++) {
  echo "&uarr; </br>";
}


  for ($x = 1; $x <= $leftv; $x++) {
  echo "&larr;";
}}

?>

<?php
//SAVE
if(isset($_POST['save'])) {
  $rv=$_POST['right'];
  $fv=$_POST['forwards'];
  $lv=$_POST['left'];

  $query = "INSERT INTO saved ( forwards, leftt, rightt) VALUES
     ('" .$fv. "','" .$lv."','" .$rv."')";
       $result = mysqli_query($connect,$query);


       if(!$result)
    {
        die (" error on qurey");
    }
    else
    {

        die ("Records added successfully.");
    }
    }


//view in table

$query = "SELECT * FROM saved ";
$result = mysqli_query($connect,$query);
 if(!$result)
    {
        die (" error on qurey");
    }


echo "<table border='1'>
<tr>
<th>right</th>
<th>forwards</th>
<th>left</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['rightt'] . "</td>";
echo "<td>" . $row['forwards'] . "</td>";
echo "<td>" . $row['leftt'] . "</td>";

echo "</tr>";
}
echo "</table>";
?>


<?php
mysqli_free_result($result);

?>


<?php
//DELETE
if(isset($_POST['delete'])) {
$query = "DELETE FROM saved WHERE ID=(SELECT MAX(id) FROM saved) ";
$result = mysqli_query($connect,$query);
 if(!$result)
    {
        die (" error on qurey delete ");
    }
//delete view
}

?>


</br>


</body>
</html>

<?php

mysqli_close($connect);
?>