<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ea51f31804c52d5df0ebcd79c1128fc
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpOption\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpOption\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoption/phpoption/src/PhpOption',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PhpCollection' => 
            array (
                0 => __DIR__ . '/..' . '/phpcollection/phpcollection/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ea51f31804c52d5df0ebcd79c1128fc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ea51f31804c52d5df0ebcd79c1128fc::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit5ea51f31804c52d5df0ebcd79c1128fc::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}