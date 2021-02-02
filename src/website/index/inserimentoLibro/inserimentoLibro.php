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
      
  </head>
    
    <body onload="setVisibleForLibro()">
        <nav class="navbar navbar-expand-lg navbar-dark bg-verde">
          <a class="navbar-brand" href="#"><img src="../../images/bookcase.png" alt="brand"/></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
              <a class="nav-link metalink" href="#"><img src="../../images/bookcase.png" alt="brand"/></a>

          </div>
        </nav>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserisci Libro</h4>
                    <div class="imgcontainer">
                        <img src="../../images/ebook.png" alt="Avatar" class="avatar">
                    </div>
                   <form action="inserimentoNuovoLibroDB.php" method="post" onsubmit="validateFormLibro()" enctype="multipart/form-data"> 
                       
                       <div class="form-group input-group">
                            <input type="number" placeholder="codice ISBN" class="form-control" name="codice" id="codice" value = <?php echo $_GET['isbn'] ?>required>
                        </div>
                       
                       <label>Vorrei inserire il libro come </label>
                        <select id="tipoLibro" name="tipoLibro" onchange="setVisibleForLibro()">
                          <option value="none" <?php if(isset($_GET['tipo']) && $_GET['tipo'] == '') echo 'selected'; else echo '';?>>---------</option> 
                          <option value="cartaceo" <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'cartaceo') echo 'selected'; else echo '';?>>Cartaceo</option>
                          <option value="ebook" <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'ebook') echo 'selected'; else echo '';?>>Ebook</option>
                          <option value="entrambi">Entrambi</option>
                        </select>
                       

                        <div class="form-group input-group">
                            <input type="text" placeholder="titolo" class="form-control" name="titolo" id="titolo" required>
                        </div> <!-- form-group// -->

                        <div class="form-group input-group">
                            <input type="number" placeholder="anno edizione" class="form-control" name="anno" id="anno" maxlength=4 required>
                        </div> <!-- form-group// -->

                        <div class="form-group input-group">
                            <input type="text" placeholder="genere" class="form-control" name="genere" id="genere" required>
                        </div> <!-- form-group// -->

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
                       </div>
                           
                       <!-- Ebook campi -->
                       <div id = "ebookGroup">
                            <div class="form-group input-group">
                                <input type="file" class="form-control" name="pdf" id="pdf" >
                                <!-- accept="application/pdf" -->
                            </div>
                       </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Inserisci Libro </button>
                    </div> 
               </form>
                </article>
            </div>
            

        </div>
        <footer class="text-center">
          <div class="container">
            <div class="row">
              <div class="col-12 pt-3">
                <p> Progetto di Base di dati - 2020 </p>
              </div>
            </div>
          </div>
        </footer>
    </body>
</html>