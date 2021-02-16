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
          $("#header").load("../../utils/navbar.html"); 
          $("#footer").load("../../utils/footer.html"); 
        });
    </script>
      
  </head>
    <body>
        <div id="header"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Prenotazione Posto Lettura</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/postoLettura.png" alt="Avatar" class="avatar">
                    </div>
                   <form action="mostraScelta.php" method="post"> 
                       
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
                                
                                    $_SESSION['email-accesso'] = 'utilizzatore2@gmail.it';

                                    try{
                                        $sql = "SELECT Nome, Email FROM Biblioteca";
                                        $res = $pdo -> query($sql);
                                    }catch(PDOException $e){echo $e->getMessage();}	

                                    while ($row = $res->fetch()) {
                                        echo '<option value=' . $row['Email'] . '>' . $row['Nome'] . '</option>';
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
        <div id="footer"></div>
    </body>
</html>
