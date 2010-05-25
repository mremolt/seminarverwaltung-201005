<?php
    require_once 'lib/db_connect.inc.php';
    require_once 'models/seminar.php';
    require_once 'models/seminartermin.php';

    Seminar::connect($db);
    Seminartermin::connect($db);

    session_start();

    $title  = 'Tolle Seminarverwaltung';
    $action = $_REQUEST['action'];

    switch($action) {
        case 'list':
            $seminare = Seminar::getAll();
            break;

        case 'delete':
            $seminar = Seminar::getById($_REQUEST['id']);
            $seminar->delete();
            header('Location: seminare.php?action=list');
            exit;
            break;

        case 'add':
            if ($_POST) {
                $seminar = new Seminar($_POST);
                $seminar->save();
                header('Location: seminare.php?action=list');
                exit;
            }
            break;

        case 'change':
            $seminar = Seminar::getById($_REQUEST['id']);

            if ($_POST) {
                $seminar->setTitel($_POST['titel']);
                $seminar->setBeschreibung($_POST['beschreibung']);
                $seminar->setPreis($_POST['preis']);
                $seminar->setKategorie($_POST['kategorie']);
                $seminar->save();
                header('Location: seminare.php?action=list');
                exit;
            }
            break;

        default:
            header('Location: seminare.php?action=list');
            exit;
    }

    require_once 'views/seminare/' . $action . '.phtml';