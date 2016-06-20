<?php

global $project;
$project = 'mysite';

global $database;
$database = '';

require_once('conf/ConfigureFromEnv.php');

// Set the site locale
i18n::set_locale('en_US');

// Extensions
DataObject::add_extension('SiteConfig', 'SiteConfigExtension');

// specify log files
SS_Log::add_writer(new SS_LogFileWriter('../logs/info.log'), SS_Log::NOTICE);
SS_Log::add_writer(new SS_LogFileWriter('../logs/errors.log'), SS_Log::ERR);