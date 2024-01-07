# form-html-elements-db-relations


## CZ
Projekt můžeme spustit pomocí příkazu `make start-project` v terminálu ve složce, kde se nachází soubor `Makefile` (v našem případě ve složce `form-html-elements-db-relations`).

Je nutné mít volné porty `90`, `8080` a `3306` (pokud nejsou volné, je třeba je uvolnit nebo upravit podle potřeby v souboru `docker-compose.yml`).

Pokud vše proběhne v pořádku, uvidíme následující v terminálu:

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

Pokud se objeví chyba, je třeba zjistit, co ji způsobuje, a odstranit ji.

Webový server je dostupný na adrese [http://localhost:90](http://localhost:90).
Adminer je dostupný na adrese [http://localhost:8080](http://localhost:8080).
Přihlašovací údaje pro Adminer jsou:
- Systém: MySQL
- Server: db
- Uživatelské jméno: root
- Heslo: toor
- Databáze: music

Pomocí `docker exec -it --user www-data form-html-elements-db-relations_php_1 bash` můžeme vstoupit do kontejneru pro spuštění dalších příkazů.

SQL soubory pro naplnění databáze a dotazy požadované v úloze jsou ve složce `project/sql`.

Takhle vypadá uvodní stránka:
![Alt text](project/www/img/index.jpg)

--------------------------------------------------------------------------------------------

## EN
We will start the entire project using the command `make start-project` in the terminal within the folder where the `Makefile` is located (in our case, in the `form-html-elements-db-relations` folder).

It is necessary to have the ports `90`, `8080`, and `3306` available (if they are not available, they need to be released or adjusted as needed in the `docker-compose.yml` file).

If everything goes well, the following output will be displayed in the terminal:

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
@stats:{cmd:"make start-project" sys:0.31s usr:1.93s cpu:19% wall:11.638s mem:43k}
```

If an error occurs, it is necessary to identify the cause and resolve it.

The web server is accessible at [http://localhost:90](http://localhost:90).
Adminer is accessible at [http://localhost:8080](http://localhost:8080).
The login credentials for Adminer are:
- System: MySQL
- Server: db
- Username: root
- Password: toor
- Database: music

Using `docker exec -it --user www-data form-html-elements-db-relations_php_1 bash`, we can enter the container to run additional commands.

SQL files for populating the database and queries required for the task are located in the `project/sql` folder.

![Alt text](project/www/img/index.jpg)
