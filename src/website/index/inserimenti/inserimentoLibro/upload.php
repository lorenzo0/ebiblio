<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
      

    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../utils/navbar.html"); 
          $("#footer").load("../utils/footer.html"); 
        });
    </script>
  </head>
    
    <header></header>
    <body>

      <div class="container" id="divContainer">
          <table class="table table-dark" style="background: rgba(0,0,0,0.5); ">
            <thead class="thead-dark">
              <tr align="center">
                <!--header della tabella-->
                <th colspan="5" scope="col">AGGIUNGI FOTO AL TUO PROFILO</th>
              </tr>
              <tr>
        <th><form method="post" enctype="multipart/form-data">
          Seleziona l'immagine da caricare:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Carica" name="submit"></form></th>
        </tr>
      </thead>
    </table>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<?php
$emailUtente = $_SESSION['EmailUtente'];
if($_SESSION['Tipologia'] == 'Amministratore'){
    $sql = "SELECT NomeBibliotecaAmministrata FROM Amministratore WHERE EmailUtente = '$emailUtente' ";
    $res = $pdo -> query($sql);

    while ($row = $res->fetch()) {
        $nomeBiblioteca = $row['NomeBibliotecaAmministrata'];
    }  
}
if(isset($_POST['submit'])){
    require '../../../../connectionDB/connection.php';
    $target_dir = "../../../../../pdf";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    /*$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);*/
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "pdf" ) {
        $uploadOk = 0;
    }else{
        $nomefoto=$_FILES["fileToUpload"]["name"];
        $sql="INSERT INTO foto values('$nomefoto', '$nomeBiblioteca')";
        $res = $pdo -> query($sql);
        
       echo 'sql: ' . $sql;
    }
}
?>