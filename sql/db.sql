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
    kapaciteta INT NOT NULL CHECK (kapaciteta > 0),
    seIzvaja BOOLEAN NOT NULL
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

INSERT INTO termin (naslov, zacetek, konec, dan, lokacija, kapaciteta, seIzvaja)
VALUES
    ('Košarka', '08:00:00', '09:30:00', 1, 'Telovadnica A', 20, TRUE),
    ('Tek', '09:00:00', '10:00:00', 2, 'Atletski stadion', 30, TRUE),
    ('Plavanje', '11:00:00', '12:30:00', 3, 'Bazenski kompleks', 25, TRUE),
    ('Nogomet', '14:00:00', '15:30:00', 4, 'Nogometno igrišče', 22, TRUE),
    ('Odbojka', '16:00:00', '17:30:00', 5, 'Telovadnica B', 18, TRUE),
    ('Tenis', '18:00:00', '19:30:00', 6, 'Tenis igrišče A', 10, FALSE),
    ('Košarka rekreacija', '20:00:00', '21:30:00', 0, 'Telovadnica C', 15, TRUE),
    ('Tek', '10:00:00', '11:00:00', 3, 'Stadion', 15, TRUE),
    ('Fitnes', '17:00:00', '18:00:00', 5, 'Fitnes center', 10, TRUE);




