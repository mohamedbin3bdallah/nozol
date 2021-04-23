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
$route['default_controller'] = 'home';
$route['service'] = 'homeservice';$route['service/qrcode'] = 'homeservice/qrcode';$route['service/settings'] = 'homeservice/settings';$route['service/editsettings/(:num)'] = 'homeservice/editsettings/$1';$route['service/partnership'] = 'homeservice/partnership';$route['service/login'] = 'homeservice/login';$route['service/logout'] = 'homeservice/logout';$route['service/account'] = 'myaccount';$route['service/account/edit'] = 'myaccount/edit';$route['service/offers'] = 'offers';$route['service/offers/add'] = 'offers/add';$route['service/offers/create'] = 'offers/create';$route['service/offers/edit/(:num)'] = 'offers/edit/$1';$route['service/offers/editoffer/(:num)'] = 'offers/editoffer/$1';$route['service/offers/del/(:num)'] = 'offers/del/$1';$route['service/ccards'] = 'ccards';$route['service/ccards/add'] = 'ccards/add';$route['service/ccards/create'] = 'ccards/create';$route['service/ccards/edit/(:num)'] = 'ccards/edit/$1';$route['service/ccards/editccard/(:num)'] = 'ccards/editccard/$1';$route['service/ccards/del/(:num)'] = 'ccards/del/$1';$route['service/purchases'] = 'purchases';$route['service/reports'] = 'reportsservice';
$route['404_override'] = 'frontend/errorpage';
$route['404'] = 'frontend/errorpage';
$route['translate_uri_dashes'] = FALSE;