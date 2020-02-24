<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2575af3a3182c19cfeb49283f84a8878
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rakit\\Validation\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rakit\\Validation\\' => 
        array (
            0 => __DIR__ . '/..' . '/rakit/validation/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2575af3a3182c19cfeb49283f84a8878::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2575af3a3182c19cfeb49283f84a8878::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
