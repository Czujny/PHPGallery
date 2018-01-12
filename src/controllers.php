<?php

function index(&$model){

    require_once '../business.php';

    $gallery = get_gallery();

    $model['gallery'] = $gallery;

    save_favourites();

    $model['user'] = get_active_user();

    return 'galeria_view';
}

function zdjecie(&$model){

    require_once '../business.php';

    get_photo($model);

    return 'zdjecie_view';
}

function login(&$model){

    require_once '../business.php';

    if(get_active_user() == null)login_user();
    else {

        header('Location: panel');
        exit;
    }

    return 'login_view';
}

function plik(&$model){

    require_once '../business.php';

    file_upload($model);

    return 'plik_view';
}

function rejestracja(&$model){

    require_once '../business.php';

    register_user();

    return 'rejestracja_view';
}

function szukaj(&$model){

    return 'szukaj_view';
}

function licencje(&$model){

    return 'licencje_view';
}

function panel(&$model){

    require_once '../business.php';

    delete_favourites();

    $gallery = get_favourites();

    $model['gallery'] = $gallery;

    return 'panel_view';
}

function logout(&$model){

    $params = session_get_cookie_params();
    setcookie(session_name(),
        ''
        , time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );

    session_destroy();

    unset($_SESSION['loggedin']);
    unset($_SESSION['user_id']);

    header('Location: login');
}

function AJAXSearch(&$model){

    require_once '../business.php';

    $gallery = search();

    $model['gallery'] = $gallery;

    return 'partials/AJAXSearch';
}