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
	<link href="../../css/stile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#header").load("../utils/navbar.html"); 
          $("#footer").load("../utils/footer.html"); 
        });
    </script>
      
    <style type="text/css">
        table{
            text-align: center;
            font-size: 1.3em;
        }
        thead{
            display: flex;
            justify-content: space-between;
            padding: 15px;
        }
        
        tbody{
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            padding: 15px;
        }
        
        td{
            width: 150px;
            height: auto;
            justify-content: center;
            margin: 5px;
            padding: 5px;
        }
        
        tbody > tr{
            margin: 15px 0px 15px 0px;
        }
        
        thead > tr > td{
            font-weight: 800;
        }
        
        
        
    </style>

  </head>
    
    <body>
        <div id="header"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">

                    <h4 class="card-title mt-3 text-center">Tutti i libri</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <img src="../../images/book.png" alt="Avatar" class="avatar">
                    </div>
                    
                    <?php
                        require '../../../connectionDB/connection.php';

                        try{

                            $sql = "SELECT * FROM Libro";
                            $res = $pdo -> query($sql);
                        }catch(PDOException $e){echo $e->getMessage();}	

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Codice ISBN</td> 
                                    <td>Titolo</td> 
                                    <td>Anno</td> 
                                    <td>Genere</td> 
                                    <td>Nome Edizione</td>
                                    <td></td>
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
                                    echo "<img src=" . "../../images/book.png" . " alt=" . "Cartaceo" . " class=" . "avatar" . ">";
                                else if($tipoLibro == 'Ebook')
                                    echo "<img src=" . "../../images/ebook.png" . " alt=" . "Cartaceo" . " class=" . "avatar" . ">";
                                else if($tipoLibro == 'Entrambi'){
                                    echo "<img src=" . "../../images/ebook.png" . " alt=" . "Cartaceo" . " class=" . "avatar" . ">";
                                    echo "<img src=" . "../../images/book.png" . " alt=" . "Cartaceo" . " class=" . "avatar" . ">";
                                }
                                echo "</td>";
                                echo "<td>" . $isbn . "</td>";
                                echo "<td>" . $titolo . "</td>";
                                echo "<td>" . $anno . "</td>";
                                echo "<td>" . $genere . "</td>";
                                echo "<td>" . $nomeEdizione . "</td>";
                                echo "<td>" . "<button class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='dettagliLibro.php?Isbn=" .
                                    "$isbn" . "&Tipo=" . urlencode($tipoLibro) . "&Titolo=" . urlencode($titolo) . "&Anno=" . "$anno" . "&Genere=" . urlencode($genere) . "&NomeEdizione=" . urlencode($nomeEdizione) . "'" . "> Dettagli </button></td>";
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



<button class="btn" btn-primary="" btn-block="" onclick="location.href='dettagliLibro.php?Isbn=2&amp;Tipo=Entrambi&amp;Titolo=Ladra" di="" coltelli&anno="2000&amp;Genere=Tragico&amp;NomeEdizione=A" b="" c'=""> Dettagli </button>