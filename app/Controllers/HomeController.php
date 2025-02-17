<?php
// app/Controllers/HomeController.php

namespace app\Controllers;

class HomeController
{
    public function index(): void
    {
        require __DIR__ . '/../../views/Home/index.php';
    }
}
