<?php
$router->get('', 'CourseController@index');
$router->get('courses', 'CourseController@index');
$router->get('course/edit', 'CourseController@edit');
$router->get('course/create', 'CourseController@create');
$router->post('course/store', 'CourseController@store');
$router->post('course/update', 'CourseController@update');
$router->post('course/delete', 'CourseController@destroy');
$router->get('course/confirmDelete', 'CourseController@confirmDelete');

?>