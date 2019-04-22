# Laravel bootstrap boilerplate

This is my boilerplate to start new Laravel Projets using a "not so bad" right management.
Actually this work is under heavy development so you should not use it for anything but reading / testing

## Starting :

```
git clone https://github.com/lalmat/laravel-bootstrap
cd laravel-bootstrap
composer install
npm install
cp .env.example .env
```

create database and adapt the .env file then

```
php artisan migrate
php artisan serve &
npm run hot
```

Access to http://localhost:8000 then enter the backoffice using theses credentials :

```
username : admin@example.com
password : laravel
```

## TODO list

- [x] Create a backoffice layout with bootstrap + Vue + VueRouter + Vuex
- [x] List users
- [x] Add/Edit user
- [x] Delete user
- [ ] List Rights
- [ ] Add/Edit a Right
- [ ] Delete a Right
- [ ] Assign/Unassign a Right to a User
- [ ] Manage Rights in Policies
