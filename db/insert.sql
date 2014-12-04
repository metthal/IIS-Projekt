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

