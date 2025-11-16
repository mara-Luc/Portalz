<?php
session_start();
if (isset($_SESSION['security_alert'])) {
    echo $_SESSION['security_alert'];
    unset($_SESSION['security_alert']);
}
?>