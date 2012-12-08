<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$route['calendar/admin/new(/:any)?']                  = 'admin2$1';
$route['calendar/admin/types(/:any)?']        = 'admin_types$1';
$route['calendar/admin/view/(:num)']          = 'admin/view/$1';
$route['calendar/admin/(:any)/(:num)/(:num)'] = 'admin/index/$1/$2/$3';
$route['calendar/admin/categories(/:any)?']   = 'admin_categories$1';



$route['calendar/today']                       = 'calendar/index/today';

$route['calendar/view/(all|:num)/(:num)']          = 'calendar/view/$1/$2';
$route['calendar/(all|:num)']                      = 'calendar/index/$1';
$route['calendar/(all|:num)/(:num)']               = 'calendar/index/$1/$2';
$route['calendar/(all|:num)/(:num)/(:num)']        = 'calendar/index/$1/$2/$3';
$route['calendar/(all|:num)/(:num)/(:num)/(:num)'] = 'calendar/index/$1/$2/$3/$4';