<?php

            require '../../../../connectionDB/connection.php';
             /*if ($_SESSION['TipoUtente']!="Amministratore"){
                echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>"; 
            }*/

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
            }
        ?>


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
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#footer").load("../../utils/footer.html"); 
        });
    </script>
      
  </head>
    <header></header>
    <body>
        
        <?php 
        
            try{
                $sql = "SELECT * from libro where CodiceISBN=" .$_GET['isbn'];
                $res = $pdo -> query($sql);
            }catch(PDOException $e){echo $e->getMessage();}	

            while ($row = $res->fetch()) {
                $titolo = $row['Titolo'];
                $annoEdizione = $row['Anno'];
                $genere = $row['Genere'];
                $nomeEdizione = $row['NomeEdizione'];
            }
        
            if(isset($_POST['inserisci'])){
                try{
                    $sql = "UPDATE libridisponibili SET NumeroCopie = NumeroCopie + 1 WHERE CodiceISBN = ".$_GET['isbn'];
                    $res = $pdo->query($sql);
                }catch(PDOException $e){echo $e->getMessage();}	
                
                    
                if($res=0)
                    echo "<script type='text/javascript'>alert('Non è stata inserita una copia!');</script>";
                else
                    echo "<script type='text/javascript'>alert('Copia inserita correttamente!');</script>";
            }
        ?>
        <div class="topnav">
            <a href="../../home/adminHome.php">Home</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Inserimenti
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../inserimentoAmministratore/inserimentoAmministratore.html" >Inserisci utente</a>
                    <a href="../inserimentoAutore/inserimentoAutore.php">Inserisci autore</a>
                    <a href="../inserimentoBiblioteca/inserimentoBiblioteca.php">Inserisci biblioteca</a>
                    <a href="../inserimentoPostoLettura/inserimentoPostoLettura.php">Posto lettura</a>
                    <a href="inserimentoISBN.php" class="active">Inserisci libro</a>      
                </div>
            </div>
                <a href="../inserimenti/inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a> 
            <a href="../../cancellazioni/cancellazioneSegnalazioni.php">Cancella segnalazione</a> 
            <a href="../inserimentoMessaggio/inserimentoMessaggio.php">Messaggi</a>
            <button class="logout" style="float:right" onClick="location='../../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../../profilo/profilo.php'">Account</button>
        </div>
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
                                <a href="inserimentoLibro.php?tipo=Cartaceo&isbn=<?php echo $_GET['isbn']; ?>&titolo=<?php echo $titolo; ?>&genere=<?php echo $genere; ?>&nomeEdizione=<?php echo nomeEdizione; ?>&annoEdizione=<?php echo annoEdizione; ?>&tipoLibro=<?php echo $_GET['tipo']; ?>" class="button"> Inserisci nuovo libro cartaceo  </a>
                           </div>
                       </div>
                       
                       <div id = "ebookGroupNotExist">
                           <div class="form-group">
                               <a href="inserimentoLibro.php?tipo=Ebook&isbn=<?php echo $_GET['isbn']; ?>&titolo=<?php echo $titolo; ?>&genere=<?php echo $genere; ?>&nomeEdizione=<?php echo $nomeEdizione; ?>&annoEdizione=<?php echo $annoEdizione; ?>&tipoLibro=<?php echo $_GET['tipo']; ?>" class="button"> Inserisci nuovo libro ebook  </a>
                           </div>
                       </div>
                    </div>
               
                </article>
            </div>
             

        </div>
        <div id="footer"></div>
    </body>
    
    
</html>