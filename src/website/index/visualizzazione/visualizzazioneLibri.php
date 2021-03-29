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
        <?php
            require '../../../connectionDB/connection.php';
            if($_SESSION['TipoUtente'] == 'Amministratore'){
                echo "<div class='topnav'>
                        <a href='../home/adminHome.php'>Home</a>
                        <a href='visualizzazioneLibri.php' class='active'>Visualizza Libri</a> 
                        <div class='top-dropdown'>
                            <button class='top-dropbtn'>Inserimenti
                              <i class='fa fa-caret-down'></i>
                            </button>
                            <div class='top-dropdown-content'>
                                <a href='../inserimenti/inserimentoAmministratore/inserimentoAmministratore.html'>Inserisci utente</a>
                                <a href='../inserimenti/inserimentoAutore/inserimentoAutore.php'>Inserisci autore</a>
                                <a href='../inserimenti/inserimentoBiblioteca/inserimentoBiblioteca.php'>Inserisci biblioteca</a>
                                <a href='../inserimenti/inserimentoPostoLettura/inserimentoPostoLettura.php'>Posto lettura</a>
                                <a href='../inserimenti/inserimentoLibro/inserimentoISBN.php'>Inserisci libro</a>      
                            </div>
                        </div>
                        <a href='../inserimenti/inserimentoSegnalazione/inserimentoSegnalazione.php'>Nuova segnalazione</a> 
                        <a href='../cancellazioni/cancellazioneSegnalazioni.php'>Cancella segnalazione</a> 
                        <a href='../inserimenti/inserimentoMessaggio/inserimentoMessaggio.php'>Messaggi</a>
                        <button class='logout' style='float:right' onClick=" . "location='../login/logout.php'" . ">Logout</button>
                        <button class='logout' style='float:right' onClick=" . "location='../profilo/profilo.php'" . ">Account</button>
                    </div>";
            }else if($_SESSION['TipoUtente'] == 'Utilizzatore'){
                echo "<div class='topnav'>
                        <a href='../home/myHome.php'>Home</a>
                        <a href='../prenotazioni/prenotazionePostoLettura/controllaDisponibilitaPostoLettura.php'>Prenota posto lettura</a>
                        <a href='../prenotazioni/prenotazioneLibroCartaceo/controllaDisponibilitaCartaceo.php'>Prenota Libro</a>
                        <a href='visualizzazioneLibri.php' class='active'>Visualizza Ebook</a> 
                        <a href='../profilo/conversazioni.php'>Conversazioni</a>
                         <a href='../profilo/prenotazioniEffettuate.php'>Prenotazioni</a>
                        <a href='../profilo/visualizzazioneSegnalazioni.php' >Segnalazioni</a>
                        <button class='logout' style='float:right' onClick=" . "location='../login/logout.php'" . ">Logout</button>
                        <button class='logout' style='float:right' onClick=" . "location='../profilo/profilo.php'" . ">Account</button>
                    </div>";
            }else if($_SESSION['TipoUtente'] == 'Volontario'){
                echo "<div class='topnav'>
                        <a href='../home/volHome.php' class='active'>Home</a>
                        <a href='visualizzazioneLibri.php' class='active'>Visualizza Libri</a> 
                        <a href='../inserimenti/inserimentoConsegna/consegna.php'>Consegne</a>
                        <button class='logout' style='float:right' onClick=" . "location='../login/logout.php'" . ">Logout</button>
                        <button class='logout' style='float:right' onClick=" . "location='../profilo/profilo.php'" . ">Account</button>
                    </div>";
            }else{
                echo "<div class='topnav'>
                        <a href='../home/home.php' >Home</a>
                        <a href='../map/map.php'>MAP</a>
                        <a href='../visualizzazione/visualizzazioneBiblioteca.php' >Tutte le biblioteche</a>
                        <a href='visualizzazioneLibri.php' class='active'>Tutti i libri</a>
                        <a href='../visualizzazione/visualizzazionePostiLettura.php'>Tutti i posti lettura</a>
                        <div class='top-dropdown'>
                            <button class='top-dropbtn'>Statistiche
                              <i class='fa fa-caret-down'></i>
                            </button>
                            <div class='top-dropdown-content'>
                                <a href='../statistiche/ebookPiuAcceduti.php'>EBook più acceduti</a>
                                <a href='../statistiche/numCartaceiPrenotati.php'>Numero Cartacei Prenotati</a>
                                <a href='../statistiche/numConsegneVolontario.php'>Consegne Volontario</a>
                                <a href='../statistiche/postoLetturaMenoUtilizzati.php'>Posti lettura meno utilizzati</a>
                            </div>
                        </div>
                        <div class='login-container'>
                            <button onClick=" . "location='../login/login.php'" . ">Accedi</button>
                            <button onClick=" . "location='../registrazione/registrazione.php'" . ">Registrati</button>
                        </div>
                    </div>";
            }
        
        ?>
         
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">

                    <?php 
                        
                        $emailUtente = $_SESSION['EmailUtente'];
                    
                        if($_SESSION['TipoUtente'] == 'Amministratore'){
                            $sql = "SELECT NomeBibliotecaAmministrata FROM Amministratore WHERE EmailUtente = '$emailUtente' ";
                            $res = $pdo -> query($sql);

                            while ($row = $res->fetch()) {
                                $nomeBiblioteca = $row['NomeBibliotecaAmministrata'];
                            }  

                            echo "<h3 class='card-title mt-3 text-center'>Tutti i libri della biblioteca '$nomeBiblioteca'</h3>";
                        }else
                            echo '<h3 class="card-title mt-3 text-center">Tutti i libri</h3>';
                    
                    ?>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <a href="visualizzazioneLibri.php"><img src="../../images/book.png" alt="Avatar" class="avatar"></a>
                        <a href="visualizzazioneLibri.php"><img src="../../images/ebook.png" alt="Avatar" class="avatar"></a>
                    </div>
                    
                    <div class="filters">
                        <center>
                        <form method="post">
                            
                                <select id="filterTipoLibro" name="filterTipoLibro" style="margin-right: 10px;">
                                  <option value="none" selected>Tipo Libro</option>  
                                  <option value="Cartaceo">Cartaceo</option>
                                  <option value="Ebook">Ebook</option>
                                  <option value="Entrambi">Entrambi</option>
                                </select>
                            
                            
                                <select id="filterGenere" name="filterGenere" style="margin-right: 10px;">
                                    <option value="none" selected>Genere</option> 
                                   <?php 

                                        try {
                                            $sql = "SELECT Distinct(Genere) FROM Libro";
                                            $res=$pdo->query($sql);
                                        }catch(PDOException $e) {
                                            echo("Query SQL Failed: ".$e->getMessage());
                                            exit();
                                        }

                                        while($row=$res->fetch()) {
                                            echo "<option value='" . $row['Genere'] . "'>" . $row['Genere'] . "</option>";
                                        }

                                    ?>
                                </select>
                            
                             <button type="submit" name="filter" class="btn cerca"> Filtra! </button>
                            
                        </form>
                        </center>
                    </div>
                    
                    <?php

                        try{
                            if($_SESSION['TipoUtente'] != 'Amministratore'){
                                if(isset($_POST['filter'])){
                                    if(($_POST['filterTipoLibro'] != 'none') && ($_POST['filterGenere'] != 'none')){
                                        $genereFilter = $_POST['filterGenere'];
                                        $tipoLibroFilter = $_POST['filterTipoLibro'];

                                        $sql = "SELECT * FROM Libro WHERE Genere = '$genereFilter' AND TipoLibro = '$tipoLibroFilter'";
                                    }else if(($_POST['filterTipoLibro'] != 'none') && ($_POST['filterGenere'] == 'none')){
                                        $tipoLibroFilter = $_POST['filterTipoLibro'];

                                        $sql = "SELECT * FROM Libro WHERE TipoLibro = '$tipoLibroFilter'";
                                    }else if(($_POST['filterTipoLibro'] == 'none') && ($_POST['filterGenere'] != 'none')){
                                        $genereFilter = $_POST['filterGenere'];

                                        $sql = "SELECT * FROM Libro WHERE Genere = '$genereFilter'";
                                    }else
                                        $sql = "SELECT * FROM Libro";

                                    $res = $pdo -> query($sql);
                                }else{
                                    $sql = "SELECT * FROM Libro";
                                    $res = $pdo -> query($sql);
                                }
                            }else{
                                if(isset($_POST['filter'])){
                                    if(($_POST['filterTipoLibro'] != 'none') && ($_POST['filterGenere'] != 'none')){
                                        $genereFilter = $_POST['filterGenere'];
                                        $tipoLibroFilter = $_POST['filterTipoLibro'];

                                        $sql = "SELECT * FROM Libro 
                                                join libridisponibili on(Libro.CodiceISBN = libridisponibili.CodiceISBN)
                                                WHERE Genere = '$genereFilter' AND TipoLibro = '$tipoLibroFilter'
                                                AND NomeBiblioteca=$nomeBiblioteca";
                                    }else if(($_POST['filterTipoLibro'] != 'none') && ($_POST['filterGenere'] == 'none')){
                                        $tipoLibroFilter = $_POST['filterTipoLibro'];

                                        $sql = "SELECT * FROM Libro 
                                                join libridisponibili on(Libro.CodiceISBN = libridisponibili.CodiceISBN)
                                                WHERE TipoLibro = '$tipoLibroFilter' AND NomeBiblioteca=$nomeBiblioteca";
                                    }else if(($_POST['filterTipoLibro'] == 'none') && ($_POST['filterGenere'] != 'none')){
                                        $genereFilter = $_POST['filterGenere'];

                                        $sql = "SELECT * FROM Libro
                                                join libridisponibili on(Libro.CodiceISBN = libridisponibili.CodiceISBN)
                                                WHERE Genere = '$genereFilter' AND NomeBiblioteca='$nomeBiblioteca'";
                                    }else
                                        $sql = "SELECT * FROM Libro 
                                                join libridisponibili on(Libro.CodiceISBN = libridisponibili.CodiceISBN)
                                                where NomeBiblioteca='$nomeBiblioteca'";

                                    $res = $pdo -> query($sql);
                                }else{
                                    $sql = "SELECT * FROM Libro
                                            join libridisponibili on(Libro.CodiceISBN = libridisponibili.CodiceISBN)
                                            where NomeBiblioteca='$nomeBiblioteca'";
                                    $res = $pdo -> query($sql);
                                }
                            }
                        }catch(PDOException $e){echo $e->getMessage();}

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Codice ISBN</th> 
                                    <th>Titolo</th> 
                                    <th>Anno</th> 
                                    <th>Genere</th> 
                                    <th>Nome Edizione</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                    
                    try{
                            while ($row = $res->fetch()) {
                                $isbn = $row['CodiceISBN'];
                                $tipoLibro = $row['TipoLibro'];
                                $titolo = $row['Titolo'];
                                $anno = $row['Anno'];
                                $genere = $row['Genere'];
                                $nomeEdizione = $row['NomeEdizione'];
                                
                                echo "<tr>"; 
                                echo "<td>";
                                if($tipoLibro == 'Cartaceo')
                                    echo "<img src=" . "../../images/book.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                                else if($tipoLibro == 'Ebook')
                                    echo "<img src=" . "../../images/ebook.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                                else if($tipoLibro == 'Entrambi'){
                                    echo "<img src=" . "../../images/ebook.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                                    echo "<img src=" . "../../images/book.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                                }
                                echo "</td>";
                                echo "<td>" . $isbn . "</td>";
                                echo "<td>" . $titolo . "</td>";
                                echo "<td>" . $anno . "</td>";
                                echo "<td>" . $genere . "</td>";
                                echo "<td>" . $nomeEdizione . "</td>";
                                echo "<td>" . "<button class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='dettagliLibro.php?Isbn=" .
                                    "$isbn" . "&Tipo=" . urlencode($tipoLibro) . "&Titolo=" . urlencode($titolo) . "&Anno=" . "$anno" . "&Genere=" . urlencode($genere) . "&NomeEdizione=" . urlencode($nomeEdizione) . "'" . "> Dettagli </button></td>";
                                
                                if($_SESSION['TipoUtente']=="Amministratore" | $_SESSION['TipoUtente']=="SuperUser"){
                                    echo "<td>" . "<button style='background-color:#bb2e29;' class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='../cancellazioni/cancellazioneLibro.php?Isbn=" . "$isbn" . "&Tipo=" . urlencode($tipoLibro) . "'" . "><i class='fa fa-trash'></i></button></td>";
                                }else if($_SESSION['TipoUtente']=="Utilizzatore"){
                                    if($tipoLibro == 'Ebook' | $tipoLibro == 'Entrambi'){
                                    echo "<td>" . "<button style='background-color:#bb2e29;color:#fff' class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='visualizzazioneEBook.php?Isbn=" . "$isbn" . "'" . ">Visualizza E-book</button></td>";
                                    }
                                }else{
                                    echo "<td><td>";
                                }
                                echo "</tr>"; 
                            }
                    }catch(PDOException $e){echo $e->getMessage();}
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