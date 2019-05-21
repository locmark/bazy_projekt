
CREATE TABLE "Akademiki" (
    "id" serial   NOT NULL PRIMARY KEY,
    "nazwa" varchar(20)   NOT NULL,
    "adres" varchar(50)   NOT NULL
);

CREATE TABLE "Pokoje" (
    "id" serial   NOT NULL PRIMARY KEY,
    "nazwa" varchar(20)   NOT NULL,
    "pojemnosc" int   NOT NULL,
    "id_akademika" int   NOT NULL
);

CREATE TABLE "Studenci" (
    "id" serial   NOT NULL PRIMARY KEY,
    "imie" varchar(20)   NOT NULL,
    "nazwisko" varchar(20)   NOT NULL,
    "rok_stodiow" int,
    "id_pokoju" int   NOT NULL
);

CREATE TABLE "Komputery" (
    "host" varchar(20)   NOT NULL PRIMARY KEY,
    "IP" varchar(20)   NOT NULL,
    "MAC" varchar(20)   NOT NULL,
    "id_studenta" int   NOT NULL,
    "data_dodania" timestamp   NOT NULL
);

CREATE TABLE "Komputery_archiwum" (
    "id" serial   NOT NULL PRIMARY KEY,
    "host" varchar(20)   NOT NULL,
    "IP" varchar(20)   NOT NULL,
    "MAC" varchar(20)   NOT NULL,
    "id_studenta" int   NOT NULL,
    "data_dodania" timestamp   NOT NULL,
    "data_archiwizacji" timestamp   NOT NULL
);

CREATE TABLE "Pracownicy_akademika" (
    "id_akademika" int   NOT NULL,
    "id_pracownika" int   NOT NULL,
    PRIMARY KEY (id_akademika, id_pracownika),
    UNIQUE (id_akademika, id_pracownika)
);

CREATE TABLE "Pracownicy" (
    "id" serial   NOT NULL PRIMARY KEY,
    "imie" varchar(20)   NOT NULL,
    "nazwisko" varchar(20)   NOT NULL,
    "id_zawodu" int   NOT NULL
);

CREATE TABLE "Zawody" (
    "id" serial   NOT NULL PRIMARY KEY,
    "nazwa" varchar(20)   NOT NULL
);

ALTER TABLE "Pokoje" ADD CONSTRAINT "fk_Pokoje_id_akademika" FOREIGN KEY("id_akademika")
REFERENCES "Akademiki" ("id");

ALTER TABLE "Studenci" ADD CONSTRAINT "fk_Studenci_id_pokoju" FOREIGN KEY("id_pokoju")
REFERENCES "Pokoje" ("id");

ALTER TABLE "Komputery" ADD CONSTRAINT "fk_Komputery_id_studenta" FOREIGN KEY("id_studenta")
REFERENCES "Studenci" ("id");

ALTER TABLE "Komputery_archiwum" ADD CONSTRAINT "fk_Komputery_archiwum_id_studenta" FOREIGN KEY("id_studenta")
REFERENCES "Studenci" ("id");

ALTER TABLE "Pracownicy_akademika" ADD CONSTRAINT "fk_Pracownicy_akademika_id_akademika" FOREIGN KEY("id_akademika")
REFERENCES "Akademiki" ("id");

ALTER TABLE "Pracownicy_akademika" ADD CONSTRAINT "fk_Pracownicy_akademika_id_pracownika" FOREIGN KEY("id_pracownika")
REFERENCES "Pracownicy" ("id");

ALTER TABLE "Pracownicy" ADD CONSTRAINT "fk_Pracownicy_id_zawodu" FOREIGN KEY("id_zawodu")
REFERENCES "Zawody" ("id");

