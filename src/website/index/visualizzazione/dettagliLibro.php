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
          $("#header").load("../utils/navbar.html"); 
          $("#footer").load("../utils/footer.html"); 
        });
    </script>
      
      

  </head>
    
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
        <div id="header"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 800px;">

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
                        
                        <!--se può accedere anche da qua l'utente bisogna gestire l'incremento del numero accessi-->
                        <div class="form-group row">
                            <label class="col-4 col-form-label">PDF:</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $pdf; ?>" readonly>
                                </div>
                        </div>
                        
                    </div>
                    
                </article>
            </div>
            

        </div>
        <div id="footer"></div>
    </body>
</html>