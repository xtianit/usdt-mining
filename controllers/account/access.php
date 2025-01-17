<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$key = getenv('KEY');
$key = $_ENV['KEY'];

$host = getenv('DBHOST');
$host = $_ENV['DBHOST'];

$user = getenv('DBUSER');
$user = $_ENV['DBUSER'];

$pass = getenv('DBPASS');
$pass = $_ENV['DBPASS'];

$database = getenv('DB');
$database = $_ENV['DB'];
