<?php

function get_db(){

    require '../../vendor/autoload.php';

    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;
    return $db;
}

function minPhoto($target, $upload_dir){

    list($width, $height) = getimagesize($target);
    $destination = imagecreatetruecolor(200, 125);
    $path_parts = pathinfo($target);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $target);

    if($mime_type === 'image/jpeg'){

        $source = imagecreatefromjpeg($target);
        imagecopyresampled($destination, $source, 0, 0, 0, 0, 200, 125, $width, $height);
        $filename = $path_parts['filename'].'min.jpg';
        imagejpeg($destination, $upload_dir.$filename, 100);
        return 'images/'.$filename;
    }
    else if($mime_type === 'image/png'){

        $source = imagecreatefrompng($target);
        imagecopyresampled($destination, $source, 0, 0, 0, 0, 200, 125, $width, $height);
        $filename = $path_parts['filename'].'min.png';
        imagepng($destination, $upload_dir.$filename, 9);
        return 'images/'.$filename;
    }
}

function watermark($target, $upload_dir, $watermark){

    $path_parts = pathinfo($target);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $target);

    if($mime_type === 'image/jpeg'){

        $source = imagecreatefromjpeg($target);

        $mark = imagecreatetruecolor(100, 70);
        imagestring($mark, 1, 20, 20, $watermark, 0xFFFFFF);

        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($mark);
        $sy = imagesy($mark);

        imagecopymerge($source, $mark, imagesx($source) - $sx - $marge_right, imagesy($source) - $sy - $marge_bottom, 0, 0, $sx, $sy, 70);
        $filename = $path_parts['filename'].'water.jpg';
        imagejpeg($source, $upload_dir.$filename, 100);
        imagedestroy($source);
        return 'images/'.$filename;
    }
    else if($mime_type === 'image/png'){

        $source = imagecreatefrompng($target);

        $mark = imagecreatetruecolor(100, 70);
        imagestring($mark, 1, 20, 20, $watermark, 0xFFFFFF);

        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($mark);
        $sy = imagesy($mark);

        imagecopymerge($source, $mark, imagesx($source) - $sx - $marge_right, imagesy($source) - $sy - $marge_bottom, 0, 0, $sx, $sy, 70);
        $filename = $path_parts['filename'].'water.png';
        imagepng($source, $upload_dir.$filename, 9);
        imagedestroy($source);
        return 'images/'.$filename;
    }
}

function get_gallery(){

    $db = get_db();

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

        $user = $db->users->findOne(['_id' => $_SESSION['user_id']]);
        $model['user'] = $user['login'];

        $gallery = $db->photos->find(['$or' => [
            ['author' => $user['login']],
            ['access' => 'public'],
        ]
        ]);
    }
    else $gallery = $db->photos->find(['access' => 'public']);

    return $gallery;
}

function get_photo_by_id($id){

    $db = get_db();

    $photo_id = new \MongoDB\BSON\ObjectId($id);

    $photo = $db->photos->findOne(['_id' => $photo_id]);

    return $photo;
}

function login_user(){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $db = get_db();

        $login = $_POST['login'];
        $password = $_POST['password'];

        $user = $db->users->findOne(['login' => (string)$login]);

        if($user !== null && password_verify((string)$password, $user['password'])){

            session_regenerate_id();
            $_SESSION['user_id'] = $user['_id'];
            $_SESSION['loggedin'] = true;
            $_SESSION['loginfo'] = 'Poprawnie zalogowano';
            header('Location: /');
        }
        else if($user === null || password_verify((string)$password, $user['password']) == false) $_SESSION['logowanie'] = 'Nieprawidłowy login lub hasło';

    }
}

function file_upload(&$model){

    $db = get_db();

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

        $user = $db->users->findOne(['_id' => $_SESSION['user_id']]);
        $model['user'] = $user['login'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(!empty($_POST['author']))$author = $_POST['author'];
        else $_SESSION['error'][] = 'Podaj autora';
        if(!empty($_POST['access']) && ($_POST['access'] == 'private' || $_POST['access'] == 'public'))$access = $_POST['access'];
        else $access = 'public';
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

            $user = get_active_user();
            $author = $user['login'];
        }
        else{
            $user = $db->users->findOne(['login' => $author]);
            if($user != null)$_SESSION['error'][] = 'Uzytkownik istnieje, zaloguj sie';
        }
        if(!empty($_POST['water']))$water = $_POST['water'];
        else $_SESSION['error'][] = 'Podaj znak wodny';
        if(!empty($_POST['title']))$title = $_POST['title'];
        else $_SESSION['error'][] = 'Podaj tytul';
        if($_FILES['photo']['error'] == null)$photo = $_FILES['photo'];
        else $_SESSION['error'][] = 'Podaj plik';

        if(isset($_SESSION['error']))return 'plik_view';

        $upload_dir = '/var/www/prod/src/web/images/';
        $photo_name = basename($photo['name']);
        $target = $upload_dir.$photo_name;
        $tmp_path = $photo['tmp_name'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $tmp_path);

        if(($mime_type === 'image/png' || $mime_type === 'image/jpeg') && $photo['size'] < 1048576){

            $path_parts = pathinfo($target);
            $file_name = $path_parts['filename'].'.'.$path_parts['extension'];
            $target = $upload_dir.$file_name;

            while(file_exists($target) == true){

                $path_parts = pathinfo($target);
                $file_name = $path_parts['filename'].'1.'.$path_parts['extension'];
                $target = $upload_dir.$file_name;
            }
                if(move_uploaded_file($tmp_path, $target)){

                $min_path = minPhoto($target, $upload_dir);
                $water_path = watermark($target, $upload_dir, $water);

                $db->photos->insertOne([

                    'author' => $author,
                    'title' => $title,
                    'name' => $file_name,
                    'path' => 'images/'.$file_name,
                    'min' => $min_path,
                    'water' => $water_path,
                    'access' => $access
                ]);


            }
            else $_SESSION['error'][] = 'Nie udalo sie zapisac pliku';
        }
        else{
            if($mime_type !== 'image/png' && $mime_type !== 'image/jpeg')$_SESSION['error'][] = 'Niepoprawny format';
            if($photo['size'] > 1048576)$_SESSION['error'][] = 'Plik zbyt duzy';
        }

        if(isset($_SESSION['error']))return 'plik_view';
        else header('Location: /');
    }
}

