<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbcf662db35fa18fc21a0ff068f1100e7
{
    public static $files = array (
        '3a37ebac017bc098e9a86b35401e7a68' => __DIR__ . '/..' . '/mongodb/mongodb/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MongoDB\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MongoDB\\' => 
        array (
            0 => __DIR__ . '/..' . '/mongodb/mongodb/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbcf662db35fa18fc21a0ff068f1100e7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbcf662db35fa18fc21a0ff068f1100e7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
