<?php 
	// load hybridauth base file, change the following paths if necessary 
	// note: in your application you probably have to include these only when required.
	$hybridauth_config = dirname(__FILE__) . '/../../hybridauth/config.php';
	require_once( "../../hybridauth/Hybrid/Auth.php" );

	// database config
	$database_host = "localhost"; 
	$database_user = "root";
	$database_pass = "";
	$database_name = "hybridauth_test";

	// Development
	$db["local"] = array(
		'hostname'		=> 	'localhost',
		'username'		=> 	'root',
		'password'		=> 	'',
		'database'		=> 	'ManageFanIC',
		'dbdriver' 		=> 	'mysql',
		'dbprefix' 		=>	'',
		'active_r' 		=>	TRUE,
		'pconnect' 		=>	FALSE,
		'db_debug' 		=>	TRUE,
		'cache_on' 		=>	FALSE,
		'char_set' 		=>	'utf8',
		'dbcollat' 		=>	'utf8_unicode_ci',
		'port' 	 		=>	'3306',

		// 'Tough love': Forces strict mode to test your app for best compatibility
		'stricton' 		=> TRUE,
	);

	$database_link = @ mysql_connect( $db["local"]["hostname"], $db["local"]["username"], $db["local"]["password"] );

	if ( ! $database_link ) {
		die( "This sample requires a Mysql database. Please edit the configuration file: <b>application.config.php</b>. <hr><b>Mysql error</b>: " . mysql_error() );
	}

	$db_selected = mysql_select_db( $db["local"]["database"] );

	if ( ! $db_selected ) {
		die( "This sample requires a Mysql database. Please edit the configuration file: <b>application.config.php</b>. <hr><b>Mysql error</b>: " . mysql_error() );
	}

	function mysql_query_excute( $sql ){ 
		$result = mysql_query($sql);

		if (!$result) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message .= 'Whole query: ' . $sql;
			die($message);
		}

		return $result;
	}
