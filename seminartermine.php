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

        case 'add':
            $seminare = Seminar::getAll();

            if ($_POST) {
                $seminartermin = new Seminartermin($_POST);
                $seminartermin->save();
                header('Location: seminartermine.php?action=list_by_seminar&seminar_id=' . $_POST['seminar_id']);
                exit;
            }
            break;

        case 'change':
            $seminare = Seminar::getAll();
            $seminartermin = Seminartermin::getById($_REQUEST['id']);

            if ($_POST) {
                $seminartermin->setBeginn($_POST['beginn']);
                $seminartermin->setEnde($_POST['ende']);
                $seminartermin->setRaum($_POST['raum']);
                $seminartermin->setSeminar_id($_POST['seminar_id']);
                $seminartermin->save();
                
                header('Location: seminartermine.php?action=list_by_seminar&seminar_id=' . $_POST['seminar_id']);
                exit;
            }
            break;

        case 'delete':
            $seminartermin = Seminartermin::getById($_REQUEST['id']);
            $seminartermin->delete();
            
            header('Location: seminartermine.php?action=list');
            exit;
            break;

        default:
            header('Location: seminartermine.php?action=list');
            exit;
    }

    require_once 'views/seminartermine/' . $action . '.phtml';