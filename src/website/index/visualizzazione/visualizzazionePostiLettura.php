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
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>

  </head>
    <header></header>
    <body> 
        <div class="topnav">
            <a href="../home/home.php">Home</a>
            <a href="../map/map.php">MAP</a>
            <a href="../visualizzazione/visualizzazioneBiblioteca.php">Tutte le biblioteche</a>
            <a href="../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <a href="visualizzazionePostiLettura.php" class="active">Tutti i posti lettura</a>
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

                    <h4 class="card-title mt-3 text-center">Tutti i posti lettura</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <a href="visualizzazionePostiLettura.php"><img src="../../images/desk.png" alt="Avatar" class="avatar"></a>
                    </div>
                    
                    <div class="filters">
                        <center>
                        <form method="post">
                            
                                <input type="checkbox" id="ethernet" name="ethernet" value="yes">
                                <label style="margin-right: 10px;"> Ethernet </label>
                            
                                <input type="checkbox" id="power" name="power" value="yes" >
                                <label style="margin-right: 10px;"> Power </label>
                            
                            <select id="filterBiblioteca" name="filterBiblioteca" style="margin-right: 10px;">
                                    <option value="none" selected>Biblioteca</option> 
                                   <?php 
                                        require '../../../connectionDB/connection.php';

                                        try {
                                            $sql = "SELECT Distinct(Nome)
                                                    FROM PostoLettura
                                                    JOIN Biblioteca 
                                                    WHERE PostoLettura.NomeBiblioteca = Biblioteca.Nome";
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
                            
                             <button type="submit" name="filter" style="background-color:#7ABB3B;"> Filtra! </button>
                            
                        </form>
                        </center>
                    </div>
                    
                    <?php

                        try{
                            if(isset($_POST['filter'])){
                                if($_POST['filterBiblioteca'] != 'none'){
                                    $bibliotecaFilter = $_POST['filterBiblioteca'];
                                    
                                    if(isset($_POST['ethernet']) && isset($_POST['power']))
                                        $sql = "SELECT * FROM PostoLettura JOIN Biblioteca WHERE PostoLettura.NomeBiblioteca = Biblioteca.Nome AND Ethernet = 1 AND Corrente = 1 AND Nome = '$bibliotecaFilter'";
                                    else if((!isset($_POST['ethernet'])) && isset($_POST['power']))
                                        $sql = "SELECT * FROM PostoLettura JOIN Biblioteca WHERE PostoLettura.NomeBiblioteca = Biblioteca.Nome AND Corrente = 1 AND Nome = '$bibliotecaFilter'";
                                    else if(isset($_POST['ethernet']) && (!isset($_POST['power'])))
                                        $sql = "SELECT * FROM PostoLettura JOIN Biblioteca WHERE PostoLettura.NomeBiblioteca = Biblioteca.Nome AND Ethernet = 1 AND Nome = '$bibliotecaFilter'";
                                    else 
                                        $sql = "SELECT * FROM PostoLettura JOIN Biblioteca WHERE PostoLettura.NomeBiblioteca = Biblioteca.Nome AND Nome = '$bibliotecaFilter'";
                                }else{
                                    if((isset($_POST['ethernet'])) && isset($_POST['power']))
                                        $sql = "SELECT * FROM PostoLettura JOIN Biblioteca WHERE PostoLettura.NomeBiblioteca = Biblioteca.Nome AND Ethernet = 1 AND Corrente = 1";
                                    else if((!isset($_POST['ethernet'])) && isset($_POST['power']))
                                        $sql = "SELECT * FROM PostoLettura JOIN Biblioteca WHERE PostoLettura.NomeBiblioteca = Biblioteca.Nome AND Corrente = 1";
                                    else if(isset($_POST['ethernet']) && (!isset($_POST['power'])))
                                        $sql = "SELECT * FROM PostoLettura JOIN Biblioteca WHERE PostoLettura.NomeBiblioteca = Biblioteca.Nome AND Ethernet = 1";
                                    else
                                        $sql = "SELECT * FROM PostoLettura JOIN Biblioteca WHERE PostoLettura.NomeBiblioteca = Biblioteca.Nome";
                                }
                                
                                $res = $pdo -> query($sql);
                            }else{
                                $sql = "SELECT * FROM PostoLettura JOIN Biblioteca WHERE PostoLettura.NomeBiblioteca = Biblioteca.Nome";
                                $res = $pdo -> query($sql);
                            }
                        }catch(PDOException $e){echo $e->getMessage();}	

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome Biblioteca</th> 
                                    <th>Ethernet</th> 
                                    <th>Corrente</th>
                                </tr>
                            </thead>
                            <tbody>";
                    

                            while ($row = $res->fetch()) {
                                $nomeBiblioteca = $row['Nome'];
                                $ethernet = $row['Ethernet'];
                                $corrente = $row['Corrente'];
                                $id = $row['Id'];
                                
                                echo "<tr>"; 
                                echo "<td>";
                                if($ethernet && (!$corrente))
                                    echo "<img src=" . "../../images/ethernet.png" . " alt=" . "Ethernet" . " class=" . "avatarTablePL" . ">";
                                else if($corrente && (!$ethernet))
                                    echo "<img src=" . "../../images/power-plug.png" . " alt=" . "Power" . " class=" . "avatarTablePL" . ">";
                                else if($ethernet && $corrente){
                                    echo "<img src=" . "../../images/power-plug.png" . " alt=" . "Power" . " class=" . "avatarTablePL" . ">";
                                    echo "<img src=" . "../../images/ethernet.png" . " alt=" . "Ethernet" . " class=" . "avatarTablePL" . ">";
                                }
                                echo "</td>";
                                echo "<td>" . $nomeBiblioteca . "</td>";
                                if($ethernet)  echo "<td>" . 'Si' . "</td>"; else echo "<td>" . 'No' . "</td>";
                                if($corrente) echo "<td>" . 'Si' . "</td>"; else echo "<td>" . 'No' . "</td>";
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