<?php

$url_root = __DIR__;
$url_root = implode('/', explode('\\', $url_root, -2));
echo $url_root;
