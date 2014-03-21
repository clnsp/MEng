<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Gym opening closing times
||
|--------------------------------------------------------------------------
*/

$config['open_Monday'] = '07:00';
$config['open_Monday'] = '22:00';

$config['open_Tuesday'] = '07:00';
$config['open_Tuesday'] = '22:00';

$config['open_Wednesday'] = '07:00';
$config['close_Wednesday'] = '22:00';

$config['open_Thursday'] = '07:00';
$config['close_Thursday'] = '22:00';

$config['open_Friday'] = '07:00';
$config['close_Friday'] = '22:00';

$config['open_Saturday'] = '09:00';
$config['close_Saturday'] = '17:00';

$config['open_Sunday'] = '13:00';
$config['close_Sunday'] = '17:00';


/**
 * When can classes be booked in advance
 **/
$config['class_booking_window'] = '+1 days';
$config['sports_booking_window'] = '+7 days';


/**
 * Waiting list length
 **/
 $config['max_waiting'] = 10; //percentage of class size