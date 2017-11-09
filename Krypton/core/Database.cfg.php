<?php
namespace Krypton\core;

ob_start();
define(__NAMESPACE__ . '\host', 'localhost');
define(__NAMESPACE__ . '\database', 'krypton');
define(__NAMESPACE__ . '\user', 'root');
define(__NAMESPACE__ . '\password', '');
define(__NAMESPACE__ . '\port', '');
ob_end_clean();
