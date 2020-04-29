<?php
require 'app/bootstrap.php';

// App input
$options = getopt("f:");
$foptions = $options["f"];

# Involke the coresponding view/controller
if ($foptions) {
    (new App\UI\GrossPriceCLI())->calculate($foptions);
}

# Another request
// if ($options) {
//     (new App\UI\otherView())->doSomething(options);
// }