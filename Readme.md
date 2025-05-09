A legelső teendőnk, hogy leklónozzuk ezt a repozitóriumot a git clone parancs segítségével. Ehhez a Git programot használhatjuk, akár közvetlenül a Visual Studio Code felületén is. Alternatívaként a repozitórium tartalmát ZIP fájlként is letölthetjük.

# Adatbázis

- A gyökérben található egy mentés az adatbázisról.

- Ahhoz, hogy ezt be tudjuk importálni, a XAMPP telepítése szükséges, mert az adatbáziskezelő szerver (MySQL) és a backend futtatásához szükséges PHP szerver is ebben van benne. Szóval le kell, hogy telepítsük [innen](https://www.apachefriends.org/hu/download.html)

- A telepítés után indítsuk el a programot. Ha ez megtörtént, ez fogadhat minket: 
![XAMPP_kezdetleges](/backend/img/XAMPP_starter.jpg)

- Apache és a MySQL szervereket kell elindítanunk:
![XAMPP_fut](/backend/img/XAMPP_working.jpg)

- A a "Stop" gomb melletti "Admin" gombra kattintva. Ezt kell láthatjuk:
![phpMyAdmin](/backend/img/phpMyAdmin.jpg)

- Az importálás gombra rákattintva importáljuk be az sql fájlt:
![Database import](/backend/img/db_import.jpg)
![Database import sikeres](/backend/img/db_import_successful.jpg)

# Backend

- Programok: 
    - [Composer](https://getcomposer.org/download/)
    - [Visual Studio Code](https://code.visualstudio.com/)

- Megnyitva a letöltött mappát a Visual Studio Code-ban, a Ctrl + Ö billentyűkombinációval a terminálba lépünk. A backend mappába a "cd backend" parancsal léphetünk be.

- Ezután a "composer install" paranccsal tudjuk letelepíteni a Laravel keretrendszerhez szükséges fájlokat, amiket a vendor mappába tesz bele.

- A "php artisan serve" parancsal el is indíthatjuk a backend oldalt.

- Amennyiben szeretnénk teszteket is lefuttatni, akkor importáljuk be a teszt adatbázis sql-jét a phpMyAdmin-ba.

# Frontend

- Programok:
    - [Node.js](https://nodejs.org/en)

- A parancsokat követve egy másik terminált megnyitva bele kell menni a frontendbe majd ki kell adni az "npm i" parancsot.

- Ezután az "npm run dev" paranccsal tudjuk beindítani a projektet. A hivatkozást megnyitva láthatjuk a weboldalt.