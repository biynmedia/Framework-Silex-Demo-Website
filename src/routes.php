<?php

use TechNews\Provider\NewsControllerProvider;
use TechNews\Provider\AdminControllerProvider;

$app->mount('/', new NewsControllerProvider());
$app->mount('/admin', new AdminControllerProvider());