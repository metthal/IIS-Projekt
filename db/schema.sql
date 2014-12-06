USE xmilko01;

DROP TABLE IF EXISTS Konanie_akcie;
DROP TABLE IF EXISTS Predmet_obor;
DROP TABLE IF EXISTS Prislusenstvo;
DROP TABLE IF EXISTS Ucebna;
DROP TABLE IF EXISTS Typ_prislusenstva;
DROP TABLE IF EXISTS Akcia;
DROP TABLE IF EXISTS Predmet;
DROP TABLE IF EXISTS Uzivatel;
DROP TABLE IF EXISTS Rocnik;
DROP TABLE IF EXISTS Obor;

CREATE TABLE Typ_prislusenstva (
    typ_prislusenstva_ID INTEGER NOT NULL AUTO_INCREMENT,
    nazov_typu VARCHAR(30) NOT NULL,
    -- Constraints
    PRIMARY KEY (typ_prislusenstva_ID),
    UNIQUE (nazov_typu)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE Ucebna (
    ucebna_ID INTEGER NOT NULL AUTO_INCREMENT,
    kridlo CHAR(1) NOT NULL,
    cislo_ucebne INTEGER NOT NULL,
    kapacita INTEGER NOT NULL,
    -- Constraints
    PRIMARY KEY (ucebna_ID),
    UNIQUE (kridlo,cislo_ucebne)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE Prislusenstvo (
    prislusenstvo_ID INTEGER NOT NULL AUTO_INCREMENT,
    seriove_cislo VARCHAR(30),
    typ_ID INTEGER NOT NULL,
    ucebna_ID INTEGER,
    -- Constraints
    PRIMARY KEY (prislusenstvo_ID),
    FOREIGN KEY (typ_ID) REFERENCES Typ_prislusenstva(typ_prislusenstva_ID) ON DELETE CASCADE,
    FOREIGN KEY (ucebna_ID) REFERENCES Ucebna(ucebna_ID) ON DELETE CASCADE,
    UNIQUE (typ_ID,seriove_cislo)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE Uzivatel (
    uzivatel_ID INTEGER NOT NULL AUTO_INCREMENT,
    login VARCHAR(15) NOT NULL,
    heslo CHAR(32) NOT NULL,
    meno VARCHAR(15),
    priezvisko VARCHAR(20),
    mail VARCHAR(40) NOT NULL,
    tel_cislo VARCHAR(20),
    prava INTEGER DEFAULT 0 NOT NULL,
    -- Constraints
    PRIMARY KEY (uzivatel_ID),
    UNIQUE (login),
    UNIQUE (mail)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
INSERT INTO Uzivatel (login, heslo, meno, priezvisko, mail, tel_cislo, prava) VALUES ('admin', 'admin', 'Pán', 'Admin', 'xmilko01@stud.fit.vutbr.cz', '123456789', 2);
INSERT INTO Uzivatel (login, heslo, meno, priezvisko, mail, tel_cislo, prava) VALUES ('prof', 'prof', 'Pán', 'Profesor', 'xvrabe07@stud.fit.vutbr.cz', '123456789', 1);
INSERT INTO Uzivatel (login, heslo, meno, priezvisko, mail, tel_cislo, prava) VALUES ('student', 'student', 'Pán', 'Student', 'milkovic.marek@gmail.com', '123456789', 0);

CREATE TABLE Obor (
    obor_ID INTEGER NOT NULL AUTO_INCREMENT,
    nazov VARCHAR(30) NOT NULL,
    titul CHAR(4),
    -- Constraints
    PRIMARY KEY (obor_ID)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE Rocnik (
    rocnik_ID INTEGER NOT NULL AUTO_INCREMENT,
    obor_ID INTEGER NOT NULL,
    nazov VARCHAR(30) NOT NULL,
    zaciatok_stud CHAR(9) NOT NULL,
    -- Constraints
    PRIMARY KEY (rocnik_ID),
    FOREIGN KEY (obor_ID) REFERENCES Obor(obor_ID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE Predmet (
    predmet_ID INTEGER NOT NULL AUTO_INCREMENT,
    garant_ID INTEGER NOT NULL,
    kredity INTEGER  NOT NULL,
    rocnik_ID INTEGER,
    nazov_predmetu VARCHAR(20) NOT NULL,
    -- Constraints
    PRIMARY KEY (predmet_ID),
    FOREIGN KEY (rocnik_ID) REFERENCES Rocnik(rocnik_ID) ON DELETE CASCADE,
    FOREIGN KEY (garant_ID) REFERENCES Uzivatel(uzivatel_ID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE Akcia (
    akcia_ID INTEGER NOT NULL AUTO_INCREMENT,
    nazov VARCHAR(30) NOT NULL,
    datum_rezervacie TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    zaznam CHAR(1) DEFAULT 0,
    stream CHAR(1) DEFAULT 0,
    trvanie INTEGER NOT NULL,
    datum_konania TIMESTAMP NOT NULL,
    predmet_ID INTEGER NOT NULL,
    uzivatel_ID INTEGER NOT NULL,
    -- Constraints
    PRIMARY KEY (akcia_ID),
    FOREIGN KEY (predmet_ID) REFERENCES Predmet(predmet_ID) ON DELETE CASCADE,
    FOREIGN KEY (uzivatel_ID) REFERENCES Uzivatel(uzivatel_ID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE Konanie_akcie (
    ucebna_ID INTEGER NOT NULL,
    akcia_ID INTEGER NOT NULL,
    premietanie TINYINT(1) DEFAULT 0,
    -- Constraints
    PRIMARY KEY (ucebna_ID,akcia_ID),
    FOREIGN KEY (ucebna_ID) REFERENCES Ucebna(ucebna_ID) ON DELETE CASCADE,
    FOREIGN KEY (akcia_ID) REFERENCES Akcia(akcia_ID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE Predmet_obor (
    predmet_ID INTEGER NOT NULL,
    obor_ID INTEGER NOT NULL,
    -- Constraints
    PRIMARY KEY (predmet_ID,obor_ID),
    FOREIGN KEY (predmet_ID) REFERENCES Predmet(predmet_ID) ON DELETE CASCADE,
    FOREIGN KEY (obor_ID) REFERENCES Obor(obor_ID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

INSERT INTO Typ_prislusenstva (nazov_typu) VALUES ('Projektor');
INSERT INTO Typ_prislusenstva (nazov_typu) VALUES ('Tabuľa');
INSERT INTO Typ_prislusenstva (nazov_typu) VALUES ('Počítač');

INSERT INTO Ucebna (kridlo, cislo_ucebne, kapacita) VALUES ('A','230','80');
INSERT INTO Ucebna (kridlo, cislo_ucebne, kapacita) VALUES ('C','123','220');
INSERT INTO Ucebna (kridlo, cislo_ucebne, kapacita) VALUES ('B','105','150');

INSERT INTO Prislusenstvo (seriove_cislo, typ_ID, ucebna_ID) VALUES ('12454523465','1','1');
INSERT INTO Prislusenstvo (seriove_cislo, typ_ID, ucebna_ID) VALUES ('23454322223','2','2');
INSERT INTO Prislusenstvo (seriove_cislo, typ_ID, ucebna_ID) VALUES ('43565923494','3','1');

INSERT INTO Obor (nazov, titul) VALUES ('Programovanie','bc.');
INSERT INTO Obor (nazov, titul) VALUES('Siete','bc.');

INSERT INTO Rocnik (obor_ID, nazov, zaciatok_stud) VALUES ('1','bc1','2014/2015');
INSERT INTO Rocnik (obor_ID, nazov, zaciatok_stud) VALUES ('1','bc2','2014/2015');
INSERT INTO Rocnik (obor_ID, nazov, zaciatok_stud) VALUES ('1','bc3','2014/2015');

INSERT INTO Predmet (garant_ID, kredity, rocnik_ID, nazov_predmetu) VALUES ('2','6','1','Programovanie 1');
INSERT INTO Predmet (garant_ID, kredity, rocnik_ID, nazov_predmetu) VALUES ('2','5','2','Programovanie 2');
INSERT INTO Predmet (garant_ID, kredity, rocnik_ID, nazov_predmetu) VALUES ('2','5','3','Informacné systémy');
INSERT INTO Predmet (garant_ID, kredity, rocnik_ID, nazov_predmetu) VALUES ('2','5','3','Siete 1');

INSERT INTO Akcia (nazov, datum_rezervacie, zaznam, stream, trvanie, datum_konania, predmet_ID, uzivatel_ID) VALUES('Programovanie 1',STR_TO_DATE('01,01,2015,08,00', '%d,%m,%Y,%h,%i'),'1','1','2',STR_TO_DATE('03,01,2015,7,00', '%d,%m,%Y,%h,%i'),'1','2');
INSERT INTO Akcia (nazov, datum_rezervacie, zaznam, stream, trvanie, datum_konania, predmet_ID, uzivatel_ID) VALUES ('Programovanie 2',STR_TO_DATE('01,01,2015,08,15', '%d,%m,%Y,%h,%i'),'0','0','4',STR_TO_DATE('06,01,2015,08,00', '%d,%m,%Y,%h,%i'),'2','2');
INSERT INTO Akcia (nazov, datum_rezervacie, zaznam, stream, trvanie, datum_konania, predmet_ID, uzivatel_ID) VALUES('Informačné systémy',STR_TO_DATE('01,01,2015,09,00', '%d,%m,%Y,%h,%i'),'1','1','1',STR_TO_DATE('04,01,2015,8,00', '%d,%m,%Y,%h,%i'),'3','2');
INSERT INTO Akcia (nazov, datum_rezervacie, zaznam, stream, trvanie, datum_konania, predmet_ID, uzivatel_ID) VALUES('Siete 1',STR_TO_DATE('01,01,2015,09,21', '%d,%m,%Y,%h,%i'),'0','0','3',STR_TO_DATE('06,01,2015,7,00', '%d,%m,%Y,%h,%i'),'4','2');

INSERT INTO Predmet_obor (predmet_ID, obor_ID) VALUES('1','1');
INSERT INTO Predmet_obor (predmet_ID, obor_ID) VALUES('2','1');
INSERT INTO Predmet_obor (predmet_ID, obor_ID) VALUES('3','2');
INSERT INTO Predmet_obor (predmet_ID, obor_ID) VALUES('4','2');

INSERT INTO Konanie_akcie (ucebna_ID, akcia_ID, premietanie) VALUES('1','1','0');
INSERT INTO Konanie_akcie (ucebna_ID, akcia_ID, premietanie) VALUES('2','2','1');
INSERT INTO Konanie_akcie (ucebna_ID, akcia_ID, premietanie) VALUES('1','3','0');
INSERT INTO Konanie_akcie (ucebna_ID, akcia_ID, premietanie) VALUES('1','4','1');
