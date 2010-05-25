<?php
    require_once 'lib/db_connect.inc.php';
    require_once 'models/seminar.php';
    require_once 'models/seminartermin.php';

    Seminar::connect($db);
    Seminartermin::connect($db);

    session_start();

    $action = $_REQUEST['action'];

    switch($action) {
        case 'list':
            $seminartermine = Seminartermin::getAll();
            break;

        case 'list_by_seminar':
            $seminar = Seminar::getById($_REQUEST['seminar_id']);
            $seminartermine = $seminar->getSeminartermine();
            break;

        default:
            header('Location: seminartermine.php?action=list');
            exit;
    }

    require_once 'views/seminartermine/' . $action . '.phtml';