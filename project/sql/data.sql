-- Vložení testovacích dat
INSERT INTO typ_zanr VALUES (1, 'Rock'), (2, 'Pop'), (3, 'Country'), (4, 'Blues'), (5, 'Jazz');
INSERT INTO typ_narodnost VALUES (1, 'USA'), (2, 'UK'), (3, 'Czech Republic'), (4, 'Germany'), (5, 'Spain');
INSERT INTO interpret VALUES (1, 'The Beatles', 2), (2, 'Queen', 2), (3, 'Karel Gott', 3), (4, 'BB King', 4), (5, 'Miles Davis', 1);
INSERT INTO album VALUES (1, 1, 'Abbey Road', '1969-09-26'),
(2, 2, 'A Night at the Opera', '1975-11-21'),
(3, 3, 'Karel Gott - Největší hity', '2000-01-01'),
(4, 4, 'BB King - Blues on Top of Blues', '1968-08-01'),
(5, 5, 'Miles Davis - Kind of Blue', '1959-08-17');

INSERT INTO skladba VALUES
(1, 'Bohemian Rhapsody', 355),
(2, 'Hey Jude', 431),
(3, 'Maja', 180),
(4, 'Heartbreaker', 250),
(5, 'So What', 550);

INSERT INTO album_interpret VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

INSERT INTO album_skladba VALUES
(1, 1, 1, 1),
(2, 2, 1, 2),
(3, 3, 3, 3),
(4, 4, 4, 4),
(5, 5, 5, 5);
