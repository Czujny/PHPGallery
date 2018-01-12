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

    <div class="title">Strona główna</div>
    <div class="image"><img src="rsrc/img/glowna.jpeg" alt="Gitara"/></div>
    <div id="contact">
        <div id="dance">
            <b>Autor:</b><br/><br/>
            Jędrzejczak Kamil<br/><br/>
            Politechniczna 12 D/1<br/><br/>
            <a href="mailto:s171660@pg.gda.pl">s171660@pg.gda.pl</a><br/><br/>
            123456789
        </div>
    </div>
    <div style="clear: both"></div>

    <div class="center">
        <div class="search-box">
            <form>
                <label>Szukaj <input type="text"/></label>
            </form>
            <div class="result"></div>
        </div>


    </div>

    <footer>Projekt z WAI Kamil Jędrzejczak 171660</footer>


</div>

<div>

</div>

<script>
    setInterval(czasNaStronie, 1000);
</script>

</body>



</html>