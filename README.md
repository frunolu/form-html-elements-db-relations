# form-html-elements-db-relations


cely projekt rozbehneme pomocou príkazu `make start-project` v termináli do priečinka, 
kde sa nachádza súbor `Makefile` (v našom prípade do priečinka `form-html-elements-db-relations`)

je potrebne aby sme mali volne porty `90`, `8080` a `3306` (ak ich nemáme, tak ich musíme uvoľniť,
alebo upravíme podla potreby docker-compose.yml) 

ak všetko prebehne v poriadku, tak sa v termináli zobrazí nasledovné:

```bash
make start-project
docker-compose up -d --build --force-recreate --remove-orphans
Building php
Recreating form-html-elements-db-relations_db_1 ... done
Recreating form-html-elements-db-relations_adminer_1 ... done
Recreating form-html-elements-db-relations_php_1     ... done
Recreating form-html-elements-db-relations_web_1     ... done
docker-compose exec php su --command="composer -n install --prefer-dist" www-data
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Generating autoload files
@stats:{cmd:"make start-project" sys:0,31s usr:1,93s cpu:19% wall:11,638s mem:43k}
```

ak sa vyskytne chyba, tak je potrebne zistiť, čo ju spôsobuje a odstrániť ju

webserver je dostupný na adrese [http://localhost:90](http://localhost:90)
adminer je dostupný na adrese [http://localhost:8080](http://localhost:8080)
prihlasovacie údaje pre adminer sú:
- system: MySQL
- server: db
- username: root
- password: toor
- database: music

pomocou `docker exec -it --user www-data form-html-elements-db-relations_php_1 bash`
sa dostaneme do kontajnera pre pripadne spustenie dalsich prikazov napr. ./bin/console

SQL subory na naplnenie databaze su a zaroven dotazy pozadovane v ulohe jsou v priecinku project/sql


--------------------------------------------------------------------------------------------
