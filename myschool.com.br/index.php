<?php
session_start();

  if( !(isset($_SESSION['login']) && $_SESSION['login']==true) ){
    header('location:login.php');
    exit();
}  


include 'application/dao/Connection.php';
include 'biblioteca/Conversor.php';
include 'biblioteca/Validator.php';

if( isset($_GET['page']) ){
    $page = $_GET['page'];
    $php='';
    $class='';
    $folder='';
    $fullpath='';
    if(strpos($page, "_")!= 0){
        $vetor = explode("_", $page);
        $folder = $vetor[0];
        $class = $vetor[1];
        
    }else{
        $file = "";
        $class = "";
    } 
   
    $fullpath = "$folder/$class.php";
   
    if(file_exists($fullpath) == false){
        $fullpath = "begin.php";
    }   
} else {
      $fullpath = "begin.php";
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Minha escola</title>
    		<!-- Chamada do CSS -->
    		<link rel="stylesheet" href="css/estilo.css" >
    		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  			<script src="biblioteca/js/function.js"></script>

    </head>
      <body>
    		<?php include "top.php"; ?>
    		<!-- BEGIN SITE CONTENT -->
    		<div id="main-content">
    			<?php include $fullpath; ?>
    		</div>
    		<!-- END SITE CONTEND -->
    		<?php include "foot.php"; ?>
    		
    <!--  These sripts are here rader than head because page charge faster this form.-->
     <!-- Renderisation is totally finashed, and user doesn't notice page charge. -->
          
    		    		<!-- Framework JQuery -->
    	<script src="bootstrap/js/jquery-1.12.4.min.js"></script>
    				
		<!--  Plugin para mascara monetária and control drop-drown menu too.-->
		<script src="bootstrap/js/jquery.maskMoney.js"></script>
  		<script src="bootstrap/js/bootstrap.min.js"></script> 
  		
  		<!-- Plugin para mascara para data -->
		<script src="bootstrap/js/maskedinput.min.js"></script>
      </body>

</html>

