<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
    case '':
        include 'views/index.php';
        break;
    case '/contact':
        include 'views/contact.php';
        break;
    case '/about':
        include 'views/about.php';
        break;
    case '/adopt':
        include 'views/adopt.php';
        break;
    case '/admin/lead':
        include 'views/admin/lead.php';
        break;
    case '/admin/pet':
        include 'views/admin/pet.php';
        break;
    case '/admin/adoption':
        include 'views/admin/adoption.php';
        break;
    case '/admin/company':
        include 'views/admin/company.php';
        break;
    case '/admin/faq':
        include 'views/admin/faq.php';
        break;
    case '/admin/subscription':
        include 'views/admin/subscription.php';
        break;
    case '/admin/login':
        include 'views/admin/login.php';
        break;
    case '/admin/register':
        include 'views/admin/register.php';
        break;
    default:
        http_response_code(404);
        include 'views/404.php';
        break;
}
