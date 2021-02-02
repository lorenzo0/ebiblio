<?php

            require '../../../connectionDB/connection.php';

            /* Se vogliamo aggiungere il campo tipo_libro */
            switch($_SESSION['tipoLibro']){
                case 'cartaceo':
                    echo '<style type="text/css">
                        #cartaceoGroupExist { display: block; }
                        #cartaceoGroupNotExist { display: none; }
                        #ebookGroupNotExist { display: block; }
                    </style>';
                    break;

                case 'ebook':
                    echo '<style type="text/css">
                        #cartaceoGroupExist { display: none; }
                        #cartaceoGroupNotExist { display: block; }
                        #ebookGroupNotExist { display: none; }
                    </style>';
                    break;

                case 'entrambi':
                    echo '<style type="text/css">
                        #cartaceoGroupExist { display: block; }
                        #cartaceoGroupNotExist { display: none; }
                        #ebookGroupNotExist { display: none; }
                    </style>';
                    break;
            }
        ?>


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
    
    <body>
        
        <?php 
        
            if(isset($_POST['inserisci'])){
                $sql = "UPDATE cartaceo SET NumeroCopie = NumeroCopie + 1 WHERE CodiceISBN = ".$_GET['isbn'];
                $res = $pdo->exec($sql);
                if($res=0)
                    echo "<script type='text/javascript'>alert('Non è stata inserita una copia!');</script>";
                else
                    echo "<script type='text/javascript'>alert('Copia inserita correttamente!');</script>";
            }
        ?>
        
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
                    <h4 class="card-title mt-3 text-center">Aggiorna i dati del tuo libro</h4>
                    <div class="imgcontainer">
                        <img src="../../images/ebook.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
                       <div id = "cartaceoGroupExist">
                           
                           <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="inserisci"> Inserisci una copia cartacea! </button>
                            </div>
                           
                       </div>
                   </form>
                       
                    <div class="containerGroupsCartaceoEbook">
                       <div id = "cartaceoGroupNotExist">
                           <div class="form-group">
                                <a href="inserimentoLibro.php?tipo=cartaceo&isbn=<?php echo $_GET['isbn'] ?>" class="button"> Inserisci nuovo libro cartaceo  </a>
                           </div>
                       </div>
                       
                       <div id = "ebookGroupNotExist">
                           <div class="form-group">
                                <a href="inserimentoLibro.php?tipo=ebook&isbn=<?php echo $_GET['isbn'] ?>" class="button"> Inserisci nuovo libro ebook  </a>
                           </div>
                       </div>
                    </div>
               
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