<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Store your secret key here
// Make sure you use better, long, more random key than this
$config['jwt_key'] = 'MY_SECRET_KEY';
// $config['token_timeout'] = 7200; // per menit
$config['token_timeout'] = .5;