-- Najít album včetně interpreta, které obsahuje nejdelší písničku.
SELECT i.nazev AS interpret, a.nazev AS album, s.nazev AS nejdelsi_pisnicka, s.delka
FROM album a
         JOIN album_interpret ai ON a.id_album = ai.id_album
         JOIN interpret i ON ai.id_interpret = i.id_interpret
         JOIN album_skladba ast ON a.id_album = ast.id_album
         JOIN skladba s ON ast.id_skladba = s.id_skladba
ORDER BY s.delka DESC
    LIMIT 1;

