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
| 	example.com/class/method/id/
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
| There is one reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
*/

// Update references to point the the new routes.

$route['default_controller'] = "photos";
$route['admin'] = "admin/photos";
$route['login'] = "users/login";
$route['logout'] = "users/logout";
$route['forgotpassword'] = "users/forgotPassword";
$route['photo/(:any)/(:any)'] = "photos/view/$1/$2";
$route['admin/dashboard'] = "admin/photos";
$route['admin/album/(:any)'] = "admin/albums/viewAlbum/$1";
$route['admin/upload/(:any)'] = "admin/photos/photoUpload/$1";
$route['album/(:any)'] = "albums/view/$1";
$route['album/(:any)/(:any)'] = "albums/view/$1/$2";
$route['slideshow/(:any)'] = "photos/slideshow/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */