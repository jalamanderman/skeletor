<?php

/**
 * Save this file OUTSIDE of the public_html folder, even for local environments
 * This means it can never 'accidentally' be included in the GitHub repository
 **/

/**
 * Set the environment type
 * For production environments, this MUST be set to 'live' otherwise you shall be severely whipped
 * Read more: https://docs.silverstripe.org/en/getting_started/environment_management/
 **/
define('SS_ENVIRONMENT_TYPE', 'dev');


/**
 * Database credentials
 * Use the VirtualMin credentials and store them in the passwords system
 **/
define('SS_DATABASE_SERVER', 'localhost');
define('SS_DATABASE_USERNAME', 'username');
define('SS_DATABASE_PASSWORD', 'password');
define('SS_DATABASE_NAME', 'databasename');


/**
 * Default CMS login credentials
 * Email: keep this as client@plasticstudio.co.nz for sanity
 * Password: generate and store this in the passwords system, do not use 4&5 for obvious security reasons
 **/
define('SS_DEFAULT_ADMIN_USERNAME', 'client@plasticstudio.co.nz');
define('SS_DEFAULT_ADMIN_PASSWORD', 'password');
