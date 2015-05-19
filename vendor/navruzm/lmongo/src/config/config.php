<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    */

    'default' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    */

    'connections' => array(

        'default' => array(
            'host'     => 'ds059661.mongolab.com',
            //'host'	   => 'localhost',
			'port'     =>  59661,
            //'port'		=> '27017',
			'username' => 'admin',
            'password' => 'admin',
			//'database' 	=> 'meduza'
            'database' => 'medusa'
        ),
    ),
);
