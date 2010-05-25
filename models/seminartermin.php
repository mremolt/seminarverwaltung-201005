<?php

    class Seminartermin {
        private $id = 0;
        private $seminar_id = 0;
        private $beginn = '';
        private $ende = '';
        private $raum = '';

        private static $db = NULL;

        public function __construct(array $daten = array()) {
            if ($daten) {
                foreach ($daten as $key => $value) {
                    $methodenName = 'set' . ucfirst($key);
                    if ( method_exists($this, $methodenName) ) {
                        $this->$methodenName($value);
                    } else {
                        echo "<span style='color: red;'>Der Setter '$methodenName' existiert nicht!</span>";
                    }
                }
            }
        }

        public function getId() {
            return $this->id;
        }

        public function getSeminar_id() {
            return $this->seminar_id;
        }

        public function setSeminar_id($seminar_id) {
            $this->seminar_id = $seminar_id;
        }

        public function getBeginn() {
            return $this->beginn;
        }

        public function setBeginn($beginn) {
            $this->beginn = $beginn;
        }

        public function getEnde() {
            return $this->ende;
        }

        public function setEnde($ende) {
            $this->ende = $ende;
        }

        public function getRaum() {
            return $this->raum;
        }

        public function setRaum($raum) {
            $this->raum = $raum;
        }

        public function getSeminar() {
            return Seminar::getById($this->seminar_id);
        }

        public function setSeminar(Seminar $seminar) {
            $this->seminar_id = $seminar->getId();
        }

        public function __toString() {
            return $this->getSeminar() . ': ' . $this->getBeginn();
        }

        public function save() {
            if($this->id > 0) {
                $this->_update();
            } else {
                $this->_insert();
            }
        }

        public function delete() {
            $sql = 'DELETE FROM seminartermine WHERE id=?';
            $statement = self::$db->prepare($sql);
            $statement->execute(array($this->id));
            $this->id = 0;
        }

        private function  _insert() {
            $sql = 'INSERT INTO seminartermine (seminar_id, beginn, ende, raum)
                        VALUES (:seminar_id, :beginn, :ende, :raum)';
            $statement = self::$db->prepare($sql);
            $values = get_object_vars($this);
            unset($values['id']);
            $statement->execute($values);

            $this->id = self::$db->lastInsertId();
        }

        private function _update() {
            $sql = 'UPDATE seminartermine SET seminar_id=:seminar_id, 
                        beginn=:beginn,
                        ende=:ende,
                        raum=:raum
                    WHERE id=:id';
            $statement = self::$db->prepare($sql);
            $values = get_object_vars($this);
            $statement->execute($values);
        }

        public static function connect(PDO $db) {
            self::$db =$db;
        }

        public static function getAll() {
            $sql = 'SELECT * FROM seminartermine ORDER BY seminar_id';
            $statement = self::$db->query($sql);
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Seminartermin');
            return $statement->fetchAll();
        }

        public static function getById($id) {
            $sql = 'SELECT * FROM seminartermine WHERE id=?';
            $statement = self::$db->prepare($sql);
            $statement->execute(array($id));
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Seminartermin');
            return $statement->fetch();
        }

        public static function getByBeginn($beginn) {
            $sql = 'SELECT * FROM seminartermine WHERE beginn=?';
            $statement = self::$db->prepare($sql);
            $statement->execute(array($beginn));
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Seminartermin');
            return $statement->fetchAll();
        }

        public static function getBySeminarId($seminar_id)
        {
            $sql = 'SELECT * FROM seminartermine WHERE seminar_id=?';
            $statement = self::$db->prepare($sql);
            $statement->execute(array($seminar_id));
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Seminartermin');
            return $statement->fetchAll();
        }
    }