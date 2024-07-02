<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['admin/update_status/(:num)/(:any)'] = 'Admin/update_status/$1/$2';

// Sampah Organik API Route
$route['api-konten/add'] = 'APIcontroller/addkonten';
$route['api-konten/delete'] = 'APIcontroller/deletekonten';
$route['api-konten/update'] = 'APIcontroller/updatekonten';