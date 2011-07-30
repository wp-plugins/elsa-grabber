<?php

$abs=$_SERVER['DOCUMENT_ROOT'];
require_once($abs.'/wp-load.php');
$patch=get_option('elsa_pluginpatch',false);

require_once($patch.'/class/class_task.php');
require_once($patch.'/class/class_parser.php');



set_time_limit(500);









?>
