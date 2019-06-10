INSERT INTO Akademiki(nazwa, adres) VALUES 
('DS1', 'Traugutta 115, Gdansk-Wrzeszcz 80-226'),
('DS2', 'Traugutta 115b, Gdansk-Wrzeszcz 80-226'),
('DS3', 'Do Studzienki 32, Gdansk-Wrzeszcz 80-226');

INSERT INTO Pokoje(nazwa, pojemnosc, id_akademika) VALUES 
('101a', 1, 1),
('101b', 2, 1),
('102a', 1, 1),
('102b', 2, 1),
('103a', 1, 1),
('103b', 2, 1),
('104a', 1, 1),
('104b', 2, 1),
('105a', 1, 1),
('105b', 2, 1),

('201a', 2, 2),
('201b', 2, 2),
('202a', 2, 2),
('202b', 2, 2),
('203a', 2, 2),
('203b', 2, 2),
('204a', 2, 2),
('204b', 2, 2),
('205a', 2, 2),
('205b', 2, 2),

('301a', 1, 3),
('301b', 2, 3),
('302a', 1, 3),
('302b', 2, 3),
('303a', 1, 3),
('303b', 2, 3),
('304a', 1, 3),
('304b', 2, 3),
('305a', 1, 3),
('305b', 2, 3);

INSERT INTO Studenci(imie, nazwisko, rok_studiow, id_pokoju) VALUES 
('Roman', 'Sawicki', 3, 1),
('Marcin', 'Szymczak', 3, 1),
('Joanna', 'Baranowska', 3, 3),
('Maciej', 'Szczepański', 3, 4),
('Czesław', 'Wróbel', 3, 6),
('Grażyna', 'Górska', 3, 8),
('Wanda', 'Krawczyk', 3, 8),
('Renata', 'Urbańska', 3, 9),
('Wiesława', 'Tomaszewska', 3, 9),
('Bożena', 'Baranowska', 3, 10),
('Ewelina', 'Malinowska', 3, 10),
('Anna', 'Krajewska', 3, 11),
('Mieczysław', 'Zając', 3, 12),
('Wiesław', 'Przybylski', 3, 12),
('Dorota', 'Tomaszewska', 3, 13),
('Jerzy', 'Wróblewski', 3, 13),
('Magdalena', 'Adamczyk', 3, 14),
('Władysław', 'Piotrowski', 3, 15),
('Marek', 'Wiśniewski', 3, 15),
('Stanisława', 'Głowacka', 3, 16),
('Agata', 'Kubiak', 3, 17);

INSERT INTO Komputery
(
    host, 
    IP, 
    MAC, 
    id_studenta
) 
    SELECT 
        CONCAT(imie, nazwisko), 
        CAST(id AS varchar(20)), 
        CAST(id AS varchar(20)), 
        id 
    FROM Studenci
;