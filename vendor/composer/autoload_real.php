<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit6ed0d97c7ef8096a159fa7807c84004b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit6ed0d97c7ef8096a159fa7807c84004b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit6ed0d97c7ef8096a159fa7807c84004b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit6ed0d97c7ef8096a159fa7807c84004b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}