<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
    <!-- Bootstrap -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
      
      <script>
        $(function loadNavFoo(){
          $("#navbar").load("../../utils/navbar.html"); 
          $("#footer").load("../../utils/footer.html"); 
        });
    </script>
      
  </head>
    <header></header>
    <body>
        <div class="topnav">
            <a href="../../home/myHome.php">Home</a>
            <a href="controllaDisponibilitaPostoLettura.php"class="active">Prenota posto lettura</a>
            <a href="../prenotazioneLibroCartaceo/controllaDisponibilitaCartaceo.php">Prenota Libro</a>            
            <a href="../../visualizzazione/visualizzazioneLibri.php" >Visualizza EBook</a>
            <a href="../../profilo/conversazioni.php">Conversazioni</a>
             <a href="../../profilo/prenotazioniEffettuate.php">Prenotazioni</a>
            <a href="../../profilo/visualizzazioneSegnalazioni.php" >Segnalazioni</a>
            <button class="logout" style="float:right" onClick="location='../../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../../profilo/profilo.php'">Account</button>
            
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Prenotazione Posto Lettura</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/postoLettura.png" alt="Avatar" class="avatar">
                    </div>
                   <form action="mostraSceltaPostoLettura.php" method="post"> 
                       
                        <div class="form-group input-group">
                            <input type="checkbox" id="Ethernet" name="Ethernet" value="yes">
                            <label style="margin-left: 15px; margin-right: 50px;"> Ethernet </label>
                            
                            <input type="checkbox" id="Power" name="Power" value="yes">
                            <label style="margin-left: 15px;"> Power </label>
                       </div>
                       
                        <div class="form-group input-group">
                            <label> Hai una biblioteca in particolare dove vorresti andare?</label>
                            <select name="Biblioteca" id="Biblioteca" class="form-control">
                                <option value='none'> ----- </option>
                                <?php
                                
                                    require '../../../../connectionDB/connection.php';   

                                    try{
                                        $sql = "SELECT Nome FROM Biblioteca";
                                        $res = $pdo -> query($sql);
                                    }catch(PDOException $e){echo $e->getMessage();}	

                                    while ($row = $res->fetch()) {
                                        echo '<option value=' . urlencode($row['Nome']) . '>' . $row['Nome'] . '</option>';
                                    }

                                ?>
                            </select>
                        </div> 
                       
                       <label> Inserisci la data in cui vorresti prenotare</label>
                       <div class="form-group input-group">
                            <input type="date" class="form-control" name="Data" required>
                        </div> 
                       
                       <div class="form-group input-group">
                            <label> A che ora vorresti iniziare la tua prenotazione? </label>
                               <select class="form-control" id="OraInizio" name="OraInizio" required>
                                    <?php   

                                        for($i=9;$i<20;$i++){
                                            echo '<option value=' . $i. '>' . $i . ':00' . '</option>';
                                        }

                                    ?>
                               </select>
                        </div> 
                       
                       <div class="form-group input-group">
                            <label> Per quanto tempo vuoi prenotare il posto lettura? </label>
                              <select class="form-control" id="Durata" name="Durata" required>
                                <option value= 1>1 ora</option>
                                <option value= 2>2 ore</option>
                                <option value= 3>3 ore</option>
                              </select>
                        </div>
                       
                       <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Vedi la disponibilità! </button>
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
