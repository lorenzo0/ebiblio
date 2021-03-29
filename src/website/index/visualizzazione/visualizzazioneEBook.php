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
  </head>
    <header></header>
    <body>
        <div><button class="backHomePage" style="margin-top: 135px"> <a style="color:#fff;" href="visualizzazioneLibri.php"> Torna alla lista </a></button></div>
           <div><?php
               require '../../../connectionDB/connection.php';
                $isbn = $_GET['Isbn'];
               try {
                  
                  $sql = "UPDATE Ebook SET NumeroAccessi = NumeroAccessi+1 where CodiceISBN = $isbn";
                  $res = $pdo->query($sql);

                  $sql = "SELECT * from Ebook where CodiceISBN = $isbn";
                  $res = $pdo->query($sql);

                  echo "<tr>";
                  while ($row = $res->fetch()) {
                     $url = "../../../../pdf/" . $row['PDF'];
                     echo '<iframe src="'. $url .'" width="100%" height="700px"></tr>';
                  }
               } catch (Exception $ex) {
                  $ex->getMessage();
                  exit();
               }
           ?>
        </div>
    </body>
    <footer class="text-center text-white" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer>
</html>