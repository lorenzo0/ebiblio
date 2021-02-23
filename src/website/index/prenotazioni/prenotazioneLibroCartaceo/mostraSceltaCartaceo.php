<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio</title>
      
    <script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">  
      
    <script src="../../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../../utils/navbar.html"); 
          $("#footer").load("../../utils/footer.html"); 
        });
    </script>

  </head>
    <header></header>
    <body>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">
                    
                    <button class="backHomePage"> <a style="color:black;" href="controllaDisponibilitaCartaceo.php"> Torna alla ricerca </a></button>

                    <h4 class="card-title mt-3 text-center">Libri ora disponibili</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <img src="../../../images/library.png" alt="Avatar" class="avatar">
                    </div>
                    
                    <?php
                    
                        require '../../../../connectionDB/connection.php';
                    
                        $titolo = $_POST['Titolo'];
                        $genere = $_POST['Genere'];
                        
                    

                        try{
                            
                            if($_POST['Biblioteca'] != 'none'){ 
                                $nome = $_POST['Biblioteca'];
                                if($_POST['Isbn'] != ''){
                                    
                                    $isbn = $_POST['Isbn'];
                            
                                    $sql = "SELECT Libro.CodiceISBN, Titolo, NomeBiblioteca, StatoDiConservazione
                                            FROM Libro 
                                            join libridisponibili on (Libro.CodiceISBN = LibriDisponibili.CodiceISBN)
                                            join cartaceo on (Libro.CodiceISBN = Cartaceo.CodiceISBN)
                                            WHERE Libro.CodiceISBN = $isbn
                                            AND Cartaceo.StatoPrestito = 'Disponibile' 
                                            AND Libro.Genere = '$genere' 
                                            AND Libro.Titolo = '$titolo'
                                            AND NomeBiblioteca = '$nome';";
                                    
                                }else{
                                    $sql = "SELECT Libro.CodiceISBN, Titolo, NomeBiblioteca, StatoDiConservazione
                                            FROM Libro 
                                            join libridisponibili on (Libro.CodiceISBN = LibriDisponibili.CodiceISBN)
                                            join cartaceo on (Libro.CodiceISBN = Cartaceo.CodiceISBN)
                                            WHERE Cartaceo.StatoPrestito = 'Disponibile' 
                                            AND Libro.Genere = '$genere' 
                                            AND Libro.Titolo = '$titolo'
                                            AND NomeBiblioteca = '$nome';";
                                }
                                
                             }else {
                                
                                if($_POST['Isbn'] != ''){
                                    
                                    $isbn = $_POST['Isbn'];
                            
                                    $sql = "SELECT Libro.CodiceISBN, Titolo, NomeBiblioteca, StatoDiConservazione
                                            FROM Libro 
                                            join libridisponibili on (Libro.CodiceISBN = LibriDisponibili.CodiceISBN)
                                            join cartaceo on (Libro.CodiceISBN = Cartaceo.CodiceISBN)
                                            WHERE Libro.CodiceISBN = $isbn 
                                            AND Cartaceo.StatoPrestito = 'Disponibile' 
                                            AND Libro.Genere = '$genere' 
                                            AND Libro.Titolo = '$titolo';";
                                    
                                }else{
                                    $sql = "SELECT Libro.CodiceISBN, Titolo, NomeBiblioteca, StatoDiConservazione
                                            FROM Libro 
                                            join libridisponibili on (Libro.CodiceISBN = LibriDisponibili.CodiceISBN)
                                            join cartaceo on (Libro.CodiceISBN = Cartaceo.CodiceISBN)
                                            WHERE Cartaceo.StatoPrestito = 'Disponibile' 
                                            AND Libro.Genere = '$genere' 
                                            AND Libro.Titolo = '$titolo';";
                                }
                            }
                            $res = $pdo -> query($sql);
                            echo $sql;
                            
                        }catch(PDOException $e){echo $e->getMessage();}

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Titolo</th> 
                                    <th>Nome Biblioteca</th> 
                                    <th>Stato Conservazione</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                    

                            while ($row = $res->fetch()) {
                                $nomeBiblioteca = $row['NomeBiblioteca'];
                                $statoConservazione = $row['StatoDiConservazione'];
                                $codiceIsbn = $row['CodiceISBN'];
                                
                                echo "<tr>"; 
                                echo "<td><img src=" . "../../../images/book.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                                echo "<td>" . $titolo . "</td>";
                                echo "<td>" . $nomeBiblioteca . "</td>";
                                echo "<td>" . $statoConservazione . "</td>";
                                echo "<td>" . "<button style='background-color: #7ABB3B;'class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='prenotaCartaceo.php?Id=" . "$codiceIsbn" . "&Nome=" . $nomeBiblioteca . "'" . "> Prenota! </button></td>";
                                echo "</tr>"; 
                            }        
                    echo "</table></tbody>";
                    ?>
                    
                </article>
            </div>
            

        </div>
        <div id="footer"></div>
    </body>
</html>