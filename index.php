<?php

require_once __DIR__ . '/config.php';
require_once ROOT_DIR . '/System/autoload.php';
require_once ROOT_DIR . '/vendor/autoload.php';
\System\DB::connect();
\System\App::run();