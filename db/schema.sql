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
) ENGINE=InnoDB;

CREATE TABLE Ucebna (
    ucebna_ID INTEGER NOT NULL AUTO_INCREMENT,
    kridlo CHAR(1) NOT NULL,
    cislo_ucebne INTEGER NOT NULL,
    -- Constraints
    PRIMARY KEY (ucebna_ID),
    UNIQUE (kridlo,cislo_ucebne)
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;
INSERT INTO Uzivatel (login, heslo, meno, priezvisko, mail, tel_cislo, prava) VALUES ('admin', 'admin', 'Pán', 'Admin', 'xmilko01@stud.fit.vutbr.cz', '123456789', 2);

CREATE TABLE Rocnik (
    rocnik_ID INTEGER NOT NULL AUTO_INCREMENT,
    nazov VARCHAR(30) NOT NULL,
    zaciatok_stud CHAR(9) NOT NULL,
    -- Constraints
    PRIMARY KEY (rocnik_ID)
) ENGINE=InnoDB;

CREATE TABLE Predmet (
    predmet_ID INTEGER NOT NULL AUTO_INCREMENT,
    garant_ID INTEGER NOT NULL,
    kredity INTEGER  NOT NULL,
    rocnik_ID INTEGER,
    nazov_predmetu VARCHAR(20) NOT NULL,
    -- Constraints
    PRIMARY KEY (predmet_ID),
    FOREIGN KEY (rocnik_ID) REFERENCES Rocnik(rocnik_ID),
    FOREIGN KEY (garant_ID) REFERENCES Uzivatel(uzivatel_ID)
) ENGINE=InnoDB;

CREATE TABLE Akcia (
    akcia_ID INTEGER NOT NULL AUTO_INCREMENT,
    nazov VARCHAR(30) NOT NULL,
    datum_rezervacie DATE NOT NULL,
    zaznam CHAR(1) DEFAULT 0,
    stream CHAR(1) DEFAULT 0,
    trvanie INTEGER NOT NULL,
    datum_konania DATE NOT NULL,
    predmet_ID INTEGER,
    uzivatel_ID INTEGER NOT NULL,
    -- Constraints
    PRIMARY KEY (akcia_ID),
    FOREIGN KEY (predmet_ID) REFERENCES Predmet(predmet_ID) ON DELETE CASCADE,
    FOREIGN KEY (uzivatel_ID) REFERENCES Uzivatel(uzivatel_ID) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE Obor (
    obor_ID INTEGER NOT NULL AUTO_INCREMENT,
    nazov VARCHAR(30) NOT NULL,
    titul CHAR(4),
    -- Constraints
    PRIMARY KEY (obor_ID)
) ENGINE=InnoDB;

CREATE TABLE Konanie_akcie (
    ucebna_ID INTEGER NOT NULL,
    akcia_ID INTEGER NOT NULL,
    premietanie TINYINT(1) DEFAULT 0,
    -- Constraints
    PRIMARY KEY (ucebna_ID,akcia_ID),
    FOREIGN KEY (ucebna_ID) REFERENCES Ucebna(ucebna_ID) ON DELETE CASCADE,
    FOREIGN KEY (akcia_ID) REFERENCES Akcia(akcia_ID) ON DELETE CASCADE
);

CREATE TABLE Predmet_obor (
    predmet_ID INTEGER NOT NULL,
    obor_ID INTEGER NOT NULL,
    -- Constraints
    PRIMARY KEY (predmet_ID,obor_ID),
    FOREIGN KEY (predmet_ID) REFERENCES Predmet(predmet_ID) ON DELETE CASCADE,
    FOREIGN KEY (obor_ID) REFERENCES Obor(obor_ID) ON DELETE CASCADE
) ENGINE=InnoDB;

