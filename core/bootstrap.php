<?php

use App\Core\App;

App::bind('config', require '../config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

function view($name, $data=[])
{
    extract($data);
    return require "../app/views/{$name}.view.php";
}

function viewAjax($name, $data=[])
{
    $data['view'] = file_get_contents( "../app/views/{$name}.view.php");
    echo(json_encode($data));
}

function showResult($data=[])
{
    echo(json_encode($data));
}

function redirect($path)
{
    header("Location: /{$path}");
}