<?php

namespace System;

use Illuminate\Container\Container;

class DB
{
    public static function connect()
    {
        $settings = array(
            'driver'    => 'mysql',
            'host'      => DB_HOSTNAME,
            'database'  => DB_DATABASE,
            'username'  => DB_USERNAME,
            'password'  => DB_PASSWORD,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        );

        $connFactory = new \Illuminate\Database\Connectors\ConnectionFactory(new Container());
        $conn = $connFactory->make($settings);

        $resolver = new \Illuminate\Database\ConnectionResolver();
        $resolver->addConnection('default', $conn);
        $resolver->setDefaultConnection('default');

        \Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);
    }
}

