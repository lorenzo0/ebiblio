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
          $("#header").load("../utils/navbar.html"); 
          $("#footer").load("../utils/footer.html"); 
        });
    </script>

  </head>
    
    <body>
        <div id="header"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">
                    
                    <button class="backHomePage"> <a style="color:black;" href="../home/homepage.php"> Torna alla homepage </a></button>

                    <h4 class="card-title mt-3 text-center">Tutte le biblioteche</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <a href="visualizzazioneBiblioteca.php"><img src="../../images/library.png" alt="Avatar" class="avatar"></a>
                    </div>
                    
                    <?php
                    
                        require '../../../connectionDB/connection.php';

                        try{
                            
                            $sql = "SELECT Nome, Indirizzo, Email, Recapito, URLSito, COUNT(postolettura.EmailBiblioteca) AS NumeroPostiLettura
                                    FROM BIBLIOTECA, POSTOLETTURA
                                    WHERE Biblioteca.Email = postolettura.EmailBiblioteca
                                    GROUP BY postolettura.EmailBiblioteca";
                            $res = $pdo -> query($sql);
                            
                        }catch(PDOException $e){echo $e->getMessage();}

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome</th> 
                                    <th>Indirizzo</th> 
                                    <th>Email</th>
                                    <th>URL Sito</th>
                                    <th>Recapito</th>
                                    <th>Posti lettura</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                    

                            while ($row = $res->fetch()) {
                                $nomeBiblioteca = $row['Nome'];
                                $indirizzo = $row['Indirizzo'];
                                $email = $row['Email'];
                                $URLSito = $row['URLSito'];
                                $recapito = $row['Recapito'];
                                $numeroPosti = $row['NumeroPostiLettura'];
                                
                                echo "<tr>"; 
                                echo "<td><img src=" . "../../images/inserimentoCartaceo.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                                echo "<td>" . $nomeBiblioteca . "</td>";
                                echo "<td>" . $indirizzo . "</td>";
                                echo "<td>" . $email . "</td>";
                                echo "<td><a href='$URLSito'> $URLSito </a></td>";
                                echo "<td>" . $recapito . "</td>";
                                echo "<td>" . $numeroPosti . "</td>";
                                echo "</tr>"; 
                            }        
                    echo "</table></tbody>";
                    ?>
                    
                </article>
            </div>
            

        </div>
        <div id="footer"></div>
    </body>
</html>