<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio</title>
      
    <script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">  
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../utils/navbar.html"); 
          $("#footer").load("../utils/footer.html"); 
        });
    </script>

  </head>
    
    <body>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">
                    
                    <button class="backHomePage"> <a style="color:black;" href="../home/home.php"> Torna alla homepage </a></button>

                    <h4 class="card-title mt-3 text-center">Volontari che hanno effettuato più consegne</h4>


                    
                    <?php
                    
                        require '../../../connectionDB/connection.php';

                        try{
                            
                            $sql = "Select EmailVolontario, count(*) AS Tot
                                    from Consegna, Utente, Volontario
                                    where Email = EmailUtente AND EmailVolontario = EmailUtente
                                    group by EmailVolontario
                                    order by Tot DESC, DataNascita";
                            $res = $pdo -> query($sql);
                            
                        }catch(PDOException $e){echo $e->getMessage();}

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Email Volontario</th> 
                                    <th>Totale Consegne</th> 
                                </tr>
                            </thead>
                            <tbody>";
                    
                    //nel while scrivo la classifica, var i = 0 
                   //$i = 0;
                   // $varTot = ['Tot']
                     
                    //mettere tutto in una struttra in modo di avere le posizioni???
                        
                            while ($row = $res->fetch()) {
                                $email = $row['EmailVolontario'];
                                $totale = $row['Tot'];

                                echo "<tr>"; 
                                
                                 echo "<td><img src=" . "../../images/kick-scooter.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                               
                               /* if($res->fetch() = 1) {
                                   echo "<td><img src=" . "../../images/primo.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                              //  } 
                                
                               // if ($res->fetch() = 2) {
                                    echo "<td><img src=" . "../../images/secondo.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                               // } 
                                
                               // if ($res->fetch() = 3) {
                                echo "<td><img src=" . "../../images/terzo.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                               // }*/

                                
                                echo "<td>" . $email . "</td>";
                                echo "<td>" . $totale . "</td>";
                                echo "</tr>"; 
                               // echo count(count($row));
                                //$i = $i+1;
                            }        
                    echo "</table></tbody>";
                    ?>
                    
                </article>
            </div>
            

        </div>
        <div id="footer"></div>
    </body>
</html>