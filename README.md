# Simple MVC

## Description

This repository is a simple PHP MVC structure from scratch.

It uses some cool vendors/libraries such as Twig and Grumphp.
For this one, just a simple example where users can choose one of their databases and see tables in it.

## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PASSWORD', 'your_db_password');
```
4. Import *database.sql* in your SQL server, you can do it manually or use the *migration.php* script which will import a *database.sql* file.
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.
7. From this starter kit, create your own web application.

### Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :

`git config --global core.autocrlf true`

## Example 

An example (a basic list of items) is provided (you can load the *simple-mvc.sql* file in a test database). The accessible URLs are :

* Home page at [localhost:8000/](localhost:8000/)
* Items list at [localhost:8000/items](localhost:8000/items)
* Item details [localhost:8000/items/show?id=:id](localhost:8000/item/show?id=2)
* Item edit [localhost:8000/items/edit?id=:id](localhost:8000/items/edit?id=2)
* Item add [localhost:8000/items/add](localhost:8000/items/add)
* Item deletion [localhost:8000/items/delete?id=:id](localhost:8000/items/delete?id=2)

You can find all these routes declared in the file `src/routes.php`. This is the very same file where you'll add your own new routes to the application.

## How does URL routing work ?

![simple_MVC.png](.tours/simple_MVC.png)


## Ask for a tour !

<img src="https://raw.githubusercontent.com/WildCodeSchool/simple-mvc/codetour/.tours/photo-1632178151697-fd971baa906f.jpg" alt="Guided tour" width="150"/>

We prepare a little guided tour to start with the simple-MVC.

To take it, you need to install the `Code Tour` extension for Visual Studio Code : [Code Tour](https://marketplace.visualstudio.com/items?itemName=vsls-contrib.codetour)

It will give access to a new menu on your IDE where you'll find the different tours about the simple-MVC. Click on play to start one : 

![menu](https://raw.githubusercontent.com/WildCodeSchool/simple-mvc/codetour/.tours/code_tour_menu.png)



## Run it on docker

If you don't know what is docker, skip this chapter. ;) 

Otherwise, you probably see, this project is ready to use with docker. 

To build the image, go into the project directory and in your CLI type:

```
docker build -t simple-mvc-container .
```

then, run it to open it on your localhot :

```
docker run -i -t --name simple-mvc  -p 80:80 simple-mvc-container
```

## Æterna Fabula

![Æterna Fabula](https://i.imgur.com/yxHa9Ct.jpeg)
### v0.4 / Updated 21/11/22

## Clone and run Æterna Fabula

1. Clone the repo from Github.

2. Run `composer install`.

3. Run the file `af_database.sql` with MySQL

4. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters.

```php
define('APP_DB_HOST', 'localhost');
define('APP_DB_NAME', 'aeterna_fabula');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```

5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. 

6. Go to `localhost:8000` with your favorite browser.

## Architecture of Æterna Fabula

### Here is the list of the main categories of Æterna Fabula :

### Player pages :
* Home page at [localhost:8000/](http://localhost:8000/)
* Launch a new game and retrieve your historics at [localhost:8000/Alias](http://localhost:8000/alias)
* Read the introduction at [localhost:8000/incipit](http://localhost:8000/incipit)
* Play at [localhost:8000/chapter/show?id=1](http://localhost:8000/chapter/show?id=1)

### Admin pages :
* Get the list of the chapters at [localhost:8000/chapters](http://localhost:8000/chapters)
* Add a new chapter at [localhost:8000/chapters/admin_add](http://localhost:8000/chapters/admin_add)
* Add new actions at [localhost:8000/actions/admin_add_action](http://localhost:8000/actions/admin_add_action)

## Connect to Æterna Fabula

### Player user :

As a player, you can play new games and get the historics related to each games.

Mail : `phpuser@af.fr`
Password : `AF-mdp-123`

### Admin user :

As an admin, you can add new chapters and new actions to the story.

Mail : `admin@af.fr`
Password : `AF-mdp-123`

## Info about Æterna Fabula

Æterna Fabula is a [school](https://www.wildcodeschool.com/) project created by :

* [Benjamin Hamraoui](https://github.com/Jottundr)
* [Jérôme Legrand](https://github.com/jlegrand-79)
* [Estelle Maingue Lagrange](https://github.com/emainguelag)
* [Fanny Sauvageot](https://github.com/79Inaf)
* [Charlie Toussaint](https://github.com/charlietoussaint)

All images are created with [Midjourney](https://www.midjourney.com/)
