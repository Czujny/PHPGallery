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


    <div class="title">Wyslij plik</div>
    <div id="form">

        <form id="formularzUI" method="post" enctype="multipart/form-data">
            <div class="center">
                <label class="textformlabel" for="author">Autor:</label><input type="text" id="author" name="author"
                    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']):?>
                             value="<?=$user?>" readonly="readonly"><br>
                            <label for="private">Prywatne</label><input type="radio" id="private" value="private" name="access" checked="checked">
                            <label for="public">Publiczne</label><input type="radio" id="public" value="public" name="access">
                         <?php else: ?>><br>
                    <?php endif?>

                <label class="textformlabel" for="title">Tytul:</label><input type="text" id="title" name="title">
                <label class="textformlabel" for="photo">Zdjecie:</label><input type="file" id="photo" name="photo">
                <label class="textformlabel" for="watermark">Znak wodny:</label><input type="text" id="water" name="water">
            </div><br>
            <?php if (isset($_SESSION['error'])): ?>
                <div>
                    <?php foreach($_SESSION['error'] as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                </div>
                <?php unset($_SESSION['error']);?>
            <?php endif; ?>
            <div class="center"><input type="submit"><input type="reset"></div>
        </form>

    </div>



    <footer>Projekt z WAI Kamil Jędrzejczak 171660</footer>


</div>

<script>
    setInterval(czasNaStronie, 1000);
</script>

</body>



</html>