<?php

$allowedDomain = 'ss.com'; // Replace with your domain

    if (isset($_SERVER['HTTP_REFERER'])) {
        $referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        $currentDomain = $_SERVER['HTTP_HOST'];

        // Compare the referer domain with your own domain
        if ($referer === $currentDomain || strpos($referer, '.' . $currentDomain) !== false) {
            // Process the POST request because the referrer matches your domain
            // Your code here...
        } else {
            // Referrer doesn't match your domain - deny POST request
            die("Access denied");
        }
    } else {
        // HTTP_REFERER is not set - deny POST request
        die("Access denied");
    }



    ?>