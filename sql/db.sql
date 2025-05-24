drop database if exists dn3;
create database dn3;
use dn3;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- 2. Tabela TERMIN
CREATE TABLE termin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naslov VARCHAR(100) NOT NULL,
    zacetek TIME NOT NULL,
    konec TIME NOT NULL,
    dan TINYINT NOT NULL CHECK (dan BETWEEN 0 AND 6), -- 0 = nedelja, 6 = sobota
    lokacija VARCHAR(100) NOT NULL,
    kapaciteta INT NOT NULL CHECK (kapaciteta > 0)
);

-- 1. Tabela UPORABNIK
CREATE TABLE uporabnik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uporabnisko_ime VARCHAR(50) NOT NULL UNIQUE,
    ime VARCHAR(50) NOT NULL,
    priimek VARCHAR(50) NOT NULL,
    geslo VARCHAR(255) NOT NULL,
    tip_uporabnika ENUM('student', 'profesor', 'admin') NOT NULL,
    termin_id INT,
    FOREIGN KEY (termin_id) REFERENCES termin(id) ON DELETE CASCADE
);

-- 3. Tabela PRISOTNOST
CREATE TABLE prisotnost (
    uporabnik_id INT,
    termin_id INT,
    datum DATE NOT NULL,
    PRIMARY KEY (uporabnik_id, termin_id, datum),
    FOREIGN KEY (uporabnik_id) REFERENCES uporabnik(id) ON DELETE CASCADE,
    FOREIGN KEY (termin_id) REFERENCES termin(id) ON DELETE CASCADE
);

INSERT INTO termin (naslov, zacetek, konec, dan, lokacija, kapaciteta)
VALUES
    ('Košarka', '08:00:00', '09:30:00', 1, 'Telovadnica A', 20),
    ('Tek', '10:00:00', '11:00:00', 3, 'Stadion', 15),
    ('Fitnes', '17:00:00', '18:00:00', 5, 'Fitnes center', 10);


INSERT INTO uporabnik (uporabnisko_ime, ime, priimek, geslo, tip_uporabnika, termin_id)
VALUES
    ('pr', 'Profesor', 'Gazda', 'geslo0', 'profesor', NULL),
    ('a', 'Lenko', 'Fuks', 'geslo1', 'student', 1),
    ('b', 'Ana', 'Potočnik', 'geslo2', 'student', 2),
    ('c', 'Franci', 'meden', 'geslo3', 'student', 1);


INSERT INTO prisotnost (uporabnik_id, termin_id, datum)
VALUES
    (1, 1),  -- Lenko  Košarka
    (2, 1),  -- Ana  Košarka
    (1, 2);  -- Lenko  Tek
