<?php

define('BASE_URL',          'http://03_t4_web2041.03_web2041-main.test/');
define('BASE_URL_ADMIN',          'http://03_t4_web2041.03_web2041-main.test/?mode=admin');

define('PATH_ROOT',         __DIR__ . '/../');


define('PATH_VIEW_ADMIN',         PATH_ROOT . 'views/admin/');
define('PATH_VIEW_CLIENT',         PATH_ROOT . 'views/client/');

define('PATH_VIEW_MAIN_ADMIN',    PATH_ROOT . 'views/admin/main.php');
define('PATH_VIEW_MAIN_CLIENT',    PATH_ROOT . 'views/client/main.php');

define('BASE_ASSETS_UPLOADS',   BASE_URL . 'assets/uploads/');

define('PATH_ASSETS_UPLOADS',   PATH_ROOT . 'assets/uploads/');

define('PATH_CONTROLLER_ADMIN',       PATH_ROOT . 'controllers/admin/');
define('PATH_CONTROLLER_CLIENT',       PATH_ROOT . 'controllers/client/');

define('PATH_MODEL',            PATH_ROOT . 'models/');

define('DB_HOST',     'localhost');
define('DB_PORT',     '3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME',     'hoangddph63542_web2041.03');
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);


// ── MOMO PAYMENT (Sandbox) ──────────────────────────────────────
define('MOMO_PARTNER_CODE', 'MOMO');                          // Sandbox partner code
define('MOMO_ACCESS_KEY',   'F8BBA842ECF85');                 // Sandbox access key
define('MOMO_SECRET_KEY',   'K951B6PE1waDMi640xX08PD3vg6EkVlz'); // Sandbox secret key
define('MOMO_ENDPOINT',     'https://test-payment.momo.vn/v2/gateway/api/create');
define('MOMO_RETURN_URL',   BASE_URL . '?action=momo-return');
define('MOMO_NOTIFY_URL',   BASE_URL . '?action=momo-notify');
