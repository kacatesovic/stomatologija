<?php
session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: doktor.php");
    exit;
}
require_once "config.php";





    $idPacijent=$_REQUEST['idPacijent'];
    $sql1 = "SELECT * FROM doktor WHERE username='".$_SESSION['username']."'";
    $sth = $link->query($sql1);
    $result=mysqli_fetch_array($sth);

    
    $getit = mysqli_query($link,$sql1);
    $row = mysqli_fetch_array($getit);
    echo "<script>console.log('".$row['prezime']."');</script>";
    $idDoktor=$row['idDoktor'];
    $idPacijent=$_REQUEST['idPacijent'];


    $datumPregleda=$tipPregleda= "";
    $datumPregleda_err =$tipPregleda_err= "";
    
 

if(isset($_POST['save']))
{    
     $datumPregleda = $_POST['datumPregleda'];
     $nazivPregleda = $_POST['nazivPregleda'];
     $vremePregleda=$_POST['vremePregleda'];
     $sqlupit1="SELECT * FROM tippregleda WHERE nazivPregleda='$nazivPregleda'";
    $result1 = mysqli_query($link,$sqlupit1);
    $row1 = mysqli_fetch_array($result1);
    $idTipPregleda=$row1['idTipPregleda'];
     
     $sql = "INSERT INTO pregled (idDoktor,idPacijent,datumPregleda,idTipPregleda, azuriran,vremePregleda) VALUES ('$idDoktor','$idPacijent','$datumPregleda','$idTipPregleda','ne','$vremePregleda')";
     if (mysqli_query($link, $sql)) {
        header("Location: klijent.php"); 
     } else {
        echo "Greška!
" . mysqli_error($link);
     }
     mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/mojeSkripte.js"></script>
    <title></title>
</head>
<body>
    <div id="wrapper">
        <div id="header" class="uliniji">
            <img src="css/images/logo.png"> 
            
        </div>
             <div id="content">
                        <div class="topnav" id="myTopnav">
                                <a href="logout.php">Izloguj se</a>
                                <a href="password-reset.php">Promeni lozinku</a>
                                <a href="password-reset.php">Kreiraj nalog za pacijenta</a>
                                <a href="password-reset.php">Zakazi pregled</a>
                                
                                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                                <i class="fa fa-bars"></i>
                                </a>
                            
                            
                        </div>
						
						
							
			<div id="contentdash" class="uliniji">
                    <div id="register">
                         <h2>Zakažite pregled</h2>
                    <p>Molimo Vas popunite sva polja.</p>
                   <form method="post" >
                             <div>
                            <label>Tip pregleda</label>
                            <br>
                            <select name="nazivPregleda">
                              <option value="Popravka zuba">Popravka zuba</option>
                              <option value="Stavljanje fiksne proteze">Stavljanje fiksne proteze</option>
                              <option value="Vadjenje zuba">Vadjenje zuba</option>

                              <option value="Vadjenje zivca">Vadjenje zivca</option>
                              <option value="Stavljanje mosta">Stavljanje mosta</option>
                              <option value="Lecenje zuba">Lecenje zuba</option>

                             
                              

                            </select>
                            <input type="hidden" name="selected_text" id="selected_text" value="" />
    
                        </div>   
                        Datum pregleda:<br>
                        <input type="date" name="datumPregleda">
                        <br>
                        
                        <label>Vreme pregleda</label>
                        <br>
                            <select name="vremePregleda">
                              <option value="8:30">8:30</option>
                              <option value="9:00">9:00</option>
                              <option value="9:30">9:30</option>

                              <option value="10:00">10:00</option>
                              <option value="11:30">11:30</option>
                              <option value="12:00">12:00</option>
                              <option value="12:30">12:30</option>
                              <option value="12:00">13:00</option>
                              <option value="12:30">13:30</option>
                              <option value="12:00">14:00</option>
                              <option value="12:30">14:30</option>
                              <option value="12:00">16:00</option>
                              <option value="12:30">16:30</option>
                              <option value="12:00">17:00</option>
                              <option value="12:30">17:30</option>

                             
                              

                            </select>
                            <input type="hidden" name="selected_text" id="selected_text" value="" />
                        <input type="submit" name="save" value="Zakaži pregled">
                    </form>
                   </div>


                </div>
                        

      

    </div>
 
		<div id="footer">
      <p>Copyright &copy; FON <p>
    </div>

  </div>
  <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

</body>
</html>