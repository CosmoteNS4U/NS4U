<?php
defined('ABSPATH') || die();

add_filter( 'xmlrpc_enabled', '__return_false' );
