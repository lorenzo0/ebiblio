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
    
  </head>
    <header></header>
    <body>
        <div class="topnav">
            <a href="../home/home.php" >Home</a>
            <a href="../../openStreetMap/map.html">MAP</a>
            <a href="visualizzazioneBiblioteca.php" class="active" >Tutte le biblioteche</a>
            <a href="../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <a href="../visualizzazione/visualizzazionePostiLettura.php">Tutti i posti lettura</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Statistiche
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../statistiche/ebookPiuAcceduti.php">EBook più acceduti</a>
                    <a href="../statistiche/numCartaceiPrenotati.php">Numero Cartacei Prenotati</a>
                    <a href="../statistiche/numConsegneVolontario.php">Consegne Volontario</a>
                    <a href="../statistiche/postoLetturaMenoUtilizzati.php">Posti lettura meno utilizzati</a>
                </div>
            </div>
            <div class="login-container">
                <button onClick="location='../login/login.php'">Accedi</button>
                <button onClick="location='../registrazione/registrazione.php'">Registrati</button>
            </div>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">

                    <h4 class="card-title mt-3 text-center">Tutte le biblioteche</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <a href="visualizzazioneBiblioteca.php"><img src="../../images/library.png" alt="Avatar" class="avatar"></a>
                    </div>
                    
                    <?php
                    
                        require '../../../connectionDB/connection.php';

                        try{
                            
                            $sql = "SELECT Nome, Indirizzo, Email, URLSito, COUNT(postolettura.NomeBiblioteca) AS NumeroPostiLettura
                                    FROM Biblioteca, postolettura
                                    WHERE Biblioteca.Nome = postolettura.NomeBiblioteca
                                    GROUP BY postolettura.NomeBiblioteca";
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
                                $numeroPosti = $row['NumeroPostiLettura'];
                                
                                echo "<tr>"; 
                                echo "<td><img src=" . "../../images/library.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . "></td>";
                                echo "<td>" . $nomeBiblioteca . "</td>";
                                echo "<td>" . $indirizzo . "</td>";
                                echo "<td>" . $email . "</td>";
                                echo "<td><a href='$URLSito'> $URLSito </a></td>";
                                echo "<td>" . $numeroPosti . "</td>";
                                echo "</tr>"; 
                            }        
                    echo "</table></tbody>";
                    ?>
                    
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