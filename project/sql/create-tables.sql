-- Vytvoření tabulky typ_zanr
CREATE TABLE IF NOT EXISTS typ_zanr (
                                        id_typ_zanr INT PRIMARY KEY AUTO_INCREMENT,
                                        nazev VARCHAR(50) NOT NULL
);

-- Vytvoření tabulky typ_narodnost
CREATE TABLE IF NOT EXISTS typ_narodnost (
                                             id_typ_narodnost INT PRIMARY KEY AUTO_INCREMENT,
                                             nazev VARCHAR(50) NOT NULL
);

-- Vytvoření tabulky interpret
CREATE TABLE IF NOT EXISTS interpret (
                                         id_interpret INT PRIMARY KEY AUTO_INCREMENT,
                                         nazev VARCHAR(50) NOT NULL,
                                         id_typ_narodnost INT,
                                         FOREIGN KEY (id_typ_narodnost) REFERENCES typ_narodnost(id_typ_narodnost)
);

-- Vytvoření tabulky album
CREATE TABLE IF NOT EXISTS album (
                                     id_album INT PRIMARY KEY AUTO_INCREMENT,
                                     id_typ_zanr INT,
                                     nazev VARCHAR(50) NOT NULL,
                                     datum_vydani DATE,
                                     FOREIGN KEY (id_typ_zanr) REFERENCES typ_zanr(id_typ_zanr)
);

-- Vytvoření tabulky skladba
CREATE TABLE IF NOT EXISTS skladba (
                                       id_skladba INT PRIMARY KEY AUTO_INCREMENT,
                                       nazev VARCHAR(50) NOT NULL,
                                       delka INT
);

-- Vytvoření spojovací tabulky album_interpret
CREATE TABLE IF NOT EXISTS album_interpret (
                                               id_album_interpret INT PRIMARY KEY AUTO_INCREMENT,
                                               id_album INT,
                                               id_interpret INT,
                                               FOREIGN KEY (id_album) REFERENCES album(id_album),
                                               FOREIGN KEY (id_interpret) REFERENCES interpret(id_interpret)
);

-- Vytvoření spojovací tabulky album_skladba
CREATE TABLE IF NOT EXISTS album_skladba (
                                             id_album_skladba INT PRIMARY KEY AUTO_INCREMENT,
                                             cislo_stopy INT,
                                             id_album INT,
                                             id_skladba INT,
                                             FOREIGN KEY (id_album) REFERENCES album(id_album),
                                             FOREIGN KEY (id_skladba) REFERENCES skladba(id_skladba)
);
