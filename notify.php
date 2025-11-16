<?php
session_start();
$_SESSION['security_alert'] = "⚠️ Someone is attempting to enter your home!";
echo "OK";
?>