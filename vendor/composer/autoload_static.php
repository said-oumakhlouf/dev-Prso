<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit10dbf7aec6fd7822a794901131bb4eda
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
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'App\\Controllers\\LivreController' => __DIR__ . '/../..' . '/src/controllers/LivreController.php',
        'App\\Models\\Livre' => __DIR__ . '/../..' . '/src/models/Livre.php',
        'App\\Models\\LivreManager' => __DIR__ . '/../..' . '/src/models/LivreManager.php',
        'App\\Models\\Model' => __DIR__ . '/../..' . '/src/models/Model.php',
        'App\\Models\\Post' => __DIR__ . '/../..' . '/src/models/Post.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit10dbf7aec6fd7822a794901131bb4eda::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit10dbf7aec6fd7822a794901131bb4eda::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit10dbf7aec6fd7822a794901131bb4eda::$classMap;

        }, null, ClassLoader::class);
    }
}
