<h1>CRUD užduotis 2026-04-12</h1>
<b>Aprašymas: </b>
Šis projektas yra Laravel  pagrindu sukurtas CRUD (Create, Read, Update, Delete) pavyzdys su studentų ir miestų duomenų valdymu.
<br>2026-04-12 Sukurtas projektas su CRUD



<b>Diegimas: </b>
norint įdiegti projektą reikia atsisiųsti arba  naudoti git (https://git-scm.com/) per CMD:
1. git clone https://github.com/rok1sgie/CRUD_Rokas-Giedraitis
2. cd CRUD_Rokas-Giedraitis
3. composer install
5. cp .env.example .env  << pavzydinis .env padaromas darbiniu, kadangi į github originalas NEKELIAMAS dėl saugumo
6. php artisan key:generate  << uzpildomas key unikaliu kodu
7. sukurti per phpMyAdmin DB pvz.: studentscrud
8. Sukonfogūruoti .env byloje  DB prisijungimą pvz:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=studentscrud
    DB_USERNAME=root
    DB_PASSWORD=
9. php artisan migrate
10. php artisan db:seed
11. php artisan serve
