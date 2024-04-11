# miniapi

minimo framework para desarrollar php

## Como usar este proyecto

favor refierase a la seccion [Desarrollo](#despliegue-y-desarrollo) donde se detalla:

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

Start geany an browse the `Devel/minenux-skindb-webdb` directory , look 
for `skindb-webdb` proyect file, load into Geany!

Then read the [DEVEL.md](DEVEL.md) for some specific details.

#### Requisitos

* Linux:
  * Debian 7+ Alpine 3.12+
  * git 2.0+
  * php 5+ 7+ o 8+
* database
  * sqlite3 / perconadb 5.7+

## LICENSE

The Guachi Framework is open-source software under the MIT License, this downstream part is a reduced version for!
Este minicore conteine partes del framework Banshee bajo la misma licencia.

* (c) 2023 Dias Victor @diazvictor

El proyecto minenux-skindb-webdb es open source y free software bajo la licencia **CC-BY-SA-NC** Compartir igual sin derecho comercial a menos que se pida permiso esten de acuerdo ambas partes, y con atribuciones de credito.

* (c) 2023 PICCORO Lenz McKAY <mckaygerhard>
* (c) 2023 Dias Victor @diazvictor

