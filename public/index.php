<?php
ini_set('memory_limit', '2G');
ini_set('upload_max_filesize', '40M');
ini_set('post_max_size', '40M');
use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
