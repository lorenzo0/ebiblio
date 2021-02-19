<?php

            require '../../../../connectionDB/connection.php';

            /* Se vogliamo aggiungere il campo tipo_libro 
            switch($_GET['tipo']){
                case 'Cartaceo':
                    echo '<style type="text/css">
                        #cartaceoGroupExist { display: block; }
                        #cartaceoGroupNotExist { display: none; }
                        #ebookGroupNotExist { display: block; }
                    </style>';
                    break;

                case 'Ebook':
                    echo '<style type="text/css">
                        #cartaceoGroupExist { display: none; }
                        #cartaceoGroupNotExist { display: block; }
                        #ebookGroupNotExist { display: none; }
                    </style>';
                    break;

                case 'Entrambi':
                    echo '<style type="text/css">
                        #cartaceoGroupExist { display: block; }
                        #cartaceoGroupNotExist { display: none; }
                        #ebookGroupNotExist { display: none; }
                    </style>';
                    break;
            }*/
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
    <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../../utils/navbar.html"); 
          $("#footer").load("../../utils/footer.html"); 
        });
    </script>
      
  </head>
    <header></header>
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
        
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Aggiorna i dati del tuo libro</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/ebook.png" alt="Avatar" class="avatar">
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
                                <a href="inserimentoLibro.php?tipo=cartaceo&isbn=<?php echo $_GET['isbn']; ?>&tipoLibro=<?php echo $_GET['tipo']; ?>" class="button"> Inserisci nuovo libro cartaceo  </a>
                           </div>
                       </div>
                       
                       <div id = "ebookGroupNotExist">
                           <div class="form-group">
                                <a href="inserimentoLibro.php?tipo=ebook&isbn=<?php echo $_GET['isbn']; ?>&tipoLibro=<?php echo $_GET['tipo']; ?>" class="button"> Inserisci nuovo libro ebook  </a>
                           </div>
                       </div>
                    </div>
               
                </article>
            </div>
             

        </div>
        <div id="footer"></div>
    </body>
    
    
</html>