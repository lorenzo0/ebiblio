<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Posto Lettura</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
    <!-- Bootstrap -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
      
  </head>
    
    <body>
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
                    <h4 class="card-title mt-3 text-center">Prenotazione Posto Lettura</h4>
                    <div class="imgcontainer">
                        <img src="../../images/postoLettura.png" alt="Avatar" class="avatar">
                    </div>
                   <form action="prenotazionePostoLettura.php" method="post"> 
                       
                        <div class="form-group input-group">
                            <input type="checkbox" id="ethernet" name="ethernet" value="yes">
                            <label style="margin-left: 15px;"> Ethernet </label>
                       </div>

                        <div class="form-group input-group">
                            <input type="checkbox" id="power" name="power" value="yes">
                            <label style="margin-left: 15px;"> Power </label>
                        </div>

                        <div class="form-group input-group">
                            <input type="date" placeholder="Inserisci la tua data di nascita" class="form-control" name="data" required>
                        </div> 
                       
                       <div class="form-group">
                            <button type="submit" name="disponibilita" id="disponibilita" class="btn btn-primary btn-block"> Vedi la disponibilità! </button>
                       </div>  
                   </form>   
                   
                </article>
            </div>
        </div>
        <footer class="text-center">
          <div class="container">
            <div class="row">
              <div class="col-12 pt-3">
                <p> Progetto di Basi di dati - 2020 </p>
              </div>
            </div>
          </div>
        </footer>
    </body>
</html>