/*
Created: 4/8/2020
Modified: 4/7/2022
Project: Videorental Project
Model: Videorental
Company: Quest Software, Inc.
Author: Radim Mario Tkacik
Database: Oracle 19c
*/


-- Drop relationships section -------------------------------------------------

ALTER TABLE "NamirniceRecepat" DROP CONSTRAINT "recept ima namirnice"
/
ALTER TABLE "NamirniceKorisnik" DROP CONSTRAINT "Korisnik ima namirnice"
/
ALTER TABLE "Komentari" DROP CONSTRAINT "Korisnik ima komentar na recept"
/
ALTER TABLE "Komentari" DROP CONSTRAINT "Korisnik ima komentar"
/
ALTER TABLE "KorisnikOmiljeniRecepti" DROP CONSTRAINT "recept je u listi omiljenih recepata korisnika"
/
ALTER TABLE "KorisnikOmiljeniRecepti" DROP CONSTRAINT "Korisnik ima omiljene recepte"
/
ALTER TABLE "Recepti" DROP CONSTRAINT "Korisnik stavlja recept"
/




-- Drop keys for tables section -------------------------------------------------

ALTER TABLE "NamirniceRecepat" DROP CONSTRAINT "PK_NamirniceRecepat"
/
ALTER TABLE "NamirniceKorisnik" DROP CONSTRAINT "PK_NamirniceKorisnik"
/
ALTER TABLE "NamirniceKorisnik" DROP CONSTRAINT "Naziv"
/
ALTER TABLE "Komentari" DROP CONSTRAINT "PK_Komentari"
/
ALTER TABLE "KorisnikOmiljeniRecepti" DROP CONSTRAINT "PK_KorisnikOmiljeniRecepti"
/
ALTER TABLE "Recepti" DROP CONSTRAINT "PK_Recepti"
/
ALTER TABLE "Korisnici" DROP CONSTRAINT "PK_Korisnici"
/
ALTER TABLE "Korisnici" DROP CONSTRAINT "KorisnickoIme"
/
ALTER TABLE "Korisnici" DROP CONSTRAINT "mejl"
/


-- Drop indexes section -------------------------------------------------

DROP INDEX "IX_Relationship18"
/
DROP INDEX "IX_Korisnik ima namirnice"
/
DROP INDEX "IX_Relationship13"
/
DROP INDEX "IX_Relationship14"
/
DROP INDEX "IX_Relationship9"
/
DROP INDEX "IX_Relationship10"
/
DROP INDEX "IX_Korisnik stavlja recept"
/


-- Drop tables section ---------------------------------------------------

DROP TABLE "NamirniceRecepat"
/
DROP TABLE "NamirniceKorisnik"
/
DROP TABLE "Komentari"
/
DROP TABLE "KorisnikOmiljeniRecepti"
/
DROP TABLE "Recepti"
/
DROP TABLE "Korisnici"
/

-- Drop sequences section --------------------------------------------------- 

DROP SEQUENCE "SCOTT"."SeqExemplar"
/

-- Drop user data types section --------------------------------------------------- 

DROP TYPE "SCOTT"."Phone_List_Type"
/
DROP TYPE "SCOTT"."Cust_Address_Type"
/
DROP TYPE "SCOTT"."Price_Type"
/

-- Create user data types section -------------------------------------------------

CREATE TYPE "SCOTT"."Price_Type"
AS OBJECT (price NUMBER(10,2),  
    MEMBER FUNCTION total_price_VAT (vat number) RETURN NUMBER)
/
CREATE TYPE BODY "SCOTT"."Price_Type"
IS
    MEMBER FUNCTION total_price_VAT (vat NUMBER)
    RETURN NUMBER IS
    BEGIN
        RETURN (price*((vat+100)/100));
    END;
END;
/

CREATE TYPE "SCOTT"."Cust_Address_Type"
AS OBJECT
    ( street_address     VARCHAR2(40)
    , postal_code        VARCHAR2(10)
    , city               VARCHAR2(30)
    , state_province     VARCHAR2(10)
    , country_id         CHAR(2)
    , phone              Phone_List_Type
    )
/

CREATE TYPE "SCOTT"."Phone_List_Type"
AS VARRAY(5) OF VARCHAR2(25)
/

-- Create sequences section -------------------------------------------------

CREATE SEQUENCE "SCOTT"."SeqExemplar"
 INCREMENT BY 1
 START WITH 1
 NOMAXVALUE
 NOMINVALUE
 NOCACHE
/

-- Create tables section -------------------------------------------------

-- Table Korisnici

CREATE TABLE "Korisnici"(
  "KorId" Integer NOT NULL,
  "Ime" Char(20 ) NOT NULL,
  "Preziime" Char(20 ) NOT NULL,
  "KorisnickoIme" Char(20 ) NOT NULL,
  "Lozinka" Char(1000 ) NOT NULL,
  "rola" Char(15 ) DEFAULT user NOT NULL,
  "mejl" Char(50 ) NOT NULL
)
/

-- Add keys for table Korisnici

ALTER TABLE "Korisnici" ADD CONSTRAINT "PK_Korisnici" PRIMARY KEY ("KorId")
/

ALTER TABLE "Korisnici" ADD CONSTRAINT "KorisnickoIme" UNIQUE ("KorisnickoIme")
/

ALTER TABLE "Korisnici" ADD CONSTRAINT "mejl" UNIQUE ("mejl")
/

-- Table Recepti

