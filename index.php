<?php

require_once 'system/func.php';
require_once 'system/req.php';
errorInfo(true);
setupHeaders();

$controller = getController();
$action = getAction();
$param = getParam();

serve($controller, $action, $param);
