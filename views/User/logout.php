<?php
// views/User/logout.php

use app\Helpers\SessionManager;

SessionManager::logout();

// Redirect naar de loginpagina met succesbericht
header("Location: /ordering-pizza/user/login?message=Je+bent+succesvol+uitgelogd.");
exit;
