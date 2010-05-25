<?php
    $optionen = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $db = new PDO(
        'mysql:host=localhost;dbname=seminarverwaltung',
        'root', '', $optionen);
    $db->query('SET NAMES utf8');