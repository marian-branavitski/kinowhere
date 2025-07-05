<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['films'] = 'films';
$route['films/create'] = 'films/create';
$route['films/comment'] = 'films/comment/$1';
$route['films/comment/delete/(:any)'] = 'films/comment_delete/$1';
$route['films/save'] = 'films/save/$1';
$route['films/savetowatch'] = 'films/savetowatch/$1';
$route['films/watch_later'] = 'films/watch_later';
$route['films/liked'] = 'films/liked';
$route['films/addlike'] = 'films/addlike/$1';
$route['films/library'] = 'films/library';
$route['films/remove_watch_later/(:any)'] = 'films/remove_watch_later/$1';
$route['films/remove_like/(:any)'] = 'films/remove_like/$1';
$route['films/edit/(:any)'] = 'films/edit/$1';
$route['films/view/(:any)'] = 'films/view/$1';
$route['films/delete/(:any)'] = 'films/delete/$1';

$route['films/download/(:any)'] = 'films/download_film/$1';

$route['films/admin'] = 'films/admin';
$route['films/admin/all'] = 'films/admin/all';

$route['films/type/films'] = 'films/type/films/$1';
$route['films/type/serials'] = 'films/type/serials/$1';
$route['films/type/family'] = 'films/type/family/$1';
$route['films/type/children'] = 'films/type/children/$1';
$route['films/type/adults'] = 'films/type/adults/$1';
$route['films/type/2022'] = 'films/type/2022/$1';
$route['films/type/2021'] = 'films/type/2021/$1';

$route['search'] = 'search';
$route['search/(:any)'] = 'search/$1';
