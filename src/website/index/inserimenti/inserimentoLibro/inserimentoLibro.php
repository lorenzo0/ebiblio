<?php 
require '../../../../connectionDB/connection.php'; 
    if($_SESSION['TipoUtente']=="Utilizzatore"){
     echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/myHome.php'</script>";
 }else if($_SESSION['TipoUtente']=="Volontario"){
     echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/volHome.php'</script>";
 }else if($_SESSION['TipoUtente']==""){
     echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
 }else if ($_SESSION['TipoUtente']=="SuperUser"){
     echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/superUserHome.php'</script>";
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
    <script src="../../../js/script.js"></script>
    <script>       
        $(document).ready(function(){  
              var i=1;  
              $('#aggiungi').click(function(){  
                   i++;  
                   $('#dynamic_field').append('<tr id="row'+i+'"><td><select name="autore[]" id="autore[]" class="form-control"><?php try{ $sql = "SELECT Distinct(NomeAutore), Id FROM Autore"; $res = $pdo -> query($sql); }catch(PDOException $e){echo $e->getMessage();} while ($row = $res->fetch()) {  echo '<option value=' . $row['Id'] . '>' . $row['NomeAutore'] . '</option>';}?></select></td>  <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
              });  
              $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");   
                   $('#row'+button_id+'').remove();  
              });  
         }); 
   
    </script>
  </head>
    <header></header>
    <body onload="setVisibleForLibro()">
            
        <div class="topnav">
            <a href="../../home/adminHome.php">Home</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Inserimenti
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../inserimentoAutore/inserimentoAutore.php">Inserisci autore</a>
                    <a href="../inserimentoPostoLettura/inserimentoPostoLettura.php" >Inserisci Posto lettura</a>
                    <a href="nserimentoISBN.php" class="active">Inserisci libro</a>  
                </div>
            </div>
            <a href="../../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <a href="../inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a> 
            <a href="../../cancellazioni/cancellazioneSegnalazioni.php">Cancella segnalazione</a> 
            <a href="../inserimentoMessaggio/inserimentoMessaggio.php">Messaggio</a>
            <button class="logout" style="float:right" onClick="location='../../login/logout.php'">Logout</button>
        </div>        
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 600px;">
                    <h4 class="card-title mt-3 text-center">Inserisci Libro</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/library.png" alt="Avatar" class="avatar">
                    </div>
                   <form action="inserimentoNuovoLibroDB.php" method="post" onsubmit="return validateFormLibro();" enctype="multipart/form-data"> 
                       
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
                            <input type="text" placeholder="titolo" class="form-control" name="titolo" id="titolo" <?php if(isset($_GET['titolo'])) echo 'value=' . $_GET['titolo'] . ' readonly'?> required>
                        </div>

                        <div class="form-group input-group">
                            <input type="number" placeholder="anno edizione" class="form-control" name="anno" id="anno" maxlength=4 <?php if(isset($_GET['annoEdizione'])) echo 'value=' . $_GET['annoEdizione'] . ' readonly'?> required>
                        </div>

                        <div class="form-group input-group">
                            <input type="text" placeholder="genere" class="form-control" name="genere" id="genere" <?php if(isset($_GET['genere'])) echo 'value=' . $_GET['genere'] . ' readonly'?> required>
                        </div>

                        <div class="form-group input-group">
                            <input type="text" placeholder="nome edizione" class="form-control" name="nomeEdizione" id="nomeEdizione" <?php if(isset($_GET['nomeEdizione'])) echo 'value=' . $_GET['nomeEdizione'] . ' readonly'?> required>
                        </div>
                       
                       <?php 
                            if(isset($_GET['tipoLibro'])) echo '<style type="text/css"> #autoriDaInserire { display: none; } </style>';
                       ?>
                       
                       <label> Autori del libro: </label>
                       <div class="form-group" id="autoriDaInserire">  
                           <table class="table table-bordered" id="dynamic_field" style="margin-top:0px;">  
                                <tr>  
                                     <td>
                                         <select name="autore[]" id="autore[]" class="form-control">
                                            <?php

                                                try{
                                                    $sql = "SELECT Distinct(NomeAutore), Id FROM Autore";
                                                    $res = $pdo -> query($sql);
                                                }catch(PDOException $e){echo $e->getMessage();}	

                                                while ($row = $res->fetch()) {
                                                    echo '<option value=' . $row['Id'] . '>' . $row['NomeAutore'] . '</option>';
                                                }

                                            ?>
                                        </select>
                                    </td>  
                                     <td><button type="button" name="aggiungi" id="aggiungi" class="btn btn-success">Aggiungi</button></td>  
                                </tr>  
                           </table> 
                        </div> 
                       
                       
                       <!-- Cartaceo campi -->
                       
                       <div id = "cartaceoGroup">
                           <label>In che stato si trova il libro cartaceo? </label>
                            <select id="statoConservazione" name="statoConservazione">
                              <option value="none" selected>--------</option>  
                              <option value="Ottimo">Ottimo</option>
                              <option value="Buono">Buono</option>
                              <option value="Non Buono">Non buono</option>
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
         
    </body>
    <footer class="text-center text-white" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer>
   
</html>