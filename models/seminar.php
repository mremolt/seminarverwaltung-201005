<?php

    class Seminar
    {
        private $id = 0;
        private $titel = '';
        private $beschreibung = '';
        private $preis = 0.0;
        private $kategorie = '';

        private static $db = null;

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

        /* Getter und Setter */

        public function getId() {
            return $this->id;
        }

        public function getTitel() {
            return $this->titel;
        }

        public function setTitel($titel) {
            $this->titel = $titel;
        }

        public function getBeschreibung() {
            return $this->beschreibung;
        }

        public function setBeschreibung($beschreibung) {
            $this->beschreibung = $beschreibung;
        }

        public function getPreis() {
            return $this->preis;
        }

        public function setPreis($preis) {
            $this->preis = $preis;
        }

        public function getKategorie() {
            return $this->kategorie;
        }

        public function setKategorie($kategorie) {
            $this->kategorie = $kategorie;
        }

        public function getSeminartermine() {
            return Seminartermin::getBySeminarId($this->id);
        }

        public function __toString() {
            return $this->getTitel();
        }

        /* DB-Methoden */

        public function save() {
            if ( $this->getId() > 0 ) {
                $this->_update();
            } else {
                $this->_insert();
            }
        }

        public function delete() {
            $sql = 'DELETE FROM seminare WHERE id=?';
            $statement = self::$db->prepare($sql);
            $statement->execute( array($this->id) );
            $this->id = 0;
        }


        /* private Methoden */

        private function _insert() {
            $sql = 'INSERT INTO seminare (titel, beschreibung, preis, kategorie)
                        VALUES (:titel, :beschreibung, :preis, :kategorie)';
            $statement = self::$db->prepare($sql);
            
            $values = get_object_vars($this);
            unset($values['id']);
            $statement->execute($values);

            $this->id = self::$db->lastInsertId();
        }

        private function _update() {
            $sql = 'UPDATE seminare SET titel=:titel, beschreibung=:beschreibung,
                    preis=:preis, kategorie=:kategorie WHERE id=:id';
            $statement = self::$db->prepare($sql);
            $values = get_object_vars($this);
            $statement->execute($values);
        }

        /* statische Methoden */

        public static function connect(PDO $db) {
            self::$db = $db;
        }

        public static function getAll() {
            $sql = 'SELECT * FROM seminare ORDER BY titel';
            $statement = self::$db->query($sql);
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Seminar');
            return $statement->fetchAll();
        }

        public static function getById($id) {
            $sql = 'SELECT * FROM seminare WHERE id=?';
            $statement = self::$db->prepare($sql);
            $statement->execute( array($id) );
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Seminar');
            return $statement->fetch();
        }

        public static function getByKategorie($kategorie) {
            $sql = 'SELECT * FROM seminare WHERE kategorie=?';
            $statement = self::$db->prepare($sql);
            $statement->execute( array($kategorie) );
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Seminar');
            return $statement->fetchAll();
        }

    }