CREATE TABLE "Recepti"(
  "Naziv" Char(30 ) NOT NULL,
  "ReceptId" Rowid NOT NULL,
  "Kategorija" Char(35 ) NOT NULL,
  "ZbirOcena" Integer DEFAULT ON NULL 0 NOT NULL,
  "BrojOcena" Integer DEFAULT ON NULL 0 NOT NULL,
  "SlikaJela" Blob NOT NULL,
  "Postupak" Char(1000 ) NOT NULL,
  "VremeIzrade" Float DEFAULT 1 NOT NULL,
  "Datum" Date DEFAULT ON NULL sysdate NOT NULL,
  "KorId" Integer NOT NULL,
  "TezinaIzrade" Char(20 ) DEFAULT ON NULL easy NOT NULL
)
/

-- Create indexes for table Recepti

CREATE INDEX "IX_Korisnik stavlja recept" ON "Recepti" ("KorId")
/

-- Add keys for table Recepti

ALTER TABLE "Recepti" ADD CONSTRAINT "PK_Recepti" PRIMARY KEY ("ReceptId")
/

-- Table KorisnikOmiljeniRecepti

CREATE TABLE "KorisnikOmiljeniRecepti"(
  "KorId" Integer NOT NULL,
  "ReceotId" Rowid NOT NULL,
  "OmiljeniId" Rowid NOT NULL
)
/

-- Create indexes for table KorisnikOmiljeniRecepti

CREATE INDEX "IX_Relationship9" ON "KorisnikOmiljeniRecepti" ("KorId")
/

CREATE INDEX "IX_Relationship10" ON "KorisnikOmiljeniRecepti" ("ReceotId")
/

-- Add keys for table KorisnikOmiljeniRecepti

ALTER TABLE "KorisnikOmiljeniRecepti" ADD CONSTRAINT "PK_KorisnikOmiljeniRecepti" PRIMARY KEY ("OmiljeniId")
/

-- Table Komentari

CREATE TABLE "Komentari"(
  "KorId" Integer NOT NULL,
  "ReceptId" Rowid NOT NULL,
  "KomId" Rowid NOT NULL,
  "Tekst" Char(150 ) DEFAULT "" NOT NULL
)
/

-- Create indexes for table Komentari

CREATE INDEX "IX_Relationship13" ON "Komentari" ("KorId")
/

CREATE INDEX "IX_Relationship14" ON "Komentari" ("ReceptId")
/

-- Add keys for table Komentari

ALTER TABLE "Komentari" ADD CONSTRAINT "PK_Komentari" PRIMARY KEY ("KomId")
/

-- Table NamirniceKorisnik

CREATE TABLE "NamirniceKorisnik"(
  "KorId" Integer NOT NULL,
  "NamId" Rowid NOT NULL,
  "Naziv" Char(20 ) NOT NULL,
  "Kolicina" Float DEFAULT ON NULL 100 NOT NULL
)
/

-- Create indexes for table NamirniceKorisnik

CREATE INDEX "IX_Korisnik ima namirnice" ON "NamirniceKorisnik" ("KorId")
/

-- Add keys for table NamirniceKorisnik

ALTER TABLE "NamirniceKorisnik" ADD CONSTRAINT "PK_NamirniceKorisnik" PRIMARY KEY ("NamId")
/

ALTER TABLE "NamirniceKorisnik" ADD CONSTRAINT "Naziv" UNIQUE ("Naziv")
/

-- Table NamirniceRecepat

CREATE TABLE "NamirniceRecepat"(
  "NamId" Rowid NOT NULL,
  "Naziv" Char(20 ) NOT NULL,
  "Kolicina" Float DEFAULT ON NULL 100 NOT NULL,
  "ReceptId" Rowid
)
/

-- Create indexes for table NamirniceRecepat

CREATE INDEX "IX_Relationship18" ON "NamirniceRecepat" ("ReceptId")
/

-- Add keys for table NamirniceRecepat

ALTER TABLE "NamirniceRecepat" ADD CONSTRAINT "PK_NamirniceRecepat" PRIMARY KEY ("NamId")
/


-- Create foreign keys (relationships) section ------------------------------------------------- 

ALTER TABLE "Recepti" ADD CONSTRAINT "Korisnik stavlja recept" FOREIGN KEY ("KorId") REFERENCES "Korisnici" ("KorId")
/



ALTER TABLE "KorisnikOmiljeniRecepti" ADD CONSTRAINT "Korisnik ima omiljene recepte" FOREIGN KEY ("KorId") REFERENCES "Korisnici" ("KorId")
/



ALTER TABLE "KorisnikOmiljeniRecepti" ADD CONSTRAINT "recept je u listi omiljenih recepata korisnika" FOREIGN KEY ("ReceotId") REFERENCES "Recepti" ("ReceptId")
/



ALTER TABLE "Komentari" ADD CONSTRAINT "Korisnik ima komentar" FOREIGN KEY ("KorId") REFERENCES "Korisnici" ("KorId")
/



ALTER TABLE "Komentari" ADD CONSTRAINT "Korisnik ima komentar na recept" FOREIGN KEY ("ReceptId") REFERENCES "Recepti" ("ReceptId")
/



ALTER TABLE "NamirniceKorisnik" ADD CONSTRAINT "Korisnik ima namirnice" FOREIGN KEY ("KorId") REFERENCES "Korisnici" ("KorId")
/



ALTER TABLE "NamirniceRecepat" ADD CONSTRAINT "recept ima namirnice" FOREIGN KEY ("ReceptId") REFERENCES "Recepti" ("ReceptId")
/




-- Grant permissions section -------------------------------------------------