function register_user(){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $db = get_db();
        $login = $_POST['login'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $email = $_POST['email'];
        $user = $db->users->findOne(['login' => (string)$login]);
        $mail_check = $db->users->findOne(['email' => (string)$email]);

        if(strlen($login) > 0 && strlen($password) > 0 && strlen($email) > 0 && $password  == $repassword && $user == null && $mail_check == null &&
        preg_match("/^[a-zA-Z1-9 ]*$/",$login) == true && filter_var($email, FILTER_VALIDATE_EMAIL) == false){

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $db->users->insertOne([

                'login' => $login,
                'password' => $hash,
                'email' => $email
            ]);

            $_SESSION['reginfo'] = 'Poprawnie zarejestrowano';

            header('Location: login');
            exit;
        }
        if(strlen($login) == 0)$_SESSION['logerr'][] = 'Podaj login';
        if(strlen($password) == 0)$_SESSION['logerr'][] = 'Podaj haslo';
        if($password  != $repassword)$_SESSION['logerr'][] = 'Hasla roznia sie';
        if($user != null)$_SESSION['logerr'][] = 'Login zajety';
        if(strlen($email) == 0)$_SESSION['logerr'][] = 'Podaj adres email';
        if($mail_check != null)$_SESSION['logerr'][] = 'Email zajety';
        if(preg_match("/^[a-zA-Z1-9 ]*$/",$login) == false)$_SESSION['logerr'][] = 'Login zawiera nieprawidlowe znaki';
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == true)$_SESSION['logerr'][] = 'Nieprawidlowy email';
    }
}

function save_favourites(){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(!empty($_POST['save']) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            $db = get_db();

            $id = new \MongoDB\BSON\ObjectId($_SESSION['user_id']);
            $query = ['_id' => $id];
            $user = $db->users->findOne($query);

            foreach ($_POST['save'] as $favourite){

                $user['favourites'][$favourite] = $favourite;
            }
            $db->users->replaceOne($query, $user);
        }
    }
}

function get_active_user(){

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        $db = get_db();

        $id = new \MongoDB\BSON\ObjectId($_SESSION['user_id']);
        $user = $db->users->findOne(['_id' => $id]);

        return $user;
    }

    return null;
}

function get_favourites(){

    $user = get_active_user();

    if(isset($user['favourites'])){

        $db = get_db();

        foreach($user['favourites'] as $favourite){

            $id = new \MongoDB\BSON\ObjectId($favourite);

            $gallery[] = $db->photos->findOne(['_id' => $id]);
        }

        if(!empty($gallery))return $gallery;
        else return null;
    }

    return null;
}

function delete_favourites(){

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $db = get_db();

        if(!empty($_POST['delete']) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

            $user = get_active_user();

            foreach ($_POST['delete'] as $favourite) {

                unset($user['favourites'][$favourite]);
            }

            $query = ['_id' => $user['_id']];
            $db->users->replaceOne($query, $user);
        }
    }
}

function search(){

    if($_SERVER['REQUEST_METHOD'] === 'GET'){

        $db = get_db();

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_GET['term'])){

            $searched = $_GET['term'];
            $user = get_active_user();
            $model['user'] = $user['login'];

            $query = [ 'title' =>
                ['$regex' => $searched
                    , '$options' => 'i'],
                '$or' => [
                    ['author' => $user['login']],
                    ['access' => 'public'],
                ]
            ];

            $gallery = $db->photos->find($query);
        }
        else if(isset($_GET['term'])){

            $searched = $_GET['term'];
            $query = ['access' => 'public', 'title' =>
                ['$regex' => $searched
                    , '$options' => 'i']];

            $gallery = $db->photos->find($query);
        }

        return $gallery;
    }

    return null;
}

function get_photo(&$model){

    if($_SERVER['REQUEST_METHOD'] === 'GET') {

        if(isset($_GET['id'])){

            $photo = get_photo_by_id($_GET['id']);

            if($photo != null){

                if($photo['access'] == 'private'){

                    $user = get_active_user();

                    if($user != null){

                        if($photo['author'] != $user['login']){

                            http_response_code(401);
                            exit;
                        }
                    }
                    else{

                        header('Location: login');
                        exit;
                    }

                }

                $model['photo'] = $photo['water'];
                $model['author'] = $photo['author'];
                $model['title'] = $photo['title'];
                $model['access'] = $photo['access'];

                return $model;
            }
            else{

                http_response_code(404);
                exit;
            }
        }
        else{

            http_response_code(404);
            exit;
        }
    }

    http_response_code(404);
    exit;
}