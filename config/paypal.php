<?php 
return [ 
    'client_id' => 'AaZLe7d8_nurxZqUuJCKlTq7LA9R6lIEkvigzginQes3qk0ciV-D_8DdTjn9bzHRRbdCDho0X0pP4LSR',
	'secret' => 'EHGySaaFkHwg1Jdld6I_rPLlVHqR-upBnS7kHNnVFAKuxPgXBaVDpq9Dl9N5VyMiUnCVnCvf5RswiVMT',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];