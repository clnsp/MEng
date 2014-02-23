<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*$route['default_controller'] = "welcome";
$route['404_override'] = '';*/

$route['auth/(:any)'] = 'auth/$1';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['register'] = 'auth/register';
$route['404_override'] = 'pages/view/page-not-found';
$route['users'] = 'pages/users';
$route['rooms'] = 'pages/rooms';
$route['links'] = 'pages/links';
//$route['footer'] = 'pages/footer';

//$route['pages/admin/'] = 'pages/users';

$route['member'] = 'member';

$route['updateClasses'] = 'pages/updateClasses';
$route['users_fetch'] = 'users_fetch';
$route['booking'] = 'booking';
$route['room/(:any)'] = 'pages/room/$1';
$route['room/getRoomIDs'] = 'room/getRoomIDs';
$route['manage'] = 'pages/manage';
$route['manage-sports-hall'] = 'pages/view/manage-sports-hall';
$route['admin-calendar'] = 'pages/admin_calendar';
$route['category/(:any)'] = 'category/$1';
$route['class_type/(:any)'] = 'class_type/$1';
$route['waiting_list/(:any)'] = 'waiting_list/$1';
$route['facilities/(:any)'] = 'facilities_controller/$1';
$route['court/(:any)'] = 'court/$1';

$route['theme'] = 'theme/index';
$route['bootstraptheme'] = 'theme/css';
$route['bootstraptheme/(:any)'] = 'theme/$1';

$route['welcome'] = 'welcome';

//$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
