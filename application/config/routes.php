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
$route['default_controller'] = 'Login_Controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//----------------------------- user defined routes --------------------

$route['login'] = 'Login_Controller';
$route['login/(:any)'] = 'Login_Controller/$1';

$route['home'] = 'Home_Controller';
$route['home/(:any)'] = 'Home_Controller/$1';

$route['brand'] = 'Brand_Controller';
$route['brand/list'] = 'Brand_Controller/all_list';
$route['brand/(:any)'] = 'Brand_Controller/$1';

$route['store'] = 'Store_Controller';
$route['store/list'] = 'Store_Controller/all_list';
$route['store/(:any)'] = 'Store_Controller/$1';

$route['supplier'] = 'Supplier_Controller';
$route['supplier/list'] = 'Supplier_Controller/all_list';
$route['supplier/(:any)'] = 'Supplier_Controller/$1';

$route['template'] = 'Template_Controller';
$route['template/list'] = 'Template_Controller/all_list';
$route['template/(:any)'] = 'Template_Controller/$1';
$route['template/preview/(:any)'] = 'Template_Controller/preview/$1';

$route['tillcode'] = 'Tillcode_Controller';
$route['tillcode/list'] = 'Tillcode_Controller/all_list';
$route['tillcode/(:any)'] = 'Tillcode_Controller/$1';

$route['acara'] = 'Acara_Controller';
$route['acara/list'] = 'Acara_Controller/all_list';

#$route['acara/(:any)'] = 'Acara_Controller/$1';
$route['acara/isValidSpArticle'] = 'Acara_Controller/isValidSpArticle';
$route['acara/loadMdByDivision'] = 'Acara_Controller/loadMdByDivision';
$route['acara/add'] = 'Acara_Controller/add';
$route['acara/add/new'] = 'Acara_Controller/add/new';
$route['acara/add/next'] = 'Acara_Controller/add/next';
$route['acara/save'] = 'Acara_Controller/save';
$route['acara/save/(:num)'] = 'Acara_Controller/save/$1';
$route['acara/loadStores'] = 'Acara_Controller/loadStores';
$route['acara/loadSuppliers'] = 'Acara_Controller/loadSuppliers';
$route['acara/loadBrands'] = 'Acara_Controller/loadBrands';
$route['acara/loadTillcodes/(:any)'] = 'Acara_Controller/loadTillcodes/$1';
$route['acara/loadTillcodesBySupplier/(:any)/(:any)'] = 'Acara_Controller/loadTillcodesBySupplier/$1/$2';
$route['acara/loadTillcodesByBrand/(:any)/(:any)'] = 'Acara_Controller/loadTillcodesByBrand/$1/$2';
$route['acara/loadTillcodesBySupplierAndBrand/(:any)/(:any)/(:any)'] = 'Acara_Controller/loadTillcodesBySupplierAndBrand/$1/$2/$3';
$route['acara/preview/(:any)'] = 'Acara_Controller/preview/$1';
$route['acara/edit/(:num)'] = 'Acara_Controller/edit/$1';
$route['acara/edit/(:num)/next'] = 'Acara_Controller/edit/$1/next';
$route['acara/delete'] = 'Acara_Controller/delete';
