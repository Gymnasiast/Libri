<?php
namespace Libri;

use Libri\View\MainView;
use Libri\View\PrintView;

require_once __DIR__ . '/vendor/autoload.php';

function autoload($prefix, $dir, $class)
{
    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/' . $dir;

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0)
    {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file))
    {
        /** @noinspection PhpIncludeInspection */
        require $file;
    }
}

/**
 * Autoloader for Libri (PSR-4)
 */
spl_autoload_register(function ($class)
{
    autoload('Libri\\', 'src/', $class);
});

/**
 * Autoloader for Cyndaron (PSR-4)
 */
spl_autoload_register(function ($class)
{
    autoload('Cyndaron\\', 'vendor/Cyndaron/', $class);
});

switch ($_GET['page'])
{
    case 'ajax':
        include 'ajax-endpoint.php';
        break;
    case 'print':
        new PrintView();
        break;
    default:
        new MainView();
}



