<?php

namespace PluginName;

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

spl_autoload_register(function (string $className): void
{
    $prefix = 'PluginName\\';

    $baseDir = __DIR__ . '/';

    $prefixLength = strlen($prefix);
    if (strncmp($prefix, $className, $prefixLength) !== 0)
    {
        return;
    }

    $relativeClassName = substr($className, $prefixLength);

    $filePath = $baseDir . str_replace('\\', '/', $relativeClassName) . '.php';

    if (file_exists($filePath))
    {
        require_once $filePath;
    }
    else
    {
        exit(esc_html("The file $className.php could not be found!"));
    }
});
