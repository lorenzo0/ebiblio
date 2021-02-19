<?php require '../../../../connectionDB/connection.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Ebook</title>
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
    <body onload="setVisibleForLibro()">
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserisci Libro</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/library.png" alt="Avatar" class="avatar">
                    </div>
                   <form action="inserimentoNuovoLibroDB.php" method="post" onsubmit="return validateFormLibro();"> 
                       
                       <div class="form-group input-group">
                            <input type="number" placeholder="codice ISBN" class="form-control" name="codice" id="codice" value = <?php echo $_GET['isbn']; ?>required readonly>
                        </div>
                       
                       <label>Vorrei inserire il libro come </label>
                        <select id="tipoLibro" name="tipoLibro" onchange="setVisibleForLibro()">
                          <option value="None" <?php if(isset($_GET['tipo']) && $_GET['tipo'] == '') echo 'selected'; else echo ''; ?>>--------</option> 
                          <option value="Cartaceo" <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'Cartaceo') echo 'selected'; else if(isset($_GET['tipoLibro']) && $_GET['tipoLibro'] == 'Cartaceo') echo 'disabled'; else echo '';?>>Cartaceo</option>
                          <option value="Ebook" <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'Ebook') echo 'selected'; else if(isset($_GET['tipoLibro']) && $_GET['tipoLibro'] == 'Ebook') echo 'disabled'; else echo '';?>>Ebook</option>
                          <option value="Entrambi" <?php if(isset($_GET['tipoLibro']) && ($_GET['tipoLibro'] == 'Ebook' || $_GET['tipoLibro'] == 'Cartaceo')) echo 'disabled';?>>Entrambi</option>
                        </select>

                        <div class="form-group input-group">
                            <input type="text" placeholder="titolo" class="form-control" name="titolo" id="titolo" required>
                        </div>

                        <div class="form-group input-group">
                            <input type="number" placeholder="anno edizione" class="form-control" name="anno" id="anno" maxlength=4 required>
                        </div>

                        <div class="form-group input-group">
                            <input type="text" placeholder="genere" class="form-control" name="genere" id="genere" required>
                        </div>

                        <div class="form-group input-group">
                            <input type="text" placeholder="nome edizione" class="form-control" name="nomeEdizione" id="nomeEdizione" required>
                        </div> 
                       
                       
                       <!-- Cartaceo campi -->
                       
                       <div id = "cartaceoGroup">
                           <label>In che stato si trova il libro cartaceo? </label>
                            <select id="statoConservazione" name="statoConservazione">
                              <option value="none" selected>--------</option>  
                              <option value="Ottimo">Ottimo</option>
                              <option value="Buono">Buono</option>
                              <option value="NonBuono">Non buono</option>
                              <option value="Scadente">Scadente</option>
                            </select>

                           <div class="form-group input-group">
                                <input type="number" placeholder="numero di pagine" class="form-control" name="numeroPagine" id="numeroPagine">
                           </div> 

                           <div class="form-group input-group">
                                <input type="text" placeholder="numero scaffale" class="form-control" name="numeroScaffale" id="numeroScaffale">
                           </div> 
                           
                           <div class="form-group input-group">
                                <input type="number" placeholder="numero copie" class="form-control" name="numeroCopie" id="numeroCopie">
                           </div> 
                       </div>
                           
                       <!-- Ebook campi -->
                       <div id = "ebookGroup">
                            <div class="form-group input-group">
                                <input type="file" class="form-control" name="pdf" id="pdf" method ="post" >
                            </div>
                       </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Inserisci Libro </button>
                    </div> 
               </form>
                </article>
            </div>
            

        </div>
        <div id="footer"></div>
    </body>
</html>