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
    <body onload="setVisibleLibroDetails()">
        
        <?php
            require '../../../connectionDB/connection.php';
        
            $isbn = $_GET['Isbn'];
            $tipoLibro = $_GET['Tipo'];
            $titolo = $_GET['Titolo'];
            $anno = $_GET['Anno'];
            $genere = $_GET['Genere'];
            $nomeEdizione = $_GET['NomeEdizione'];
        
            try{
                switch($tipoLibro){
                    case "Cartaceo":
                        $sql = "SELECT * FROM Cartaceo WHERE CodiceISBN = '$isbn'";
                        $res = $pdo -> query($sql);
                        
                        while ($row = $res->fetch()) {
                            $statoConservazione = $row['StatoDiConservazione'];
                            $statoPrestito = $row['StatoPrestito'];
                            $numeroPagine = $row['NumeroPagine'];
                            $numeroScaffale = $row['NumeroScaffale'];
                        }   
                        
                        echo '<style>.ebookGroup { display:none;}</style>';
                        
                        break;
                    case "Ebook":
                        $sql = "SELECT * FROM Ebook WHERE CodiceISBN = '$isbn'";
                        $res = $pdo -> query($sql);
                        
                        while ($row = $res->fetch()) {
                            $dimensione = $row['Dimensione'];
                            $pdf = $row['PDF'];
                        }   
                        
                        echo '<style>.cartaceoGroup { display:none;}</style>';
                        break;
                    case "Entrambi":
                        /*$sql = "SELECT * FROM Ebook WHERE CodiceISBN = '$isbn'";
                        $res = $pdo -> query($sql);*/
                        
                        $sql = "SELECT * FROM Cartaceo WHERE CodiceISBN = '$isbn'";
                        $res = $pdo -> query($sql);
                        
                        while ($row = $res->fetch()) {
                            $statoConservazione = $row['StatoDiConservazione'];
                            $statoPrestito = $row['StatoPrestito'];
                            $numeroPagine = $row['NumeroPagine'];
                            $numeroScaffale = $row['NumeroScaffale'];
                        }   
                        
                        /*while ($row = $res->fetch()) {
                            $dimensione = $row['Dimensione'];
                            $pdf = $row['PDF'];
                        } */  
                        
                        break;
                }
            }catch(PDOException $e){echo $e->getMessage();}	
        ?>
        <div class="topnav">
            <a href="dettagliLibro.php" class="active">Dettagli Libro</a>
        </div>   
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 800px;">
                    
                    <button class="backHomePage"> <a style="color:#fff;" href="visualizzazioneLibri.php"> Torna alla lista </a></button>

                    <h4 class="card-title mt-3 text-center">Dettagli libro - <?php echo $titolo; ?></h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <img src="../../images/book.png" alt="Avatar" class="avatar">
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Titolo:</label>
                        <div class="col-7">
                            <input type=”text” class="form-control" name="nome" id="nome" value = "<?php echo $titolo ?>"readonly> 
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Anno:</label>
                        <div class="col-7">
                            <input type=”text” class="form-control" name="cognome" id="cognome" value = "<?php echo $anno ?>"readonly> 
                        </div>
                    </div>
                    
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Genere:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="dataNascita" value = "<?php echo $genere ?>" readonly>
                            </div>
                    </div>
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Nome Edizione:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $nomeEdizione ?>" readonly>
                            </div>
                    </div>
                    
                    
                    
                    <div class="cartaceoGroup">
                        
                        <div class="form-group row">
                            <label class="col-4 col-form-label">Stato Conservazione:</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $statoConservazione; ?>" readonly>
                                </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-4 col-form-label">Stato Prestito:</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $statoPrestito; ?>" readonly>
                                </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-4 col-form-label">Numero Pagine:</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $numeroPagine; ?>" readonly>
                                </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-4 col-form-label">Numero Scaffale:</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $numeroScaffale; ?>" readonly>
                                </div>
                        </div>
                        
                    </div>
                    
                    <div class="ebookGroup">
                        
                        <div class="form-group row">
                            <label class="col-4 col-form-label">Dimensione:</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $dimensione; ?>" readonly>
                                </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-group input-group">
                        <label class="col-4 col-form-label">Autori:</label>
                            <div class="col-7">
                                <select class="form-control">
                                    <?php
                                        try{
                                            $sql = "Select NomeAutore 
                                            from autore join scrittori on(id=IdAutore)
                                            where codiceISBN = $isbn;";
                                            $res = $pdo -> query($sql);
                                        }catch(PDOException $e){echo $e->getMessage();}	

                                        while ($row = $res->fetch()) {
                                            echo '<option>' . $row['NomeAutore'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                       </div> 
                    
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