<?php

class DATABASE_CONFIG {
		
		var $default = array(
                'datasource' => 'Database/Oracle',
                'driver' => 'oracle',
                'connect' => 'oci_connect',
                'persistent' => false,
                'host' => '172.16.16.3',
                //'host' => '122.248.11.234',
                'port' => '1521',
                'login' => 'ec2013final',
                'password' => 'ec2013final',
                'database' => '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP) (HOST=172.16.16.3)(PORT = 1521))) (CONNECT_DATA =(SID = BBSDB)(SERVER = DEDICATED)))',
                'prefix' => ''
                );    
    

    var $authake = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => '172.16.16.3',
            //'host' => '122.248.11.234',
            'login' => 'root', //username for the db
            'password' => 'islmysql123$', //password for the db
            'database' => 'bbsdb', //or any other where you have imported the authake.sql file
            'prefix' => ''
            );

/*

            var $default = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'login' => 'root', //username for the db
            'password' => '', //password for the db
            'database' => 'bbsdb', //or any other where you have imported the authake.sql file
            'prefix' => ''
            );
       var $authake = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'login' => 'root', //username for the db
            'password' => '', //password for the db
            'database' => 'bbsdb', //or any other where you have imported the authake.sql file
            'prefix' => ''
            );     

	*/
	
}