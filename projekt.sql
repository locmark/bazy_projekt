-- TABLES
CREATE TABLE Akademiki (
    id serial   NOT NULL PRIMARY KEY,
    nazwa varchar(20)   NOT NULL,
    adres varchar(50)   NOT NULL
);

CREATE TABLE Pokoje (
    id serial   NOT NULL PRIMARY KEY,
    nazwa varchar(20)   NOT NULL,
    pojemnosc int   NOT NULL,
    id_akademika int   NOT NULL
);

CREATE TABLE Studenci (
    id serial   NOT NULL PRIMARY KEY,
    imie varchar(20)   NOT NULL,
    nazwisko varchar(20)   NOT NULL,
    rok_studiow int,
    id_pokoju int
);

CREATE TABLE Komputery (
    host varchar(20)   NOT NULL PRIMARY KEY,
    IP varchar(20)   NOT NULL,
    MAC varchar(20)   NOT NULL,
    id_studenta int,
    data_dodania timestamp   NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Komputery_archiwum (
    id serial   NOT NULL PRIMARY KEY,
    host varchar(20)   NOT NULL,
    IP varchar(20)   NOT NULL,
    MAC varchar(20)   NOT NULL,
    id_studenta int,
    data_dodania timestamp   NOT NULL,
    data_archiwizacji timestamp   NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Pracownicy_akademika (
    id_akademika int   NOT NULL,
    id_pracownika int   NOT NULL,
    PRIMARY KEY (id_akademika, id_pracownika),
    UNIQUE (id_akademika, id_pracownika)
);

CREATE TABLE Pracownicy (
    id serial   NOT NULL PRIMARY KEY,
    imie varchar(20)   NOT NULL,
    nazwisko varchar(20)   NOT NULL,
    id_zawodu int
);

CREATE TABLE Zawody (
    id serial   NOT NULL PRIMARY KEY,
    nazwa varchar(50)   NOT NULL
);

-- RELATIONS
ALTER TABLE Pokoje ADD CONSTRAINT fk_Pokoje_id_akademika FOREIGN KEY(id_akademika)
REFERENCES Akademiki (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE Studenci ADD CONSTRAINT fk_Studenci_id_pokoju FOREIGN KEY(id_pokoju)
REFERENCES Pokoje (id) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Komputery ADD CONSTRAINT fk_Komputery_id_studenta FOREIGN KEY(id_studenta)
REFERENCES Studenci (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE Komputery_archiwum ADD CONSTRAINT fk_Komputery_archiwum_id_studenta FOREIGN KEY(id_studenta)
REFERENCES Studenci (id) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE Pracownicy_akademika ADD CONSTRAINT fk_Pracownicy_akademika_id_akademika FOREIGN KEY(id_akademika)
REFERENCES Akademiki (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE Pracownicy_akademika ADD CONSTRAINT fk_Pracownicy_akademika_id_pracownika FOREIGN KEY(id_pracownika)
REFERENCES Pracownicy (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE Pracownicy ADD CONSTRAINT fk_Pracownicy_id_zawodu FOREIGN KEY(id_zawodu)
REFERENCES Zawody (id) ON DELETE SET NULL ON UPDATE CASCADE;

-- FUNCTIONS
CREATE OR REPLACE FUNCTION archiwizacja_komputera_UPDATE() RETURNS TRIGGER
LANGUAGE 'plpgsql'
AS '
 BEGIN
    INSERT INTO Komputery_archiwum(host, IP, MAC, id_studenta, data_dodania) VALUES (OLD.host, OLD.IP, OLD.MAC, OLD.id_studenta, OLD.data_dodania);
    RETURN NEW;
 END;
';

CREATE OR REPLACE FUNCTION archiwizacja_komputera_DELETE() RETURNS TRIGGER
LANGUAGE 'plpgsql'
AS '
 BEGIN
    INSERT INTO Komputery_archiwum(host, IP, MAC, id_studenta, data_dodania) VALUES (OLD.host, OLD.IP, OLD.MAC, OLD.id_studenta, OLD.data_dodania);
    RETURN OLD;
 END;
';

CREATE OR REPLACE FUNCTION usuniecie_studenta_DELETE() RETURNS TRIGGER
LANGUAGE 'plpgsql'
AS '
 BEGIN
    UPDATE Komputery SET id_studenta = NULL WHERE id_studenta = OLD.id;
    UPDATE Komputery_archiwum SET id_studenta = NULL WHERE id_studenta = OLD.id;
    RETURN OLD;
 END;
';

-- TRIGGERS
CREATE TRIGGER archiwizacja_komputera_UPDATE_TRIGGER BEFORE UPDATE ON Komputery FOR EACH ROW
EXECUTE PROCEDURE archiwizacja_komputera_UPDATE();

CREATE TRIGGER archiwizacja_komputera_DELETE_TRIGGER BEFORE DELETE ON Komputery FOR EACH ROW
EXECUTE PROCEDURE archiwizacja_komputera_DELETE();

CREATE TRIGGER usuniecie_studenta_DELETE_TRIGGER BEFORE DELETE ON Studenci FOR EACH ROW
EXECUTE PROCEDURE usuniecie_studenta_DELETE();

-- VIEWS
CREATE VIEW Studenci_pokoje_akademiki AS
SELECT 
s.id,
s.imie,
s.nazwisko,
s.rok_studiow,
p.nazwa AS pokoj,
a.nazwa AS akademik
FROM
Studenci s,
Pokoje p,
Akademiki a
WHERE
s.id_pokoju = p.id AND p.id_akademika = a.id
;

-- USER
ALTER USER k WITH ENCRYPTED PASSWORD 'FL0OcRi6sARX4GawH4fB';