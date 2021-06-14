<?php

// controllers/home.php

require '../fw/fw.php';
require '../views/Home.php';

$vhome = new Home();
$vhome->render();
