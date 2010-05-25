CREATE TABLE seminare (id INTEGER PRIMARY KEY AUTO_INCREMENT, titel VARCHAR(120), beschreibung TEXT, preis DECIMAL (6,2));
CREATE TABLE benutzer (id INTEGER PRIMARY KEY AUTO_INCREMENT, vorname VARCHAR(40), name VARCHAR(40), email VARCHAR(50) UNIQUE, passwort VARCHAR(20), registriert_seit DATE);
ALTER TABLE benutzer ADD anrede VARCHAR(10);
ALTER TABLE seminare ADD kategorie VARCHAR(20);
ALTER TABLE seminare CHANGE titel titel VARCHAR(120) NOT NULL;
CREATE TABLE seminartermine (id INTEGER PRIMARY KEY AUTO_INCREMENT, beginn DATE, ende DATE, raum VARCHAR(30), seminar_id INTEGER);
CREATE TABLE nimmt_teil (benutzer_id INTEGER, seminartermin_id INTEGER, PRIMARY KEY (benutzer_id, seminartermin_id));

INSERT INTO benutzer (id, anrede, name, vorname, registriert_seit, email, passwort) VALUES (1, 'Herr', 'Reich', 'Frank', '2008-04-12', 'f.reich@example.com', 'kochtopf');
INSERT INTO benutzer (id, anrede, name, vorname, registriert_seit, email, passwort) VALUES (2, 'Frau', 'Huana', 'Marie', '2009-02-03', 'huana@example.com', 'reibekuche');
INSERT INTO benutzer (id, anrede, name, vorname, registriert_seit, email, passwort) VALUES (3, 'Herr', 'Meisenbär', 'Andreas', '2008-07-15', 'a.meisenbär@example.com', 'schüssel');
INSERT INTO benutzer (id, anrede, name, vorname, registriert_seit, email, passwort) VALUES (4, 'Herr', 'Uhr', 'Klaus', '2008-02-05', 'klaus@ur.org', 'bratpfanne');
INSERT INTO benutzer (id, anrede, name, vorname, registriert_seit, email, passwort) VALUES (5, 'Herr', 'Rosoft', 'Mike', '2009-11-11', 'sichtbar_grundlegend@kleinweich.com', 'teekessel');
INSERT INTO benutzer (id, anrede, name, vorname, registriert_seit, email, passwort) VALUES (6, 'Dr', 'Lödmann', 'Beatrice', '2006-09-09', 'beatrice@fraudoktor.de', 'kaffeemuehle');

INSERT INTO seminare (id, titel, beschreibung, preis, kategorie) VALUES (1, 'Relationale Datenbanken & MySQL', 'Nahezu alle modernen W...', 975.00, 'Datenbanken');
INSERT INTO seminare (id, titel, beschreibung, preis, kategorie) VALUES (2, 'Ruby on Rails', 'Ruby on Rails ist das neue, sensation...', 2500.00, 'Programmierung');
INSERT INTO seminare (id, titel, beschreibung, preis, kategorie) VALUES (3, 'Ajax & DOM-Scripting', 'Ajax ist längst dem Hype-Stadium ... JavaScript ist dabei ein essentieller Teil ...', 1699.99, 'Programmierung');
INSERT INTO seminare (id, titel, beschreibung, preis, kategorie) VALUES (4, 'Moderne JavaScript-Programmierung', '...gilt als DIE Programmiersprache für clientseitige Web...', 2500.00, 'Programmierung');
INSERT INTO seminare (id, titel, beschreibung, preis, kategorie) VALUES (5, 'Adobe Flash Professional (Grundlagen)',  'Adobe Flash bringt voll animierte, multimediale, interaktive Präsentationen und Anwendungen ...', 1500.00, 'Webdesign');
INSERT INTO seminare (id, titel, beschreibung, preis, kategorie) VALUES (6, 'Adobe Flash Professional (ActionScript)',  'Für anspruchsvolle Flash-Präsentationen und interaktive Anwendungen werden fundierte Kenntnisse in der Programmierung mit ActionScript ...', 1500.00, 'Programmierung');
INSERT INTO seminare (id, titel, beschreibung, preis, kategorie) VALUES (7, 'Digitale Bildbearbeitung mit Adobe Photoshop',  'In diesem Seminar lernen Sie die Grundlagen der digitalen Bildbearbeitung mit Adobe Photoshop ...', 1500.00, 'Webdesign');

INSERT INTO seminartermine (beginn, ende, raum, seminar_id) VALUES ('2005-06-20', '2005-06-25', 'Schulungsraum 1', 1);
INSERT INTO seminartermine (beginn, ende, raum, seminar_id) VALUES ('2005-11-07', '2005-11-12', 'Schulungsraum 2', 1);
INSERT INTO seminartermine (beginn, ende, raum, seminar_id) VALUES ('2006-03-20', '2006-03-25', 'Schulungsraum 1', 1);
INSERT INTO seminartermine (beginn, ende, raum, seminar_id) VALUES ('2006-12-04', '2006-12-09', 'Besprechungsraum', 1);
INSERT INTO seminartermine (beginn, ende, raum, seminar_id) VALUES ('2005-01-17', '2005-01-24', 'Schulungsraum 1', 4);
INSERT INTO seminartermine (beginn, ende, raum, seminar_id) VALUES ('2005-05-31', '2005-06-07', 'Aula', 4);
INSERT INTO seminartermine (beginn, ende, raum, seminar_id) VALUES ('2005-10-17', '2005-10-24', 'Schulungsraum 2', 4);

INSERT INTO nimmt_teil (benutzer_id, seminartermin_id) VALUES (1, 2);
INSERT INTO nimmt_teil (benutzer_id, seminartermin_id) VALUES (1, 1);
INSERT INTO nimmt_teil (benutzer_id, seminartermin_id) VALUES (2, 2);
INSERT INTO nimmt_teil (benutzer_id, seminartermin_id) VALUES (3, 2);
