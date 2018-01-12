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

    <div class="title">Rejestracja</div>
    <div id="form">

        <form id="formularzUI" method="post">
            <div class="center">
                <label class="textformlabel" for="nick">Login:</label><input type="text" id="nick" name="login">
                <label class="textformlabel" for="pass">Hasło:</label><input type="password" id="pass" name="password">
                <label class="textformlabel" for="repass">Powtórz hasło:</label><input type="password" id="repass" name="repassword">
                <label class="textformlabel" for="email">E-mail:</label><input type="email" id="email" name="email">
            </div><br>
            <div class="center"><input type="submit"><input type="reset"></div>
        </form>
    <div><?php if (isset($_SESSION['logerr'])): ?>
            <div>
                <?php foreach($_SESSION['logerr'] as $error): ?>
                    <p><?php echo $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php unset($_SESSION['logerr']);?>
        <?php endif; ?>
    </div>
    </div>



    <footer>Projekt z WAI Kamil Jędrzejczak 171660</footer>


</div>

<script>
    setInterval(czasNaStronie, 1000);
</script>

</body>



</html>
