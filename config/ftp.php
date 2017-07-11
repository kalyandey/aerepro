<?php
return array(

    /*
	|--------------------------------------------------------------------------
	| Default FTP Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the FTP connections below you wish
	| to use as your default connection for all ftp work.
	|
	*/

    'default' => 'connection1',

    /*
    |--------------------------------------------------------------------------
    | FTP Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the FTP connections setup for your application.
    |
    */

    'connections' => array(

        'connection1' => array(
            'host'   => 'ftp.specs.wj6sbbg5kqo.netdna-cdn.com',
            'port'  => 22,
            'username' => 'specs.wj6sbbg5kqo',
            'password'   => 'aerepro_specs',
            'passive'   => false,
        ),
    ),
);