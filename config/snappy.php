<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => env('WKHTMLTOPDF_BINARY_PATH', 'C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf'),
        'timeout' => env('WKHTMLTOPDF_TIMEOUT', 500),
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => env('WKHTMLTOPDF_BINARY_PATH', 'C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf'),
        'timeout' => env('WKHTMLTOPDF_TIMEOUT', 500),
        'options' => array(),
        'env'     => array(),
    ),


);
