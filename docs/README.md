# miniapi

minimo framework para desarrollar php

## Como usar este proyecto

favor refierase a la seccion [Desarrollo](#despliegue-y-desarrollo) donde se detalla:

```
rm -rf $HOME/Devel/receiptsapi && mkdir $HOME/Devel

git clone --recursive https://codeberg.org/codeigniter/erp-recibosapi $HOME/Devel/receiptsapi

cd $HOME/Devel &&  git submodule foreach git checkout develop && git submodule foreach git pull
```

## Despliegue y desarrollo

#### Requisitos

* Linux:
  * Debian 7+ o Alpine 3.12+ unicamente
  * git 2.0+
  * php 7+ o 8+
* database (opcional)
  * mariadb 5.5+
  * postgresql
  * sqlite
  * ODBC

## LICENSE

The Guachi Framework is open-source software under the MIT License, this downstream part is a reduced version for!
Este minicore conteine partes del framework Banshee bajo la misma licencia.

* (c) 2023 Dias Victor @diazvictor

El proyecto receiptsapi es open source y free software bajo la licencia GPLv3 por lo que cualquier modificacion debe ser compartida.

* (c) 2023 PICCORO Lenz MCKAY @mckaygerhard
* (c) 2023 Dias Victor @diazvictor

Las adiciones y la funcionalidad estan licenciadas tambien **CC-BY-SA-NC** Compartir igual sin derecho comercial a menos que se pida permiso esten de acuerdo ambas partes, y con atribuciones de credito.

* (c) 2023 PICCORO Lenz McKAY <mckaygerhard>
* (c) 2023 Dias Victor @diazvictor

