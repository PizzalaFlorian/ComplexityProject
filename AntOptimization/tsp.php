<?php

    include("./class/TSPsystem2.php");
    session_start();
    //var_dump($_POST);
    $param = $_SERVER['QUERY_STRING'];
    if(!empty($_POST)){
      if(isset($_POST["list"])){
        $_SESSION["list"] = $_POST["list"];
        $_SESSION["tsp"] = new TSPsystem($_POST["list"],700);
      }
      else{
        $_SESSION["te"] = $_POST["te"];
        $_SESSION["tf"] = $_POST["tf"];
        $_SESSION["tsp"]->setParam($_POST["te"],$_POST["tf"]);
      }
    }
   if(!empty($_SESSION["tsp"])){
      if($param == "reset"){
        $_SESSION["tsp"]->reset();
      }
      if($param == "tour"){
        $_SESSION["tsp"]->run();
      }
      if($param == "voyage"){
        $_SESSION["tsp"]->doOneTrip();
      }
      if($param == "10voyages"){
        $_SESSION["tsp"]->doNTrip(10);
      }
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
                <div class="w3-center">
                  <button type="submit" class="w3-btn w3-theme w3-center">Valider</button>
                </div>
                <br/>  
              </form>
            <div class="w3-center">
            <hr>
            <form action="tsp.php" method="post" class="w3-container w3-card-4">
                <div class="w3-group">
                    <input class="w3-input" type="number" name="tf" value="<?php if(isset($_SESSION["tf"])){echo $_SESSION["tf"];}else{echo "0";} ?>" required>
                    <label class="w3-label">Taux apparition fourmis par tour</label>
                </div>
                <div class="w3-group">
                    <input class="w3-input" type="number" name="te" value="<?php if(isset($_SESSION["te"])){echo $_SESSION["te"];}else{echo "0";} ?>" required>
                    <label class="w3-label">Taux évaporation du phéromone par tour</label>
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
                  <!-- <a href="tsp.php?tour" class="w3-btn w3-theme w3-center">Faire un tour</a> -->
                  <a href="tsp.php?voyage" class="w3-btn w3-theme w3-center">Faire un voyage</a>
                  <a href="tsp.php?10voyages" class="w3-btn w3-theme w3-center">Faire 10 voyages</a>
                  <hr>
                  <a href="tsp.php?reset" class="w3-btn w3-theme w3-center">Reset Simulation</a>
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
                        //var_dump($_SESSION["tsp"]->listVille);
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
