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
                    
                    <!--  <button class="backHomePage"> <a style="color:black;" href="visualizzazionePrenotazioni.php"> Torna alla lista </a></button>-->

                    <h4 class="card-title mt-3 text-center">Ebook più acceduti</h4>


                    
                    <?php
                    
                        require '../../../connectionDB/connection.php';

                        try{
                            
                            $sql = "Select Titolo, NumeroAccessi
                                    From Libro, Ebook
                                    where Libro.CodiceISBN = Ebook.CodiceISBN 
                                    group by Titolo, NumeroAccessi
                                    order by NumeroAccessi DESC";
                            $res = $pdo -> query($sql);
                            
                        }catch(PDOException $e){echo $e->getMessage();}

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Ebook</th> 
                                    <th>Numero Accessi</th> 
                                </tr>
                            </thead>
                            <tbody>";
                    
                        
                            while ($row = $res->fetch()) {
                                $titolo = $row['Titolo'];
                                $accessi = $row['NumeroAccessi'];

                                echo "<tr>"; 
                                
                                 echo "<td><img src=" . "../../images/ebook.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                                                  
                                echo "<td>" . $titolo . "</td>";
                                echo "<td>" . $accessi . "</td>";
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