<?php
header("Content-type: text/css; charset: UTF-8");
$this->config->load('theme');

$brandPrimary = $this->config->item('primary_color');
$brandSecondary = $this->config->item('secondary_color');

?>

/*!
 * Bootstrap v3.0.2 by @fat and @mdo
 * Copyright 2013 Twitter, Inc.
 * Licensed under http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built with all the love in the world by @mdo and @fat.
 */

 .btn-default,
 .btn-primary,
 .btn-success,
 .btn-info,
 .btn-warning,
 .btn-danger {
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(0, 0, 0, 0.075);
}

.btn-default:active,
.btn-primary:active,
.btn-success:active,
.btn-info:active,
.btn-warning:active,
.btn-danger:active,
.btn-default.active,
.btn-primary.active,
.btn-success.active,
.btn-info.active,
.btn-warning.active,
.btn-danger.active {
  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}

.btn:active,
.btn.active {
  background-image: none;
}

.btn-default {
  text-shadow: 0 1px 0 #fff;
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#ffffff), to(#e0e0e0));
  background-image: -webkit-linear-gradient(top, #ffffff 0%, #e0e0e0 100%);
  background-image: -moz-linear-gradient(top, #ffffff 0%, #e0e0e0 100%);
  background-image: linear-gradient(to bottom, #ffffff 0%, #e0e0e0 100%);
  background-repeat: repeat-x;
  border-color: #dbdbdb;
  border-color: #ccc;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe0e0e0', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

.btn-default:hover,
.btn-default:focus {
  background-color: #e0e0e0;
  background-position: 0 -15px;
}

.btn-default:active,
.btn-default.active {
  background-color: #e0e0e0;
  border-color: #dbdbdb;
}

.btn-primary {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#3478b2), to(#1a4972));
  background-image: -webkit-linear-gradient(top, #3478b2 0%, #1a4972 100%);
  background-image: -moz-linear-gradient(top, #3478b2 0%, #1a4972 100%);
  background-image: linear-gradient(to bottom, #3478b2 0%, #1a4972 100%);
  background-repeat: repeat-x;
  border-color: #3478b2;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3478b2', endColorstr='#1a4972', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

.btn-primary:hover,
.btn-primary:focus {
  background-color: #1A4972;
  background-position: 0 -15px;
}

.btn-primary:active,
.btn-primary.active {
  background-color: #2d6ca2;
  border-color: #2b669a;
}

.btn-success {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#5cb85c), to(#419641));
  background-image: -webkit-linear-gradient(top, #5cb85c 0%, #419641 100%);
  background-image: -moz-linear-gradient(top, #5cb85c 0%, #419641 100%);
  background-image: linear-gradient(to bottom, #5cb85c 0%, #419641 100%);
  background-repeat: repeat-x;
  border-color: #3e8f3e;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5cb85c', endColorstr='#ff419641', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

.btn-success:hover,
.btn-success:focus {
  background-color: #419641;
  background-position: 0 -15px;
}

.btn-success:active,
.btn-success.active {
  background-color: #419641;
  border-color: #3e8f3e;
}

.btn-warning {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#f0ad4e), to(#eb9316));
  background-image: -webkit-linear-gradient(top, #f0ad4e 0%, #eb9316 100%);
  background-image: -moz-linear-gradient(top, #f0ad4e 0%, #eb9316 100%);
  background-image: linear-gradient(to bottom, #f0ad4e 0%, #eb9316 100%);
  background-repeat: repeat-x;
  border-color: #e38d13;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff0ad4e', endColorstr='#ffeb9316', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

.btn-warning:hover,
.btn-warning:focus {
  background-color: #eb9316;
  background-position: 0 -15px;
}

.btn-warning:active,
.btn-warning.active {
  background-color: #eb9316;
  border-color: #e38d13;
}

.btn-danger {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#d9534f), to(#c12e2a));
  background-image: -webkit-linear-gradient(top, #d9534f 0%, #c12e2a 100%);
  background-image: -moz-linear-gradient(top, #d9534f 0%, #c12e2a 100%);
  background-image: linear-gradient(to bottom, #d9534f 0%, #c12e2a 100%);
  background-repeat: repeat-x;
  border-color: #b92c28;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd9534f', endColorstr='#ffc12e2a', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

.btn-danger:hover,
.btn-danger:focus {
  background-color: #c12e2a;
  background-position: 0 -15px;
}

.btn-danger:active,
.btn-danger.active {
  background-color: #c12e2a;
  border-color: #b92c28;
}

.btn-info {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#5bc0de), to(#2aabd2));
  background-image: -webkit-linear-gradient(top, #5bc0de 0%, #2aabd2 100%);
  background-image: -moz-linear-gradient(top, #5bc0de 0%, #2aabd2 100%);
  background-image: linear-gradient(to bottom, #5bc0de 0%, #2aabd2 100%);
  background-repeat: repeat-x;
  border-color: #28a4c9;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de', endColorstr='#ff2aabd2', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

.btn-info:hover,
.btn-info:focus {
  background-color: #2aabd2;
  background-position: 0 -15px;
}

.btn-info:active,
.btn-info.active {
  background-color: #2aabd2;
  border-color: #28a4c9;
}

.thumbnail,
.img-thumbnail {
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075);
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075);
}

.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus {
  background-color: #e8e8e8;
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#f5f5f5), to(#e8e8e8));
  background-image: -webkit-linear-gradient(top, #f5f5f5 0%, #e8e8e8 100%);
  background-image: -moz-linear-gradient(top, #f5f5f5 0%, #e8e8e8 100%);
  background-image: linear-gradient(to bottom, #f5f5f5 0%, #e8e8e8 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff5f5f5', endColorstr='#ffe8e8e8', GradientType=0);
}

.dropdown-menu > .active > a,
.dropdown-menu > .active > a:hover,
.dropdown-menu > .active > a:focus {
 /* background-color: #357ebd;
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(<?php echo $brandSecondary;?>), to(#357ebd));
  background-image: -webkit-linear-gradient(top, <?php echo $brandSecondary;?> 0%, #357ebd 100%);
  background-image: -moz-linear-gradient(top, <?php echo $brandSecondary;?> 0%, #357ebd 100%);
  background-image: linear-gradient(to bottom, <?php echo $brandSecondary;?> 0%, #357ebd 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff41807B', endColorstr='#ff357ebd', GradientType=0);*/
}

.navbar-default {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#ffffff), to(#f8f8f8));
  background-image: -webkit-linear-gradient(top, #ffffff 0%, #f8f8f8 100%);
  background-image: -moz-linear-gradient(top, #ffffff 0%, #f8f8f8 100%);
  background-image: linear-gradient(to bottom, #ffffff 0%, #f8f8f8 100%);
  background-repeat: repeat-x;
  border-radius: 4px;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#fff8f8f8', GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 5px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 5px rgba(0, 0, 0, 0.075);
}

.navbar-default .navbar-nav > .active > a {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#ebebeb), to(#f3f3f3));
  background-image: -webkit-linear-gradient(top, #ebebeb 0%, #f3f3f3 100%);
  background-image: -moz-linear-gradient(top, #ebebeb 0%, #f3f3f3 100%);
  background-image: linear-gradient(to bottom, #ebebeb 0%, #f3f3f3 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffebebeb', endColorstr='#fff3f3f3', GradientType=0);
  -webkit-box-shadow: inset 0 3px 9px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 3px 9px rgba(0, 0, 0, 0.075);
}

.navbar-brand,
.navbar-nav > li > a {
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.25);
}

.navbar-inverse {
  background-image: none;
}

.navbar-inverse .navbar-nav > .active > a {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#222222), to(<?php echo $brandSecondary;?>));
  background-image: -webkit-linear-gradient(top, #222222 0%, <?php echo $brandSecondary;?> 100%);
  background-image: -moz-linear-gradient(top, #222222 0%, <?php echo $brandSecondary;?> 100%);
  background-image: linear-gradient(to bottom, #222222 0%, <?php echo $brandSecondary;?> 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff222222', endColorstr='<?php echo $brandSecondary;?>', GradientType=0);
  -webkit-box-shadow: inset 0 3px 9px <?php echo $brandSecondary;?>;
  box-shadow: inset 0 3px 9px rgba(0, 0, 0, 0.25);
}

.navbar-inverse .navbar-brand,
.navbar-inverse .navbar-nav > li > a {
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}

.navbar-static-top,
.navbar-fixed-top,
.navbar-fixed-bottom {
  border-radius: 0;
}

.alert {
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.2);
  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 1px 2px rgba(0, 0, 0, 0.05);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25), 0 1px 2px rgba(0, 0, 0, 0.05);
}

.alert-success {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#dff0d8), to(#c8e5bc));
  background-image: -webkit-linear-gradient(top, #dff0d8 0%, #c8e5bc 100%);
  background-image: -moz-linear-gradient(top, #dff0d8 0%, #c8e5bc 100%);
  background-image: linear-gradient(to bottom, #dff0d8 0%, #c8e5bc 100%);
  background-repeat: repeat-x;
  border-color: #b2dba1;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffdff0d8', endColorstr='#ffc8e5bc', GradientType=0);
}

.alert-info {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#d9edf7), to(#b9def0));
  background-image: -webkit-linear-gradient(top, #d9edf7 0%, #b9def0 100%);
  background-image: -moz-linear-gradient(top, #d9edf7 0%, #b9def0 100%);
  background-image: linear-gradient(to bottom, #d9edf7 0%, #b9def0 100%);
  background-repeat: repeat-x;
  border-color: #9acfea;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd9edf7', endColorstr='#ffb9def0', GradientType=0);
}

.alert-warning {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#fcf8e3), to(#f8efc0));
  background-image: -webkit-linear-gradient(top, #fcf8e3 0%, #f8efc0 100%);
  background-image: -moz-linear-gradient(top, #fcf8e3 0%, #f8efc0 100%);
  background-image: linear-gradient(to bottom, #fcf8e3 0%, #f8efc0 100%);
  background-repeat: repeat-x;
  border-color: #f5e79e;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffcf8e3', endColorstr='#fff8efc0', GradientType=0);
}

.alert-danger {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#f2dede), to(#e7c3c3));
  background-image: -webkit-linear-gradient(top, #f2dede 0%, #e7c3c3 100%);
  background-image: -moz-linear-gradient(top, #f2dede 0%, #e7c3c3 100%);
  background-image: linear-gradient(to bottom, #f2dede 0%, #e7c3c3 100%);
  background-repeat: repeat-x;
  border-color: #dca7a7;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff2dede', endColorstr='#ffe7c3c3', GradientType=0);
}

.progress {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#ebebeb), to(#f5f5f5));
  background-image: -webkit-linear-gradient(top, #ebebeb 0%, #f5f5f5 100%);
  background-image: -moz-linear-gradient(top, #ebebeb 0%, #f5f5f5 100%);
  background-image: linear-gradient(to bottom, #ebebeb 0%, #f5f5f5 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffebebeb', endColorstr='#fff5f5f5', GradientType=0);
}

.progress-bar {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(<?php echo $brandSecondary;?>), to(#3071a9));
  background-image: -webkit-linear-gradient(top, <?php echo $brandSecondary;?> 0%, #3071a9 100%);
  background-image: -moz-linear-gradient(top, <?php echo $brandSecondary;?> 0%, #3071a9 100%);
  background-image: linear-gradient(to bottom, <?php echo $brandSecondary;?> 0%, #3071a9 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff41807B', endColorstr='#ff3071a9', GradientType=0);
}

.progress-bar-success {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#5cb85c), to(#449d44));
  background-image: -webkit-linear-gradient(top, #5cb85c 0%, #449d44 100%);
  background-image: -moz-linear-gradient(top, #5cb85c 0%, #449d44 100%);
  background-image: linear-gradient(to bottom, #5cb85c 0%, #449d44 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5cb85c', endColorstr='#ff449d44', GradientType=0);
}

.progress-bar-info {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#5bc0de), to(#31b0d5));
  background-image: -webkit-linear-gradient(top, #5bc0de 0%, #31b0d5 100%);
  background-image: -moz-linear-gradient(top, #5bc0de 0%, #31b0d5 100%);
  background-image: linear-gradient(to bottom, #5bc0de 0%, #31b0d5 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de', endColorstr='#ff31b0d5', GradientType=0);
}

.progress-bar-warning {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#f0ad4e), to(#ec971f));
  background-image: -webkit-linear-gradient(top, #f0ad4e 0%, #ec971f 100%);
  background-image: -moz-linear-gradient(top, #f0ad4e 0%, #ec971f 100%);
  background-image: linear-gradient(to bottom, #f0ad4e 0%, #ec971f 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff0ad4e', endColorstr='#ffec971f', GradientType=0);
}

.progress-bar-danger {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#d9534f), to(#c9302c));
  background-image: -webkit-linear-gradient(top, #d9534f 0%, #c9302c 100%);
  background-image: -moz-linear-gradient(top, #d9534f 0%, #c9302c 100%);
  background-image: linear-gradient(to bottom, #d9534f 0%, #c9302c 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd9534f', endColorstr='#ffc9302c', GradientType=0);
}

.list-group {
  border-radius: 4px;
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075);
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.075);
}

.list-group-item.active,
.list-group-item.active:hover,
.list-group-item.active:focus {
  text-shadow: 0 -1px 0 #3071a9;
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(<?php echo $brandSecondary;?>), to(#3278b3));
  background-image: -webkit-linear-gradient(top, <?php echo $brandSecondary;?> 0%, #3278b3 100%);
  background-image: -moz-linear-gradient(top, <?php echo $brandSecondary;?> 0%, #3278b3 100%);
  background-image: linear-gradient(to bottom, <?php echo $brandSecondary;?> 0%, #3278b3 100%);
  background-repeat: repeat-x;
  border-color: #3278b3;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff41807B', endColorstr='#ff3278b3', GradientType=0);
}

.panel {
  -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.panel-default > .panel-heading {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#f5f5f5), to(#e8e8e8));
  background-image: -webkit-linear-gradient(top, #f5f5f5 0%, #e8e8e8 100%);
  background-image: -moz-linear-gradient(top, #f5f5f5 0%, #e8e8e8 100%);
  background-image: linear-gradient(to bottom, #f5f5f5 0%, #e8e8e8 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff5f5f5', endColorstr='#ffe8e8e8', GradientType=0);
}

.panel-primary > .panel-heading {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(<?php echo $brandSecondary;?>), to(#357ebd));
  background-image: -webkit-linear-gradient(top, <?php echo $brandSecondary;?> 0%, #357ebd 100%);
  background-image: -moz-linear-gradient(top, <?php echo $brandSecondary;?> 0%, #357ebd 100%);
  background-image: linear-gradient(to bottom, <?php echo $brandSecondary;?> 0%, #357ebd 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff41807B', endColorstr='#ff357ebd', GradientType=0);
}

.panel-success > .panel-heading {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#dff0d8), to(#d0e9c6));
  background-image: -webkit-linear-gradient(top, #dff0d8 0%, #d0e9c6 100%);
  background-image: -moz-linear-gradient(top, #dff0d8 0%, #d0e9c6 100%);
  background-image: linear-gradient(to bottom, #dff0d8 0%, #d0e9c6 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffdff0d8', endColorstr='#ffd0e9c6', GradientType=0);
}

.panel-info > .panel-heading {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#d9edf7), to(#c4e3f3));
  background-image: -webkit-linear-gradient(top, #d9edf7 0%, #c4e3f3 100%);
  background-image: -moz-linear-gradient(top, #d9edf7 0%, #c4e3f3 100%);
  background-image: linear-gradient(to bottom, #d9edf7 0%, #c4e3f3 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd9edf7', endColorstr='#ffc4e3f3', GradientType=0);
}

.panel-warning > .panel-heading {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#fcf8e3), to(#faf2cc));
  background-image: -webkit-linear-gradient(top, #fcf8e3 0%, #faf2cc 100%);
  background-image: -moz-linear-gradient(top, #fcf8e3 0%, #faf2cc 100%);
  background-image: linear-gradient(to bottom, #fcf8e3 0%, #faf2cc 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffcf8e3', endColorstr='#fffaf2cc', GradientType=0);
}

.panel-danger > .panel-heading {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#f2dede), to(#ebcccc));
  background-image: -webkit-linear-gradient(top, #f2dede 0%, #ebcccc 100%);
  background-image: -moz-linear-gradient(top, #f2dede 0%, #ebcccc 100%);
  background-image: linear-gradient(to bottom, #f2dede 0%, #ebcccc 100%);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff2dede', endColorstr='#ffebcccc', GradientType=0);
}

.well {
  background-image: -webkit-gradient(linear, left 0%, left 100%, from(#e8e8e8), to(#f5f5f5));
  background-image: -webkit-linear-gradient(top, #e8e8e8 0%, #f5f5f5 100%);
  background-image: -moz-linear-gradient(top, #e8e8e8 0%, #f5f5f5 100%);
  background-image: linear-gradient(to bottom, #e8e8e8 0%, #f5f5f5 100%);
  background-repeat: repeat-x;
  border-color: #dcdcdc;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffe8e8e8', endColorstr='#fff5f5f5', GradientType=0);
  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 0 rgba(255, 255, 255, 0.1);
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 0 rgba(255, 255, 255, 0.1);
}

/*
 * MEng Specialised css 
 **********************************************
 */

 #footer .row{
   color: #fff;
 }

 body{
  background-color: rgba(226, 226, 226, 0.65);
  padding-top: 70px; //for fixed nav
}

.div-center{
	margin-left: auto;
	margin-right: auto;
	float: none!important;
}

img.displayed {
  display: block;
  margin-left: auto;
  margin-right: auto 
} 
html, body, #booking {
  height: 100%;
  /* The html and body elements cannot have any padding or margin. */
}

/* Wrapper for page content to push down footer */
#page-wrapper {
  min-height: 100%;
  height: auto !important;
  height: 100%;
  /* Negative indent footer by it's height */
  margin: 0 auto -155px;
}

#booking .username{
  text-transform: capitalize;
}

/* @group Footer */

/* Set the fixed height of the footer here */
.push,
#footer {
  height: 155px;
  margin-top: 0!important;
}
/* Lastly, apply responsive CSS fixes as necessary */
@media (max-width: 767px) {
  #footer {
    margin-left: -20px;
    margin-right: -20px;
    padding-left: 20px;
    padding-right: 20px;
  }
}

/* @end */

#booking .navbar-brand{
  padding: 1px 10px;
}

/* @group Sub Modal */

.modal.submodal{
  width: 50%!important;
  margin-left: auto;
  margin-right: auto;
  overflow: hidden;
  outline-color: transparent!important;
  outline:none;
}

.modal.submodal .modal-dialog{
  width: 100%
}

.modal.submodal .modal-content{
  border-top-left-radius: 0;
  border-top-right-radius: 0;

}

/* @end */


/* @group Loading Indicator */

#loading-indicator i{
  font-size: 20px;
  margin-left: 10px;
}

#loading-indicator{
  color: #fff;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 250px;
  background-color: rgba(56, 56, 56, 0.63);
  border-radius: 10px;
  margin-left: -125px;
  text-align: center;
  padding: 10px;
  z-index: 250000;
}

/* @end */

/* @group Login */

#login-form #remember-me{
 margin: 0px 15px 15px;
}

/* @end */

/* @group Checkbox Group */

/* Margin for list checkbox*/
.checkbox-group .list-group-item input{
  margin-right: 5px;
}

.checkbox-group .list-group-item.selected{
	background-color: #E8E8E8;

}
.checkbox-group .list-group-item:hover,
.checkbox-group .list-group-item:focus{
  background-color: #F5F5F5;
  cursor: pointer;
}

.checkbox-group .list-group-item .editable{
	cursor: text;
}

/* @end */

/* @group Bootstrap Overrides  */

i.square{
  font-size: 20px;
}



#booking .navbar-top{
 border-radius: 0!important;
 border-bottom: 3px solid <?php echo $brandSecondary;?>;
 border-right-style: none;
 border-left-style: none;
 background-color: <?php echo $brandPrimary;?>!important;
}


#footer, .footer{
  margin-top: 2em;
  padding: 1em;
  background-color: <?php echo $brandPrimary;?>;
}

#booking #footer .nav-pills li a{
  color: #2A6496;
}

#booking #footer .nav-pills li a:hover{
  background-color: rgba(255, 255, 255, 0);
  color: #428BCA;
}


#booking .nav .caret{
  border-top-color: <?php echo $brandSecondary;?>;
  border-bottom-color: <?php echo $brandSecondary;?>;
}

#booking .navbar .dropdown-menu::after {
 position: absolute;
 top: -6px;
 right: 20px;
 display: inline-block;
 border-right: 6px solid transparent;
 border-bottom: 6px solid white;
 border-left: 6px solid transparent;
 content: '';
 color: rgba(65, 128, 123, 0.63);
}

#booking #page-body.page-login div.input-group{
  margin-bottom: 15px;
}

@media (min-width: 1200px){
  #booking .container {
   width: 100%;
 }
}

/* @end */


/* @group Calendar */


#booking #calendar .fc-header-title{
  padding: 0 15px;
}

#booking #calendar .fc-view tbody{
  background-color: #fff;
}

#booking #calendar thead .fc-first{
  border-top-left-radius: 5px;
}

#booking #calendar thead .fc-last{
  border-top-right-radius: 5px;
}

#booking #calendar .fc-event.cancelled .fc-event-title:after{
	content: " Cancelled";
}

#booking #calendar .fc-day:hover,
#booking #calendar .fc-agenda-slots tr:hover{
  background-color: rgba(255, 255, 255, 0.49);
}

#booking #eventModal #eventColor{
  color: #bbb;
  font-size: 35px;
}



#booking #eventModal #cancelled-banner{
	background-color: rgba(0, 0, 0, 0.69);
	padding: 0 5px 0 5px;
	border-radius: 5px;
	margin-left: 10px;
	border: 1px solid #000;
	color: rgba(255, 255, 255, 0.74);
}

/*
#booking #eventModal #event-description{
	display:block;
}

#booking #eventModal button.close{
  position: absolute;
  top: -10px;
  left: -10px;
  background-color: #B4B4B4;
  border-radius: 20px;
  padding-left: 5px;
  padding-right: 5px;
  opacity: 1;
  border: 2px solid #000;
}
*/

#booking .form-control:focus{
	border: 1px solid <?php echo $brandSecondary;?>;
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075),0 0 8px rgba(102, 175, 233, 0.6);
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075),0 0 8px rgba(102, 175, 233, 0.6);	
}

#booking #eventModal .modal-body{
  max-height: 400px;
  min-height: 100px;
}

#booking #eventModal .modal-body #event-member-list{
  max-height: 325px;
  overflow-y: scroll;
  margin-bottom: 25px;
}


#booking #eventModal #event-member-list .list-group-item{
  text-transform: capitalize;
}

#booking .fc-event.cancelled{
	background-image: -webkit-linear-gradient(45deg,rgba(255, 255, 255, 0.15) 25%,rgba(0, 0, 0, 0.5) 25%,rgba(0, 0, 0, 0.5) 50%,rgba(255, 255, 255, 0.15) 50%,rgba(255, 255, 255, 0.15) 75%,rgba(0, 0, 0, 0.5) 75%,rgba(0, 0, 0, 0.5));
	background-image: linear-gradient(45deg,rgba(255, 255, 255, 0.15) 25%,rgba(0, 0, 0, 0.5) 25%,rgba(0, 0, 0, 0.5) 50%,rgba(255, 255, 255, 0.15) 50%,rgba(255, 255, 255, 0.15) 75%,rgba(0, 0, 0, 0.5) 75%,rgba(0, 0, 0, 0.5));
	border: 1px solid #000000!important;
	font-weight: bold;
}


/* @end */

/* @group Autocomplete */

ul.ui-menu .ui-menu-item:hover {
 cursor: pointer;
}

ul.ui-menu .ui-menu-item {
  padding: 5px 0 5px 0;
}

ul.ui-autocomplete.popover.dropdown-menu{
  max-height: 300px;
  overflow-y: scroll;
}

/* @end */

/* @group Add Guest Modal */

#eventModal #btn-add-guest-member{
  margin-top: 20px;
}

/* @end */

/* @group Multi Select Dropdown */

#booking .dropdown-menu.multi-select li a:before{
  content: "\e067";
  font-family: 'Glyphicons Halflings';
  visibility: hidden;
  padding-right: 2px;
}

.dropdown-menu.multi-select>li>a {
	padding: 3px 10px;
}

#booking .dropdown-menu.multi-select li.selected a:before{
  visibility: visible;
}


/* @end */

/* @group Manage */

.manage-panel{
  max-height: 450px;
  overflow-y: scroll;
}

#booking.manage-sports-hall #divisible-room{
  height:250px;
  background-color: #AFAFAF;
  margin-bottom: 15px;

}


#divisible-room.box-divider{
  width:100%;
  height:100%;
  display: table;
}

.box-divider .box{ 
  background: #FFDB49;
  border: 5px solid #FFF;
  display: table-cell;
}

.box-divider .box:hover{
  cursor: pointer;
  opacity: 0.5;
} 

.box-divider .box.selected{
  background-color: #90CAFF;
} 

.box-divider .box.multiselect{
  background-color: #97DD8D;
  border-color: #97DD8D;
} 

.box-divider .tr{
  display:table-row;
}



/* @end */

