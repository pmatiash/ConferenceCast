<?php

$files = glob(dirname(__FILE__) . '/app/*.php');

foreach ($files as $file) {
    include($file);
}