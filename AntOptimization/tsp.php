<?php
    include("./class/TSPsystem.php");
    session_start();
    $param = $_SERVER['QUERY_STRING'];
    if(!empty($_POST)){
      $_SESSION["list"] = $_POST["list"];
      $_SESSION["tf"] = $_POST["tf"];
      $_SESSION["te"] = $_POST["te"];
      $_SESSION["cout"] = $_POST["cout"];
      $_SESSION["tsp"] = new TSPsystem($_POST["list"],$_POST["te"],$_POST["tf"],$_POST["cout"],700);
    }
   if(!empty($_SESSION)){

   }

?>

<!DOCTYPE html>
<html>
<title>Complexité - Fourmis</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- www3c import -->
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<!-- import perso -->
<link rel="stylesheet" href="assets/css/main.css">

<body>
    <!-- Side Navigation -->
    <!-- <nav class="w3-sidenav w3-white w3-card-2 w3-animate-left" style="display:none" id="mySidenav">
        <h1 class="w3-xxxlarge w3-text-teal">Side Navigation</h1>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-xxxlarge w3-text-theme">Close <i class="fa fa-remove"></i></a>
        <a href="javascript:void(0)">Fourmis & Nourriture</a>
        <a href="javascript:void(0)">Problème du voyageur</a>
    </nav> -->
    <!-- Header -->
    <header class="w3-container w3-theme w3-padding" id="myHeader">
        <!--<i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-opennav"></i>-->
        <div class="w3-center">
            <h3 class="w3-animate-bottom">Projet Complexité M2 WIC 2016-2017</h3>
            <h4>COLONIE DE FOURMIS</h4>
        </div>
    </header>
    <section class="container w3-center">
        <!-- *************************************************
                      configuration simulation
        ************************************************* -->
        <section class="config w3-container">
            <div class="w3-center">
              <h3> Paramètres simulation </h3>
            </div>  
            <form action="tsp.php" method="post" class="w3-container w3-card-4">
                <div class="w3-group">
                    <input class="w3-input" type="text" name="list" value="<?php if(isset($_SESSION["list"])){echo $_SESSION["list"];}else{echo "0";} ?>" required>
                    <label class="w3-label w3-validate">Liste Ville (séparator ";")</label>
                </div>
                <div class="w3-group">
                    <input class="w3-input" type="text" name="tf" value="<?php if(isset($_SESSION["tf"])){echo $_SESSION["tf"];}else{echo "0";} ?>" required>
                    <label class="w3-label">Taux apparition fourmis par tour</label>
                </div>
                <div class="w3-group">
                    <input class="w3-input" type="text" name="te" value="<?php if(isset($_SESSION["te"])){echo $_SESSION["te"];}else{echo "0";} ?>" required>
                    <label class="w3-label">Taux évaporation du phéromone par tour</label>
                </div>
                <div class="w3-group">
                    <input class="w3-input" type="text" name="cout" value="<?php if(isset($_SESSION["cout"])){echo $_SESSION["cout"];}else{echo "0";} ?>" required>
                    <label class="w3-label">maximun de cout d'un voyage</label>
                </div>
                <div class="w3-center">
                  <button type="submit" class="w3-btn w3-theme w3-center">Valider</button>
                </div>
                <br/>  
              </form>
            <div class="w3-center">
              <h3> Panneau de controle </h3>
            </div>
            <div class="w3-container w3-card-4">
              <br/>
              <div class="w3-center">
                  <a href="index.php?nt" class="w3-btn w3-theme w3-center">Tour suivant</a>
                  <a href="index.php?2nt" class="w3-btn w3-theme w3-center">2 Tours</a>
                  <a href="index.php?10nt" class="w3-btn w3-theme w3-center">10 Tours</a>
              </div> 
              <br/>
            </div>  
        </section>
        <!-- *************************************************
                          écrans de simulation 
        ************************************************* -->
        <section class="simu w3-container w3-card-4">
            <h3> Simulation </h3>
            <div class="w3-card-4 fenSim">
                <?php
                    if(!empty($_SESSION["tsp"])){
                        $_SESSION["tsp"]->draw();
                    }
                    else{
                        echo "<h4> Entrez des Paramètres pour commencer la simulation </h4>";
                    }
                    
                ?>
            </div>
            <br>
        </section>
    </section>
    <!-- Script for Sidenav, Tabs, Accordions, Progress bars and slideshows -->
    <script>
    // Side navigation
    function w3_open() {
        var x = document.getElementById("mySidenav");
        x.style.width = "100%";
        x.style.textAlign = "center";
        x.style.fontSize = "50px";
        x.style.paddingTop = "10%";
        x.style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidenav").style.display = "none";
    }
    </script>

    <!-- <script type="text/javascript" src="./assets/js/canvas.js"></script> -->
</body>

</html>
