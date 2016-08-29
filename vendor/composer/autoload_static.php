<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfff13387e09c74ddfefb3789cbbdc7ea
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'Codebird\\Codebird' => __DIR__ . '/..' . '/jublonet/codebird-php/src/codebird.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfff13387e09c74ddfefb3789cbbdc7ea::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfff13387e09c74ddfefb3789cbbdc7ea::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfff13387e09c74ddfefb3789cbbdc7ea::$classMap;

        }, null, ClassLoader::class);
    }
}
