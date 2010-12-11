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



$route['default_controller'] = "photos";
$route['admin'] = "admin/photos/photosView";
$route['login'] = "users/login";
$route['logout'] = "users/logout";
$route['forgotpassword'] = "users/forgotPassword";
$route['photo/(:any)/(:any)'] = "photos/view/$1/$2";
$route['admin/dashboard'] = "admin/photos/photosView";
$route['admin/albums'] = "admin/albums/albumsView";
$route['admin/albums/(:num)'] = "admin/albums/albumsView/$1";
$route['admin/photos'] = "admin/photos/photosView";
$route['admin/photos/(:num)'] = "admin/photos/photosView/$1";
$route['admin/album/(:any)'] = "admin/albums/viewAlbum/$1";
$route['upload/(:any)'] = "admin/photos/photoUpload/$1";
$route['admin/addPhotos'] = "admin/photos/addNoAlbum";
$route['album/(:any)'] = "albums/view/$1";
$route['album/(:any)/(:any)'] = "albums/view/$1/$2";
$route['albums/(:any)'] = "albums/viewAll/$1";
$route['slideshow/(:any)'] = "photos/slideshow/$1";
$route['404'] = "photos/throw404";

if ($this->config->item('enableMultiUser') == TRUE)
{
    // Need regex here...
    $route['(:any)'] = "admin/photos";
    $route['(:any)/dashboard'] = "";
}

/* End of file routes.php */
/* Location: ./application/config/routes.php */