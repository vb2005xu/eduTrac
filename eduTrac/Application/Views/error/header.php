<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Error Header
 *  
 * PHP 5.4+
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * @copyright (c) 2013 7 Media Web Solutions, LLC
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @link        http://www.7mediaws.org/
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

ob_start();
ob_implicit_flush(0);
use \eduTrac\Classes\Libraries\Hooks;
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid sticky-sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid sticky-top sticky-sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid sticky-top sticky-sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid sticky-top sticky-sidebar"> <![endif]-->
<!--[if !IE]><!--><html class="fluid sticky-top sticky-sidebar"><!-- <![endif]-->
<head>
    <title><?php if(isset($this->staticTitle)) { foreach($this->staticTitle as $title) { echo $title . ' - ' . Hooks::get_option('site_title'); } } else { echo '404 Error'; } ?></title>
	
	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	<link rel="shortcut icon" href="<?=BASE_URL;?>favicon.ico" type="image/x-icon">
	
	<!-- Bootstrap -->
	<link href="<?=BASE_URL;?>static/common/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?=BASE_URL;?>static/common/bootstrap/css/responsive.css" rel="stylesheet" type="text/css" />
	
	<!-- Glyphicons Font Icons -->
	<link href="<?=BASE_URL;?>static/common/theme/fonts/glyphicons/css/glyphicons.css" rel="stylesheet" />
	
	<link rel="stylesheet" href="<?=BASE_URL;?>static/common/theme/fonts/font-awesome/css/font-awesome.min.css">
	<!--[if IE 7]><link rel="stylesheet" href="<?=BASE_URL;?>static/common/theme/fonts/font-awesome/css/font-awesome-ie7.min.css"><![endif]-->
	
	<!-- Main Theme Stylesheet :: CSS -->
	<link href="<?=BASE_URL;?>static/common/theme/css/style-default.css?1371788393" rel="stylesheet" type="text/css" />
	
	
	<!-- LESS.js Library -->
	<script src="<?=BASE_URL;?>static/common/theme/scripts/plugins/system/less.min.js"></script>
</head>
<body class="login ">
	
	<!-- Wrapper -->
<div id="login">

	<div class="container">