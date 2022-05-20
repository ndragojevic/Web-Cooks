DELIMITER ;

-- SQLINES DEMO *** tion -------------------------------------------------

-- Table Korisnici

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE `Korisnici`(
  `KorId` Integer NOT NULL,
  `Ime` Char(20 ) NOT NULL,
  `Prezime` Char(20 ) NOT NULL,
  `KorisnickoIme` Char(20 ) NOT NULL,
  `Lozinka` Varchar(1000 ) NOT NULL,
  `rola` Char(15 ) DEFAULT 'user' NOT NULL,
  `mejl` Char(50 ) NOT NULL
)
;

-- SQLINES DEMO *** e Korisnici

ALTER TABLE `Korisnici` ADD CONSTRAINT `PK_Korisnici` PRIMARY KEY (`KorId`);

ALTER TABLE `Korisnici` ADD CONSTRAINT `KorisnickoIme` UNIQUE (`KorisnickoIme`);

ALTER TABLE `Korisnici` ADD CONSTRAINT `mejl` UNIQUE (`mejl`)
;

-- Table Recepti

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE `Recepti`(
  `Naziv` Char(30 ) NOT NULL,
  `ReceptId` Char(10) NOT NULL,
  `Kategorija` Char(35 ) NOT NULL,
  `ZbirOcena` Integer DEFAULT  0 NOT NULL,
  `BrojOcena` Integer DEFAULT 0 NOT NULL,
  `SlikaJela` Longblob NOT NULL,
  `Postupak` Varchar(1000 ) NOT NULL,
  `VremeIzrade` Double DEFAULT 1 NOT NULL,
  `Datum` Datetime DEFAULT  NOW() NOT NULL,
  `KorId` Integer NOT NULL,
  `TezinaIzrade` Char(20 ) DEFAULT 'easy' NOT NULL
)
;

-- SQLINES DEMO *** r table Recepti

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE INDEX `IX_Korisnik stavlja recept` ON `Recepti` (`KorId`)
;

-- SQLINES DEMO *** e Recepti

ALTER TABLE `Recepti` ADD CONSTRAINT `PK_Recepti` PRIMARY KEY (`ReceptId`);

-- SQLINES DEMO *** ljeniRecepti

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE `KorisnikOmiljeniRecepti`(
  `KorId` Integer NOT NULL,
  `ReceotId` Char(10) NOT NULL,
  `OmiljeniId` Char(10) NOT NULL
)
;

-- SQLINES DEMO *** r table KorisnikOmiljeniRecepti

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE INDEX `IX_Relationship9` ON `KorisnikOmiljeniRecepti` (`KorId`)
;

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE INDEX `IX_Relationship10` ON `KorisnikOmiljeniRecepti` (`ReceotId`)
;

-- SQLINES DEMO *** e KorisnikOmiljeniRecepti

ALTER TABLE `KorisnikOmiljeniRecepti` ADD CONSTRAINT `PK_KorisnikOmiljeniRecepti` PRIMARY KEY (`OmiljeniId`)
;

-- Table Komentari

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE `Komentari`(
  `KorId` Integer NOT NULL,
  `ReceptId` Char(10) NOT NULL,
  `KomId` Char(10) NOT NULL,
  `Tekst` Char(150 ) DEFAULT "" NOT NULL
)
;

-- SQLINES DEMO *** r table Komentari

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE INDEX `IX_Relationship13` ON `Komentari` (`KorId`)
;

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE INDEX `IX_Relationship14` ON `Komentari` (`ReceptId`)
;

-- SQLINES DEMO *** e Komentari

ALTER TABLE `Komentari` ADD CONSTRAINT `PK_Komentari` PRIMARY KEY (`KomId`)
;

-- SQLINES DEMO *** risnik

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE `NamirniceKorisnik`(
  `KorId` Integer NOT NULL,
  `NamId` Char(10) NOT NULL,
  `Naziv` Char(20 ) NOT NULL,
  `Kolicina` Double DEFAULT  100 NOT NULL
)
;

-- SQLINES DEMO *** r table NamirniceKorisnik

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE INDEX `IX_Korisnik ima namirnice` ON `NamirniceKorisnik` (`KorId`)
;

-- SQLINES DEMO *** e NamirniceKorisnik

ALTER TABLE `NamirniceKorisnik` ADD CONSTRAINT `PK_NamirniceKorisnik` PRIMARY KEY (`NamId`)
;

ALTER TABLE `NamirniceKorisnik` ADD CONSTRAINT `Naziv` UNIQUE (`Naziv`)
;

-- SQLINES DEMO *** cepat

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE `NamirniceRecepat`(
  `NamId` Char(10) NOT NULL,
  `Naziv` Char(20 ) NOT NULL,
  `Kolicina` Double DEFAULT 100 NOT NULL,
  `ReceptId` Char(10)
)
;

-- SQLINES DEMO *** r table NamirniceRecepat

-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE INDEX `IX_Relationship18` ON `NamirniceRecepat` (`ReceptId`)
;

-- SQLINES DEMO *** e NamirniceRecepat

ALTER TABLE `NamirniceRecepat` ADD CONSTRAINT `PK_NamirniceRecepat` PRIMARY KEY (`NamId`)
;



-- SQLINES DEMO *** ys (relationships) section ------------------------------------------------- 

ALTER TABLE `Recepti` ADD CONSTRAINT `Korisnik stavlja recept` FOREIGN KEY (`KorId`) REFERENCES `Korisnici` (`KorId`)
;



ALTER TABLE `KorisnikOmiljeniRecepti` ADD CONSTRAINT `Korisnik ima omiljene recepte` FOREIGN KEY (`KorId`) REFERENCES `Korisnici` (`KorId`)
;



ALTER TABLE `KorisnikOmiljeniRecepti` ADD CONSTRAINT `recept je u listi omiljenih recepata korisnika` FOREIGN KEY (`ReceotId`) REFERENCES `Recepti` (`ReceptId`)
;



ALTER TABLE `Komentari` ADD CONSTRAINT `Korisnik ima komentar` FOREIGN KEY (`KorId`) REFERENCES `Korisnici` (`KorId`)
;



ALTER TABLE `Komentari` ADD CONSTRAINT `Korisnik ima komentar na recept` FOREIGN KEY (`ReceptId`) REFERENCES `Recepti` (`ReceptId`)
;



ALTER TABLE `NamirniceKorisnik` ADD CONSTRAINT `Korisnik ima namirnice` FOREIGN KEY (`KorId`) REFERENCES `Korisnici` (`KorId`);




ALTER TABLE `NamirniceRecepat` ADD CONSTRAINT `recept ima namirnice` FOREIGN KEY (`ReceptId`) REFERENCES `Recepti` (`ReceptId`);



-- SQLINES DEMO ***  section -------------------------------------------------


