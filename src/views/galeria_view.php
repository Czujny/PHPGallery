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
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true):?>
             <form method="post">
        <?php endif?>
            <?php foreach($gallery as $photo):?>
                <div class="photo"><a href="zdjecie?id=<?=$photo['_id']?>"><img src="<?=$photo['min']?>"></a></div>
                <p>Autor: <?=$photo['author']?></p>
                <p>Tytul: <?=$photo['title']?></p>
                <?php if($photo['access'] == 'private'):?><p>PRYWATNE</p><?php endif ?>
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true):?>
            <label><input type="checkbox" name="save[]" value="<?=$photo['_id']?>"
                <?php if(!empty($user['favourites'][$photo['_id'].''])):?>checked="checked"<?php endif?>
                >Dodaj do ulubionych</label><br><br>
            <?php endif?>
            <?php endforeach?>
            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true):?>
                 <div class="center"><input type="submit" value="Zapisz ulubione"><input type="reset"></div>
            <?php endif?>
        </form>
</div>

    <footer>Projekt z WAI Kamil Jędrzejczak 171660</footer>


</div>

<div>

</div>

<script>
    setInterval(czasNaStronie, 1000);
    <?php if(isset($_SESSION['loginfo'])):?>alert("<?=$_SESSION['loginfo']?>");
        <?php unset($_SESSION['loginfo'])?>
    <?php endif?>
</script>

</body>



</html>