<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit72ebf859a29f0a1d272dd25d4dc4b841
{
    public static $files = array (
        '9b38cf48e83f5d8f60375221cd213eee' => __DIR__ . '/..' . '/phpstan/phpstan/bootstrap.php',
    );

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
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit72ebf859a29f0a1d272dd25d4dc4b841::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit72ebf859a29f0a1d272dd25d4dc4b841::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit72ebf859a29f0a1d272dd25d4dc4b841::$classMap;

        }, null, ClassLoader::class);
    }
}
