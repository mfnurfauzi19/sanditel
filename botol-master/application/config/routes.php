<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth routes
$route['login'] = 'auth';
$route['logout'] = 'auth/logout';
$route['register'] = 'auth/register';

// Data asset routes
$route['data_asset'] = 'Dataasset/data';
$route['data_asset/add'] = 'Dataasset/add';
$route['data_asset/edit/(:num)'] = 'Dataasset/edit/$1'; 
$route['data_asset/update/(:num)'] = 'Dataasset/update/$1';

// Barcode routes
$route['barcode/scan'] = 'barcode/scan';
$route['barcode/process'] = 'barcode/process';

// Data barang routes
$route['data_barang'] = 'dataBarang/index';
$route['data_barang/create'] = 'dataBarang/create';
$route['data_barang/edit/(:num)'] = 'dataBarang/edit/$1';
$route['data_barang/update/(:num)'] = 'dataBarang/update/$1';
$route['data_barang/delete/(:num)'] = 'dataBarang/delete/$1';

// Pengajuan barang routes
$route['pengajuan_barang'] = 'PengajuanBarang/index';
$route['pengajuan_barang/add'] = 'PengajuanBarang/add';
$route['pengajuan_barang/edit/(:num)'] = 'PengajuanBarang/edit/$1';
$route['pengajuan_barang/delete/(:num)'] = 'PengajuanBarang/delete/$1';
$route['pengajuan_barang/approve/(:num)'] = 'PengajuanBarang/approve/$1';
$route['pengajuan_barang/process_approval/(:num)'] = 'PengajuanBarang/process_approval/$1';
$route['pengajuan_barang/process_request'] = 'PengajuanBarang/process_request';
$route['pengajuan_barang/index/(:any)'] = 'PengajuanBarang/index/$1';


// Routes untuk peminjaman barang
$route['peminjaman'] = 'Peminjaman/index';
$route['peminjaman/create'] = 'Peminjaman/create';
$route['peminjaman/edit/(:num)'] = 'Peminjaman/edit/$1';
$route['peminjaman/update/(:num)'] = 'Peminjaman/update/$1';
$route['peminjaman/delete/(:num)'] = 'Peminjaman/delete/$1';


$route['pengajuan_barang/add_to_cart'] = 'PengajuanBarang/add_to_cart';
$route['pengajuan_barang/remove/(:num)'] = 'PengajuanBarang/remove/$1';

$route['stock_opname'] = 'StockOpname/index';
$route['stock_opname/save'] = 'StockOpname/save';

// file application/config/routes.php

$route['dataasset/save_barcode'] ['POST'] = 'dataasset/save_barcode';

$route['data_asset/index_kategori'] = 'Dataasset/index_kategori';  // Route untuk halaman utama kategori
$route['data_asset/detail/(:any)'] = 'Dataasset/detail/$1';  // Route untuk detail kategori
$route['dataasset/tambah_by_kategori'] = 'Dataasset/tambah_by_kategori';

$route['barcode/scan'] = 'barcode/scan';
$route['barcode/process'] = 'barcode/process';











