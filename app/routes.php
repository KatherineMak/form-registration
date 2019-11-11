<?php

$router->get('','MainController@home');
$router->get('index', 'MainController@formIndex');
$router->get('additional', 'MainController@formAdditional');
$router->get('share', 'MainController@formShare');

$router->get('ajaxparticipaint', 'AjaxParticipaintController@index');
$router->get('ajaxadditional', 'AjaxParticipaintController@additional');
$router->get('ajaxshare', 'AjaxParticipaintController@share');
$router->get('checksessionemail', 'AjaxParticipaintController@checkSessionEmail');

$router->post('existEmail','AjaxParticipaintController@existEmail');
$router->post('store', 'AjaxParticipaintController@store');
$router->post('additsave', 'AjaxParticipaintController@additsave');

$router->get('members','ParticipaintsController@index');
$router->get('phpinfo','ParticipaintsController@test');
