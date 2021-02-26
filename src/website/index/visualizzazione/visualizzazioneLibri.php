<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Ebook</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#footer").load("../utils/footer.html"); 
        });
    </script>

  </head>
    <header></header>
    <body>
        <div class="topnav">
            <a href="../home/home.php" >Home</a>
            <a href="../../openStreetMap/map.html">MAP</a>
            <a href="../visualizzazione/visualizzazioneBiblioteca.php" >Tutte le biblioteche</a>
            <a href="visualizzazioneLibri.php" class="active">Tutti i libri</a>
            
            <div class="login-container">
                <button onClick="location='../login/login.php'">Accedi</button>
                <button onClick="location='../registrazione/registrazione.php'">Registrati</button>
            </div>
        </div>        
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">

                    <h4 class="card-title mt-3 text-center">Tutti i libri</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <a href="visualizzazioneLibri.php"><img src="../../images/book.png" alt="Avatar" class="avatar"></a>
                    </div>
                    
                    <div class="filters">
                        <center>
                        <form method="post">
                            
                            
                                <select id="filterTipoLibro" name="filterTipoLibro" style="margin-right: 10px;">
                                  <option value="none" selected>Tipo Libro</option>  
                                  <option value="Cartaceo">Cartaceo</option>
                                  <option value="Ebook">Ebook</option>
                                  <option value="Entrambi">Entrambi</option>
                                </select>
                            
                            
                                <select id="filterGenere" name="filterGenere" style="margin-right: 10px;">
                                    <option value="none" selected>Genere</option> 
                                   <?php 
                                        require '../../../connectionDB/connection.php';

                                        try {
                                            $sql = "SELECT Distinct(Genere) FROM Libro";
                                            $res=$pdo->query($sql);
                                        }catch(PDOException $e) {
                                            echo("Query SQL Failed: ".$e->getMessage());
                                            exit();
                                        }

                                        while($row=$res->fetch()) {
                                            echo "<option value='" . $row['Genere'] . "'>" . $row['Genere'] . "</option>";
                                        }

                                    ?>
                                </select>
                            
                             <button type="submit" name="filter" class="btn cerca"> Filtra! </button>
                            
                        </form>
                        </center>
                    </div>
                    
                    <?php

                        try{
                            if(isset($_POST['filter'])){
                                if(($_POST['filterTipoLibro'] != 'none') && ($_POST['filterGenere'] != 'none')){
                                    $genereFilter = $_POST['filterGenere'];
                                    $tipoLibroFilter = $_POST['filterTipoLibro'];

                                    $sql = "SELECT * FROM Libro WHERE Genere = '$genereFilter' AND TipoLibro = '$tipoLibroFilter'";
                                }else if(($_POST['filterTipoLibro'] != 'none') && ($_POST['filterGenere'] == 'none')){
                                    $tipoLibroFilter = $_POST['filterTipoLibro'];

                                    $sql = "SELECT * FROM Libro WHERE TipoLibro = '$tipoLibroFilter'";
                                }else if(($_POST['filterTipoLibro'] == 'none') && ($_POST['filterGenere'] != 'none')){
                                    $genereFilter = $_POST['filterGenere'];

                                    $sql = "SELECT * FROM Libro WHERE Genere = '$genereFilter'";
                                }else
                                    $sql = "SELECT * FROM Libro";
                                
                                $res = $pdo -> query($sql);
                            }else{
                                $sql = "SELECT * FROM Libro";
                                $res = $pdo -> query($sql);
                            }
                        }catch(PDOException $e){echo $e->getMessage();}	

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Codice ISBN</th> 
                                    <th>Titolo</th> 
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
                                $anno = $row['Anno'];
                                $genere = $row['Genere'];
                                $nomeEdizione = $row['NomeEdizione'];
                                
                                echo "<tr>"; 
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
                                echo "<td>" . $anno . "</td>";
                                echo "<td>" . $genere . "</td>";
                                echo "<td>" . $nomeEdizione . "</td>";
                                echo "<td>" . "<button class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='dettagliLibro.php?Isbn=" .
                                    "$isbn" . "&Tipo=" . urlencode($tipoLibro) . "&Titolo=" . urlencode($titolo) . "&Anno=" . "$anno" . "&Genere=" . urlencode($genere) . "&NomeEdizione=" . urlencode($nomeEdizione) . "'" . "> Dettagli </button></td>";
                                echo "<td>" . "<button style='background-color:#bb2e29;' class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='../cancellazioni/cancellazioneLibro.php?Isbn=" . "$isbn" . "&Tipo=" . urlencode($tipoLibro) . "'" . "><i class='fa fa-trash'></i></button></td>";
                                echo "</tr>"; 
                            }        
                    echo "</table></tbody>";
                    ?>
                    
                </article>
            </div>
            

        </div>
    </body>
    <footer class="text-center text-white" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer>
</html>