<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	# -------------------------------------------------------------------
	# AUTO-LOADER
	# -------------------------------------------------------------------

	//  Auto-load Packages
	$autoload['packages'] = array();

	//  Auto-load Libraries
	$autoload['libraries'] = array('database', 'email', 'session', 'form_validation', 'session', 'pagination');

	//  Auto-load Drivers
	$autoload['drivers'] = array('cache');

	//  Auto-load Helper Files
	$autoload['helper'] = array('url', 'file', 'form', 'text');

	//  Auto-load Config files
	$autoload['config'] = array();

	//  Auto-load Language files
	$autoload['language'] = array();
	
	//  Auto-load Models
	$autoload['model'] = array();
