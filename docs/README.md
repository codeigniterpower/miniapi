# miniapi

minimo framework para desarrollar php

This framework it has a default example api, when you runs the embebed server, 
you will foun a default api documentation at [DEVEL.md](DEVEL.md) document file.

You can change those settings and files on your needs, the default API example 
only handles a tree case, and retrieve the tree by nodes, there is no authentication, 
but for auth support please read [DEVEL.md](DEVEL.md) document file.

## Como usar este proyecto

```
rm -rf $HOME/Devel/miniapi && mkdir $HOME/Devel

git clone --recursive https://codeberg.org/codeigniter/miniapi $HOME/Devel/miniapi

cd $HOME/Devel/miniapi && ./server
```

## How to start a module

``` bash
cd $HOME/Devel/minenux-skindb-webdb

./new_module public newlinktoshow
```

* `controllers/newlinktoshow.php`
* `models/newlinktoshow.php`
* `http://localhost:<port>/newlinktoshow`

## How to Deploy and develop

Then read at the end of [DEVEL.md](DEVEL.md) for specific details.

#### Requisitos

* Linux:
  * Debian 7+ Alpine 3.12+
  * git 2.0+
  * php 5+ 7+ o 8+
* database
  * sqlite3 / perconadb 5.5+ / Postgresql 9+ / PDO dbms

## Issues

Use https://codeberg.org/codeigniter/miniapi/issues/new

## LICENSE

The Guachi Framework is open-source software under the MIT License, this downstream part is a reduced version for!
Este minicore conteine partes del framework Banshee bajo la misma licencia.

* (c) 2023 Dias Victor @diazvictor

El proyecto minenux-skindb-webdb es open source y free software bajo la licencia **CC-BY-SA-NC** Compartir igual sin derecho comercial a menos que se pida permiso esten de acuerdo ambas partes, y con atribuciones de credito.

* (c) 2023 PICCORO Lenz McKAY <mckaygerhard>
* (c) 2023 Dias Victor @diazvictor

