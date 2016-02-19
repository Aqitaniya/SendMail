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
|	http://codeigniter.com/user_guide/general/routing.html
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
/*$route['default_controller'] = 'c_mails';

$route['mails/in']='c_mails/index/mails_in';
$route['mails/out']='c_mails/index/mails_out';

$route['mails/in/(:num)']='c_mails/index/mails_in/$1';
$route['mails/out/(:num)']='c_mails/index/mails_out/$1';

$route['mails/show'] = "c_mails/show";
$route['mails/del'] = "c_mails/del";

$route['mails/view/(:any)/(:num)']='c_mail_form/view_mail/$1/$2';
$route['mails/write/(:any)']='c_mail_form/index/$1';*/
$route['default_controller'] = 'mails_controller';
$route['(:num)']='mails_controller/index/in/$1';
$route['mails/in']='mails_controller/index/in';
$route['mails/out']='mails_controller/index/out';
$route['mails/in/(:num)']='mails_controller/index/in/$1';
$route['mails/out/(:num)']='mails_controller/index/out/$1';

$route['mails/del'] = "mails_controller/del";

$route['view/mail/(:any)/(:num)'] = "mails_controller/view_mail/$1/$2";
$route['write/mail/(:any)'] = "mails_controller/write_mail/$1";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

