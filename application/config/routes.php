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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Web';
$route['home'] = 'Web/index';
$route['login'] = 'Web/login';
$route['logout'] = 'Web/logout';
$route['contact'] = 'Web/contact';
$route['register'] = 'Web/register';
$route['forgot_password'] = 'Web/forgot_password';
$route['login_validation'] = 'Web/login_validation';
$route['contact_validation'] = 'Web/contact_validation';
$route['register_validation'] = 'Web/register_validation';
$route['forgot_password_validation'] = 'Web/forgot_password_validation';
$route['event_validation'] = 'Web/event_validation';
$route['event_validation/(:any)'] = 'Web/event_validation/$1';
$route['spotlights'] = 'Web/spotlights';
$route['calendar'] = 'Web/calendar';
$route['shop'] = 'Web/shop';
$route['spotlights/(:any)'] = 'Web/spotlights/$1';
$route['instagram_update'] = 'Web/instagram_update';
$route['switchlang/(:any)'] = 'Web/switchLang/$1';
