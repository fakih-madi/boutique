<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85eb8f59539d2d6013803901bcf728cd
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit85eb8f59539d2d6013803901bcf728cd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit85eb8f59539d2d6013803901bcf728cd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit85eb8f59539d2d6013803901bcf728cd::$classMap;

        }, null, ClassLoader::class);
    }
}
