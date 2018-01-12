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


    <div class="title">Login</div>
    <div id="form">

        <form id="formularzUI" method="post">
            <div class="center">
                <label class="textformlabel" for="nick">Login:</label><input type="text" id="nick" name="login">
                <label class="textformlabel" for="pass">Hasło:</label><input type="password" id="pass" name="password">
            </div><br>
            <?php if (isset($_SESSION['logowanie'])) :?><?= $_SESSION['logowanie']?>
                <?php unset($_SESSION['logowanie']);?>
            <?php endif ?>
            <div class="center"><input type="submit"><input type="reset"></div>
        </form>
    </div>
    <div class="center" id="dance"><a href="rejestracja">Nie masz konta? Zarejestruj sie!</a></div><br>



    <footer>Projekt z WAI Kamil Jędrzejczak 171660</footer>


</div>

<script>
    setInterval(czasNaStronie, 1000);
    <?php if(isset($_SESSION['reginfo'])):?>alert("<?=$_SESSION['reginfo']?>");
    <?php unset($_SESSION['reginfo'])?>
    <?php endif?>
</script>

</body>



</html>
