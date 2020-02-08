
<?php
include("../model/config.php");
$id=$_REQUEST['idPacijent'];
$query = "DELETE FROM pacijent WHERE idPacijent=$id"; 
$result = mysqli_query($link,$query) or die ( mysqli_error());
header("Location: welcomeDoctor.php"); 
?>