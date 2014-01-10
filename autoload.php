<?php

/**
 * Registers an autoload for all the classes.
 */
spl_autoload_register(
    function ($className) {
        if (strpos($className, 'ChiTeck\TextFormatter') === 0) {
            require_once __DIR__ . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        }
    }
);


