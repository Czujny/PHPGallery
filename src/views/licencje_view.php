<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gitara</title>
    <link rel="stylesheet" href="rsrc/CSS/style.css">
    <link rel="stylesheet" href="rsrc/JQueryUI/jquery-ui.css">
    <script src="rsrc/JS/jquery-3.2.1.min.js"></script>
    <script src="rsrc/JQueryUI/jquery-ui.min.js"></script>
    <script src="rsrc/JS/skrypty.js"></script>
    <script src="rsrc/JS/przykladJQuery.js"></script>
</head>
<body>
<div id="container">

    <?php
    require_once 'partials/menu.php';
    ?>

    <div class="desc" id="dance">

        <div class="title">Zdjęcie Cigar Box Guitar</div>
        <p>Jon Callas - <a href="http://www.flickr.com/photos/joncallas/5750003458/in/photostream/">Cigar Box</a>,<a href="https://commons.wikimedia.org/w/index.php?curid=15523846"> CC BY 2.0</a></p>

        <div class="title">Logo strony SVG</div>
        <p>Ikona stworzona przez <a href="http://www.freepik.com">Freepik</a> z <a href="https://www.flaticon.com/">www.flaticon.com</a> jest na licencji <a href="http://creativecommons.org/licenses/by/3.0/">CC 3.0 BY.</a> Zaanimowana przez Kamila Jędrzejczak</p>

        <div class="JSButton"><button onclick="dodajLicencje()">Dodaj licencje</button></div>

    </div>


    <footer>Projekt z WAI Kamil Jędrzejczak 171660</footer>


</div>

<script>
    setInterval(czasNaStronie, 1000);
</script>

</body>



</html>
