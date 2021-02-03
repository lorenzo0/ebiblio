<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Registration</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
    <!-- Bootstrap and CSS-->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/stile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> 
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
      
  </head>
    
    <body onload="onLoadRegistrazione()">
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
            <div class="card mt-4">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Registrati con il tuo account</h4>
                    <div class="imgcontainer">
                        <img src="../../images/book.png" alt="Avatar" class="avatar">
                    </div>
                <form action="registration.php" method="post" onsubmit="return validateFormRegistrazione()">
                    
                    <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci il tuo nome" class="form-control" name="nome" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci il tuo cognome" class="form-control" name="cognome" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="email" placeholder="Inserisci la tua email" class="form-control" name="email" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="password" placeholder="Inserisci la tua password" class="form-control" name="passwordUtente" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="date" placeholder="Inserisci la tua data di nascita" class="form-control" name="dataNascita" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci il tuo luogo di nascita" class="form-control" name="luogoNascita" required>
                    </div> 
                    
                    <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci il tuo numero di telefono" class="form-control" name="recapito" required>
                    </div> 
                    
                    
                    <label>Vorresti iscriverti come </label>
                        <select id="tipoUtente" name="tipoUtente" onchange="setVisibleForUser()">
                          <option value="none" selected>--------</option>  
                          <option value="Amministratore">Amministratore</option>
                          <option value="Utilizzatore">Utilizzatore</option>
                          <option value="Volontario">Volontario</option>
                        </select>
                    
                    <div id="utilizzatoreGroup" style="display:none">
                        <div class="form-group input-group">
                            <input type="text" placeholder="Inserisci la tua professione" class="form-control" name="professione" id="professione">
                        </div> 
                        <!-- Stato e data non sono necessarie, sono deducibili dalla sessione -->
                    </div>
                    
                    <div id="volontarioGroup" style="display:none">
                        <div class="form-group input-group">
                            <input type="text" placeholder="Inserisci il tuo mezzo di trasporto" class="form-control" name="mezzoDiTrasporto" id="mezzoDiTrasporto">
                        </div> 
                    </div>
                    
                    <div id="amministratoreGroup">
                        
                        <div id="biblioteca">
                            <label>Per quale biblioteca?</label>
                            <select name="nomeBiblioteca" id="nomeBiblioteca">
                                <?php 
                                    require '../../../connectionDB/connection.php';

                                    try {
                                        $sql = "SELECT * FROM Biblioteca";
                                        $res=$pdo->query($sql);
                                    }catch(PDOException $e) {
                                        echo("Query SQL Failed: ".$e->getMessage());
                                        exit();
                                    }

                                    while($row=$res->fetch()) {
                                        echo "<option value='" . $row['Nome'] . "'>" . $row['Nome'] . "</option>";
                                    }

                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group input-group">
                            <input type="text" placeholder="Inserisci la tua qualifica" class="form-control" name="qualifica" id="qualifica">
                        </div> 
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Crea account  </button>
                    </div>     
                <p class="text-center">Hai già un account? <a href="../login/loginPage.html">Accedi!</a> </p>      

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