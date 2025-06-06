<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85c4b7922448d0f4b31ff4274c9965de
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit85c4b7922448d0f4b31ff4274c9965de::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit85c4b7922448d0f4b31ff4274c9965de::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit85c4b7922448d0f4b31ff4274c9965de::$classMap;

        }, null, ClassLoader::class);
    }
}
