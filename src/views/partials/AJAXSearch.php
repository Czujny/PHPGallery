<?php


foreach($gallery as $photo){

        echo '<p>Autor:'. $photo['author'].'</p>
        <p>Tytul:'. $photo['title'].'</p>';
        if($photo['access'] == 'private')echo '<p>PRYWATNE</p>';
        echo '<div class="photo"><a href="zdjecie?id='.$photo['_id'].'"><img src="'.$photo['min'].'"></a></div><br><br>';
}