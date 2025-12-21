<?php
namespace Config;
// routes auth

$router->add('GET', 'register', 'AuthController@showRegister'); 
$router->add('POST', 'register', 'AuthController@register');
$router->add('GET', 'login', 'AuthController@showLogin');   
$router->add('POST', 'login', 'AuthController@login'); 

$router->add('GET', 'logout', 'AuthController@logout');
// routes courses
$router->add("GET","", 'CourseController@index');
$router->add('GET','courses', 'CourseController@index');
$router->add('GET','course/create', 'CourseController@create');
$router->add('GET','course/{id}/edit', 'CourseController@edit');
$router->add('GET','course/{id}/confirme', 'CourseController@confirmDelete');
$router->add('POST','course/store', 'CourseController@store');
$router->add('GET','course/{id}/sectionsbycourse', 'CourseController@showSections');
$router->add('POST','course/{id}/update', 'CourseController@update');
$router->add('POST','course/{id}/delete', 'CourseController@destroy');
// routes sections
$router->add('GET','sections', 'SectionController@index');
$router->add('GET','section/create', 'SectionController@create');
$router->add('GET','section/{id}/edit', 'SectionController@edit');
$router->add('GET','section/{id}/delete', 'SectionController@confirmDelete');
$router->add('POST','section/store', 'SectionController@store');
$router->add('POST','section/{id}/update', 'SectionController@update');
$router->add('POST','section/{id}/delete', 'SectionController@destroy');
?>