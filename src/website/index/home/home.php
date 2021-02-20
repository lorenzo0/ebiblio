<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Ebiblio - Home Page</title>
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
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">FIND A BOOK</h4>
                    <div class="imgcontainer">
                        <img src="../../images/book.png" alt="Avatar" class="avatar">
                    </div>
                    <form action="home.php" method="post">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default"><b>Titolo</b></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Titolo..." id="titolo" name="titolo">
                    </div>
                    
                    <div class="input-group mb-3">
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default">ISBN</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default" placeholder="000-00-000000-0-0" id="isbn" name="isbn">
                    </div>
                    
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default">Autore</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default" placeholder="..." id="autore" name="autore">
                    </div>
                        
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default">Genere</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default" placeholder="..." id="genere" name="genere">
                    </div>
                        
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default">Edizione</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default" placeholder="..." id="edizione" name="edizione">
                    </div>

                    <div class="form-group">
                        <button type="search" name="search" id="search" class="btn btn-block cerca" id="search">Cerca</button> 
                    </div>
                    </form>
                </article>
            </div>
        </div>
        
        <?php
        
            require '../../../connectionDB/connection.php';
            
            if(isset($_POST['search'])){
                $titoloLibro = $_POST['titolo'];
                $ISBN = $_POST['isbn'];
                $autoreLibro = $_POST['autore'];
                $genereLibro = $_POST['genere'];
                $edizioneLibro = $_POST['edizione'];

                try{
                    $sql = "SELECT *
                            FROM libriDisponibili as ld Join libro as l On ld.CodiceISBN = l.CodiceISBN
                            WHERE l.Titolo='$titoloLibro'";
                    $res = $pdo->query($sql); 
                    $rowCount = $res->rowCount();
                }catch(PDOException $e){ echo("Query SQL Failed: ".$e->getMessage());
                                            exit();}
            
            if($rowCount > 0){
            echo " 
                  <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Codice ISBN</th> 
                            <th>Titolo</th>
                            <th>Biblioteca</th>
                            <th>Anno</th>
                            <th>Genere</th>
                            <th>Nome Edizione</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>";


                    while ($row = $res->fetch()) {
                        $isbn = $row['CodiceISBN'];
                        $tipoLibro = $row['TipoLibro'];
                        $titolo = $row['Titolo'];
                        $biblioteca = $row['NomeBiblioteca'];
                        $anno = $row['Anno'];
                        $genere = $row['Genere'];
                        $nomeEdizione = $row['NomeEdizione'];
                        echo("<tr>");
                        echo("<td></td>");
                        echo("</tr>");
                        echo "<td>";
                        if($tipoLibro == 'Cartaceo')
                            echo "<img src=" . "../../images/book.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                        else if($tipoLibro == 'Ebook')
                            echo "<img src=" . "../../images/ebook.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                        else if($tipoLibro == 'Entrambi'){
                            echo "<img src=" . "../../images/ebook.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                            echo "<img src=" . "../../images/book.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                        }
                        echo "</td>";
                        echo "<td>" . $isbn . "</td>";
                        echo "<td>" . $titolo . "</td>";
                        echo "<td>" . $biblioteca . "</td>";
                        echo "<td>" . $anno . "</td>";
                        echo "<td>" . $genere . "</td>";
                        echo "<td>" . $nomeEdizione . "</td>";
                        echo "<td>" . "<button class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='../prenotazioni/prenotazioneLibroCartaceo/mostraSceltaCartaceo.php?Isbn=" .
                            "$isbn" . "&Tipo=" . urlencode($tipoLibro) . "&Titolo=" . urlencode($titolo) . "&Anno=" . "$anno" . "&Genere=" . urlencode($genere) . "&NomeEdizione=" . urlencode($nomeEdizione) . "'" . "> Prenota </button></td>"; 
                    }        
                    echo "</table></tbody>";
                    }else{
                        echo "<br/>NONE";
                    }
            }
            
        
        ?>
        
        
    </body>
</html>