<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit52d1fb3c3687b65efb2b61650bee6de5
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit52d1fb3c3687b65efb2b61650bee6de5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit52d1fb3c3687b65efb2b61650bee6de5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
