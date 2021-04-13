<?php
require 'app/bootstrap.php';

// App input
$options = getopt("f:");
$foptions = $options["f"];

# Invoke the corresponding view/controller
if ($foptions) {
    (new App\UI\GrossPriceCLI())->calculate($foptions);
}