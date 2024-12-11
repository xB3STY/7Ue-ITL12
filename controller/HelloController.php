<?php

class HelloController
{
    public function index()
    {
        // Einfacher Text, der an die View weitergegeben wird
        $message = "Hello, World! Willkommen im Huge Framework.";

        // Die View laden und die Daten übergeben
        require APP . 'view/hello/index.php';
    }
}
