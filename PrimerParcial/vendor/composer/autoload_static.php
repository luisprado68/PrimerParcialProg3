<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4ee96b94e88b5703855a09284f9680fd
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4ee96b94e88b5703855a09284f9680fd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4ee96b94e88b5703855a09284f9680fd::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
