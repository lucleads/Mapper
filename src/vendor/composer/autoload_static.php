<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitef90689e3cdc5e34f3a0aba8a1063d6a
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

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitef90689e3cdc5e34f3a0aba8a1063d6a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitef90689e3cdc5e34f3a0aba8a1063d6a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitef90689e3cdc5e34f3a0aba8a1063d6a::$classMap;

        }, null, ClassLoader::class);
    }
}
