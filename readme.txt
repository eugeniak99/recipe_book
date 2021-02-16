Instrukcja instalacji projektu
1. Skopiować zawartość katalogu app do stworzonego uprzednio katalogu (na przykład, my-app) w katalogu domowym na serwerze
2. W pliku .env w linijce DATABASE_URL podmienić dane bazy danych i użytkownika na swoje (nazwa użytkownika, hasło, nazwa bazy danych(.
3. W katalogu my-app/public dodać plik .htaccess o następującej zawartości:
<IfModule mod_rewrite.c>
    Options -MultiViews
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>

<IfModule !mod_rewrite.c>
    <IfModule mod_alias.c>
        RedirectMatch 302 ^/$ /index.php/
    </IfModule>
</IfModule>
4. Stworzyć link symboliczny z katalogu ~/public_html do katalogu public wykonując w konsoli następujące polecenia:
cd ~/public_html
ln -s ~/my-app/public my-app
5. W katalogu projektu wydać polecenie composer install.
6. Stworzyć migrację poleceniem php bin/console make:migration.
7. Załadować migrację i zapełnić bazę danymi losowymi poprzez polecenia
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load