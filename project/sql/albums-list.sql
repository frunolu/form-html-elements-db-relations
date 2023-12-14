-- Seznam všech alb včetně interpreta, počtu skladeb na albu. Seřazeno dle názvu interpreta a názvu alba.

SELECT i.nazev AS interpret, a.nazev AS album, COUNT(ast.id_skladba) AS pocet_skladeb
FROM album a
         JOIN album_interpret ai ON a.id_album = ai.id_album
         JOIN interpret i ON ai.id_interpret = i.id_interpret
         LEFT JOIN album_skladba ast ON a.id_album = ast.id_album
GROUP BY a.id_album
ORDER BY i.nazev, a.nazev;

