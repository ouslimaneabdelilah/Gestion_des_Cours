<?php
// routes courses
namespace Core;
$router->get('', 'CourseController@index');
$router->get('courses', 'CourseController@index');
$router->get('course/create', 'CourseController@create');
$router->get('course/{id}/edit', 'CourseController@edit');
$router->get('course/{id}/delete', 'CourseController@confirmDelete');
$router->post('course/store', 'CourseController@store');
$router->get('course/{id}/sectionsbycourse', 'CourseController@showSections');
$router->post('course/{id}/update', 'CourseController@update');
$router->post('course/{id}/delete', 'CourseController@destroy');
// routes sections
$router->get('sections', 'SectionController@index');
$router->get('section/create', 'SectionController@create');
$router->get('section/{id}/edit', 'SectionController@edit');
$router->get('section/{id}/delete', 'SectionController@confirmDelete');
$router->post('section/store', 'SectionController@store');
$router->post('section/{id}/update', 'SectionController@update');
$router->post('section/{id}/delete', 'SectionController@destroy');
?>