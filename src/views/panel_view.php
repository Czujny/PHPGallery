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

    <div id="top_bar">
        <ol id="sortable">
            <li class="ui-state-disabled"><svg version="1.1" id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 459.502 459.502" style="enable-background:new 0 0 459.502 459.502;" xml:space="preserve">
						<g id="HygogJatCZ">
                            <path id="rk-jgJpKAW" d="M287.317,223.768c6.621-5.939,52.076-46.713,58.116-52.13c3.554,3.635,9.403,3.384,12.648-0.422&#10;&#9;&#9;c19.853-23.285,21.46-23.9,21.922-30.027c0.701-9.337-7.387-16.747-16.474-15.531c-0.052,0.007-0.105,0.01-0.157,0.017&#10;&#9;&#9;c-4.72,0.688-6.312,2.525-29.638,18.402c-4.773,3.249-4.545,9.771-1.788,12.529l-58.115,52.129c-6.087,0,2.777-2.37-118.521,39.686&#10;&#9;&#9;c-9.029,3.131-8.538,16.354,1.016,18.535c26.611,6.07,17.273,3.94,31.801,7.254c11.844,2.702,21.55,11.961,24.324,24.714&#10;&#9;&#9;c0.447,2.055,0.169,0.15,4.257,35.345c1.117,9.61,14.18,11.753,18.316,3.018l28.518-60.212&#10;&#9;&#9;C286.358,228.906,287.242,228.377,287.317,223.768z M185.231,261.669c-3.116,2.795-7.903,2.535-10.698-0.581&#10;&#9;&#9;c-2.787-3.115-2.527-7.902,0.588-10.697c3.108-2.788,7.896-2.528,10.691,0.58C188.606,254.087,188.346,258.874,185.231,261.669z&#10;&#9;&#9; M201.207,258.974c-3.957-4.403-3.589-11.187,0.829-15.136c4.404-3.957,11.187-3.589,15.129,0.822&#10;&#9;&#9;c3.964,4.404,3.596,11.187-0.814,15.137C211.947,263.753,205.163,263.385,201.207,258.974z"/>
                            <path id="HJzsg1pF0b" d="M193.332,304.163c-0.607-5.229-4.464-9.529-9.596-10.7c-3.9-0.889-0.991-0.226-14.196-3.238v0.18&#10;&#9;&#9;l-38.462,142.512c-3.034,11.243,3.62,22.817,14.863,25.852c11.245,3.034,22.818-3.623,25.852-14.864l27.057-100.253&#10;&#9;&#9;c-0.868-2.253-1.469-4.633-1.756-7.103L193.332,304.163z"/>
                            <path id="rJQix1pYAb" d="M273.647,301.876c-22.687,47.902-21.062,44.673-22.447,46.877l54.499,99.767&#10;&#9;&#9;c5.585,10.225,18.398,13.977,28.614,8.396c10.22-5.583,13.979-18.393,8.396-28.614L273.647,301.876z"/>
                            <path id="SkEoxyaKCW" d="M169.54,222.588c99.018-34.332,91.437-31.73,93.074-32.217v-30.837l13.034,21.045l26.827-24.064&#10;&#9;&#9;c-5.907-10.96-14.881-32.124-38.946-32.124c-7.843,0-65.987,0-73.739,0L99.321,6.854C93.402-0.836,82.369-2.27,74.679,3.647&#10;&#9;&#9;c-7.69,5.919-9.126,16.953-3.206,24.643l98.068,127.339V222.588z"/>
                            <circle id="ryBse1ptCW" cx="216.268" cy="76.365" r="36.418"/>
                            <path id="B1Iolk6tAb" d="M390.833,170.191c-0.517-1.611-1.256-3.087-2.155-4.425l-15.57,18.262&#10;&#9;&#9;c-5.789,6.79-14.345,10.353-22.963,9.911l-13.491,12.102l42.82-13.746C388.713,189.327,393.798,179.432,390.833,170.191z"/>
                        </g>
					</svg>
            </li>
            <li><a href="/">Główna</a></li>
            <li><a  href="plik">Wyslij plik</a></li>
            <li><a href="szukaj">Wyszukaj</a></li>
            <li><a href="licencje">Licencje</a></li>
            <li id="login"><a href="logout">Wyloguj</a></li>
        </ol>
    </div>
    <div class="title">Moje konto</div>
    <div class="center">
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $gallery != null):?>
        <form method="post">
            <?php foreach($gallery as $photo):?>
                <div class="photo"><a href="zdjecie?id=<?=$photo['_id']?>"><img src="<?=$photo['min']?>"></a></div>
                <p>Autor: <?=$photo['author']?></p>
                <p>Tytul: <?=$photo['title']?></p>
                <?php if($photo['access'] == 'private'):?><p>PRYWATNE</p><?php endif ?>
                    <label><input type="checkbox" name="delete[]" value="<?=$photo['_id']?>"
                                  <?php if(!empty($user['favourites'][$photo['_id'].''])):?>checked="checked"<?php endif?>
                        >Usun z ulubionych</label><br><br>
            <?php endforeach?>
                <div class="center"><input type="submit" value="Usun ulubione"><input type="reset"></div>
        </form>
        <?php else:?><p>Nie masz ulubionych</p>
        <?php endif?>
    </div>

    <footer>Projekt z WAI Kamil Jędrzejczak 171660</footer>


</div>

<script>
    setInterval(czasNaStronie, 1000);
</script>

</body>



</html>
