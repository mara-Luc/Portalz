<?php
if (isset($_POST['toggle'])) {
    shell_exec("gpio toggle 23");
    echo getLEDStatus(23);
} elseif (isset($_POST['status'])) {
    echo getLEDStatus(23);
}

function getLEDStatus($pin) {
    $state = shell_exec("gpio read $pin");
    return ($state == 1) ? "LED is On" : "LED is Off";
}
?>


