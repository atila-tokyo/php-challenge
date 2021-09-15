<?php

use Src\Controller\AddressController;

require __DIR__ . "/../bootstrap.php";

$addressController = new AddressController();

$data = null;

if (isset($_REQUEST['command']) && ($_REQUEST['command'] == 'search')) {
    $addressController->handleSearch();
    die();
}


view('home', $data);
