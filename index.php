<?php
    require_once 'models/seminar.php';
    require_once 'models/seminartermin.php';
    
    $optionen = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $db = new PDO(
        'mysql:host=localhost;dbname=seminarverwaltung',
        'root', '', $optionen);
    $db->query('SET NAMES utf8');
    
    Seminar::connect($db);
    Seminartermin::connect($db);


    $seminar = new Seminar(array(
            'titel' => 'Objektorientierte Programmierung mit PHP',
            'beschreibung' => 'äußerst spannend',
            'preis' => 5000.00,
            'kategorie' => 'programmierung',
    ));

    // Das soll Seminar können

    $seminar->save();

    $seminar->setPreis(3000.00);
    $seminar->save();


    $seminar1 = Seminar::getById(1);
    $termine = $seminar1->getSeminartermine();
    var_dump($seminar1);
    var_dump($termine);

    $termin = new Seminartermin();
    $termin->setBeginn('2010-05-22');
    $termin->setEnde('2010-05-28');
    $termin->setRaum('Cafeteria');


    $seminar1 = Seminar::getById(1);
    // !!!! nicht $seminar_id
    $termin->setSeminar($seminar1);

    $termin->save();







//    $seminartermin2 = Seminartermin::getById(2);
//    $seminar = $seminartermin2->getSeminar();
//    var_dump($seminartermin2);
//    var_dump($seminar);






//    $prog_seminare = Seminar::getByKategorie('programmierung');
//    foreach ($prog_seminare as $s) {
//        $s->delete();
//    }
//
//    $seminartermine = Seminartermin::getAll();
//    var_dump($seminartermine);

//
//    //$seminar->delete();
//
//    $seminare = Seminar::getAll();
//    //var_dump($seminare);
//
//    $seminar5 = Seminar::getById(5);
//    //$seminar5->save();
//
//
//    //var_dump($seminar5);
//    //echo $seminar5->getTitel();
//    //echo $seminar5->getPreis();
//
//
//    $prog_seminare = Seminar::getByKategorie('programmierung');
//    //var_dump($prog_seminare);
//
//
//
//


