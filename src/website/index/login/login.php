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

        <script src="../../js/script.js"></script>
        
      
    </head>
    <header></header>
    <body>
        <?php
    
            require '../../../connectionDB/connection.php';

            if(isset($_POST['submit'])){
                $emailUtente = $_POST['email'];
                $passwordUtente = $_POST['password'];
                $passwordUtente = md5($passwordUtente);

                try{
                    $sql = "SELECT * FROM utente WHERE Email='$emailUtente'";
                    $res = $pdo->query($sql);
                }catch(PDOException $e){echo $e->getMessage();}	
                
                if($res->rowCount() > 0){
                    $_SESSION['EmailUtente'] = $emailUtente;
                    try{
                        $sql = "SELECT TipoUtente FROM utente WHERE Email='$emailUtente'";
                        $res= $pdo->query($sql);
                        $row = $res->fetch();
                        $tipoUtente= $row['TipoUtente'];
                        $_SESSION['TipoUtente']=$tipoUtente;
                    }catch(PDOException $e){echo $e->getMessage();}	
                    if($tipoUtente=="Amministratore"){
                         header('Location: ../home/adminHome.php');
                    }else if($tipoUtente == "Utilizzatore"){
                        $sql = "SELECT StatoAccount FROM utilizzatore WHERE EmailUtente='$emailUtente'";
                        $res = $pdo->query($sql);                        
                        $row = $res->fetch();
                        $statoUtente = $row['StatoAccount'];
                        if ($statoUtente=="Sospeso"){
                            echo "<script> alert('SEI STATO SOSPESO DALLA PIATTAFORMA'); window.location.href='logout.php'; </script>";
                        } else                            
                            header('Location: ../home/myHome.php');
                    }else if($tipoUtente == "Volontario"){
                        header('Location: ../home/volHome.php');
                    }else if($tipoUtente == "SuperUser"){
                        header('Location: ../home/superUserHome.php');
                    }
                    
                }else
                    echo "<script> alert('I dati non risultano corretti, sicuro di esserti registrato?'); window.location.href='login.php'; </script>";
            }
        ?>
        <div class="topnav">
            <a href="../home/home.php">Home</a>
            
            <div class="login-container">
                <button onClick="location='../registrazione/registrazione.php'">Registrati</button>
            </div>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Accedi con il tuo account</h4>
                    <div class="imgcontainer">
                        <img src="../../images/library.png" alt="Avatar" class="avatar">
                    </div>
                <form method="post">
                    <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci la tua email" class="form-control" name="email" id="email" required>
                    </div>
                  
                    <div class="form-group input-group">
                        <input type="password" placeholder="Inserisci la tua password" class="form-control" name="password" id="password" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" name='submit' id='submit' class="btn btn-primary btn-block"> Login  </button>
                    </div>    
                <p class="text-center">Non hai un'account? <a href="../registrazione/registrazione.php">Registrati!</a> </p>      

                </form>
                </article>
            </div>

        </div>
    </body>
    <footer class="text-center text-white fixed-bottom" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer>
</html>