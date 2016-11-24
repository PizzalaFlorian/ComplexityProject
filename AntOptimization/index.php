<!DOCTYPE html>
<html>
<title>Complexité - Fourmis</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- www3c import -->
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<!-- import perso -->
<link rel="stylesheet" href="assets/main.css">

<body>
    <!-- Side Navigation -->
    <nav class="w3-sidenav w3-white w3-card-2 w3-animate-left" style="display:none" id="mySidenav">
        <h1 class="w3-xxxlarge w3-text-teal">Side Navigation</h1>
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-xxxlarge w3-text-theme">Close <i class="fa fa-remove"></i></a>
        <a href="javascript:void(0)">Link 1</a>
        <a href="javascript:void(0)">Link 2</a>
        <a href="javascript:void(0)">Link 3</a>
        <a href="javascript:void(0)">Link 4</a>
        <a href="javascript:void(0)">Link 5</a>
    </nav>
    <!-- Header -->
    <header class="w3-container w3-theme w3-padding" id="myHeader">
        <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-opennav"></i>
        <div class="w3-center">
            <h1 class="w3-xxxlarge w3-animate-bottom">Projet Complexité M2 WIC 2016-2017</h1>
            <h4>COLONIE DE FOURMIS</h4>
        </div>
    </header>
    <section class="container w3-center">
        <!-- *************************************************
                      configuration simulation
        ************************************************* -->
        <section class="config w3-third w3-container">
            <div class="w3-center">
              <h3> Paramètres simulation </h3>
            </div>  
            <form class="w3-container w3-card-4">
                <div class="w3-group">
                    <input class="w3-input" type="text" required>
                    <label class="w3-label w3-validate">Longueur chemin n°1</label>
                </div>
                <div class="w3-group">
                    <input class="w3-input" type="text" required>
                    <label class="w3-label w3-validate">Longueur chemin n°2</label>
                </div>
                <div class="w3-group">
                    <input class="w3-input" type="text" required>
                    <label class="w3-label">Taux apparition fourmis par tour</label>
                </div>
                <div class="w3-group">
                    <input class="w3-input" type="text" required>
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
                  <button class="w3-btn w3-theme w3-center">Tour suivant</button>
                  <button class="w3-btn w3-theme w3-center">2 Tours</button>
                  <button class="w3-btn w3-theme w3-center">10 Tours</button>
              </div> 
              <br/> 
              <hr>
              <br/>
              <div class="w3-center">
                  <button class="w3-btn w3-theme w3-center">Stop</button>
                  <button class="w3-btn w3-theme w3-center">Extraire le résultat</button>
              </div> 
              <br/>
            </div>  
        </section>
        <!-- *************************************************
                          écrans de simulation 
        ************************************************* -->
        <section class="simu w3-container w3-card-4">
            tata
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

    // Tabs
    function openCity(evt, cityName) {
        var i;
        var x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        var activebtn = document.getElementsByClassName("testbtn");
        for (i = 0; i < x.length; i++) {
            activebtn[i].className = activebtn[i].className.replace(" w3-dark-grey", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " w3-dark-grey";
    }

    var mybtn = document.getElementsByClassName("testbtn")[0];
    mybtn.click();

    // Accordions
    function myAccFunc(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-dark-grey";
        } else {
            x.className = x.className.replace(" w3-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace(" w3-dark-grey", "");
        }
    }

    // Slideshows
    var slideIndex = 1;

    function plusDivs(n) {
        slideIndex = slideIndex + n;
        showDivs(slideIndex);
    }

    function showDivs(n) {
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        };
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndex - 1].style.display = "block";
    }

    showDivs(1);

    // Progress Bars
    function move() {
        var elem = document.getElementById("myBar");
        var width = 1;
        var id = setInterval(frame, 10);

        function frame() {
            if (width == 100) {
                clearInterval(id);
            } else {
                width++;
                elem.style.width = width + '%';
                document.getElementById("demoprgr").innerHTML = width * 1 + '%';
            }
        }
    }
    </script>
</body>

</html>
