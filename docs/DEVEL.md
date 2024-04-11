## miniapi development

Quick setup: [README.md](README.md)

### WORKFLOW

Contributor must know how to work with git, and also git-flow, 
with GitFlow Simplified , contributor must create an extra development branch!

https://medium.com/goodtogoat/simplified-git-flow-5dc37ba76ea8

The developer, just fork with https://codeberg.org/repo/fork/204481 and 
clones the repository to creates the extra development branch, he starts 
working on it to later send git merge request to upstream.

### Prerequisites

* you must have your user as `/home/general`
* you must have `Devel` subpath for development as then `/home/general/Devel`
* you must not work as root! never! and we do not use `sudo` !
* all files must have LF as new line and good identation
* api is developed with PHP and CSS with only JS usage for dynamic things!
* our prefered IDE/editor is Geany! we support non big open source projects too!

### Framework

The base is made in GUACHI based framework https://gitlab.com/guachi/Guachi_Framework
but reduced as "miniapi" and only handles database and routing.

Any JS and/or CSS must be used directly without any network dependant 
tool neither remote based development tool, the development must be 
fully local and cannot depends of external things.

Our eyecandy framework is based on Bulma https://github.com/jgthms/bulma?tab=readme-ov-file

### routing structure and controllers

* INDEX for routing: `modules.ini`
* API calls `controllers/api/v1/<module>.php`
    * `models/api/v1/lists.php`
* LIST view `controllers/lists.php`
    * `models/lists.php`
* ASSETS files `public/assets/css/`
    * `bulma.css`
* VIEWS to include `public/views`
    * `index.php`

### Full API documentation

Please any format or modification to [API.md](API.md) for all the skin api documentation, before 
start to develop.

### DATABASE

Se intentara omitir la carga hacia DB, usando los archivos de metadatos de los skins
y la carga directamente en el git.

Cada skin tendra su propio historico, que lo dara el git, y el usuario lo determina 
el mismo sistema git.

Los skins viejos emplearan la base de datos vieja. los skins nuevos guardaran a data 
en el git y su id sera el formato nuevo.

##### Diccionario de datos

Solo empleado para el api y acceso a la web para la gui [miniapi.sql](miniapi.sql)

### WEBSERVER

Para que esto funcione debe tener un dns interno apuntando "miniapi.localhost" o sino a 127.0.0.1

* lighttpd: la configuracion puede ser insertada en una seccion server 
o en una seccion de directorio de usurio:

```
$HTTP["host"] =~ "miniapi\.minenux$" {
        server.document-root = "/home/general/Devel/miniapi/public/"
        accesslog.filename = "/var/log/lighttpd/miniapi.log"
        alias.url = ()
        url.redirect = ()
        url.rewrite-once = (
                "^/(css|img|js|fonts)/.*\.(jpg|jpeg|gif|png|swf|avi|mpg|mpeg|mp3|flv|ico|css|js|woff|ttf)$" => "$0",
                "^/(favicon\.ico|robots\.txt|sitemap\.xml)$" => "$0",
                "^/[^\?]*(\?.*)?$" => "index.php/$1"
        )
}
```

* apache2: esta es la mejor opcion, no por popular, sino por ser mas 
flexible en opciones para el novato, es la peor para produccion:

```
<VirtualHost *:80>
        ServerName miniapi.minenux
        DocumentRoot /home/general/Devel/miniapi/public

        <Directory "/home/general/Devel/miniapi/public">
                DirectoryIndex index.php
                Options FollowSymLinks Indexes
                AllowOverride All
                Order deny,allow
                allow from All
        </Directory>
</VirtualHost>
```

* nginx: la conffiguracion debe secuestrar un puerto entero, asi que 
no es la mejor opcion para servidor:

```
server {
    listen 80;
    server_name miniapi\.minenux;
    root /home/general/Devel/miniapi/public;
    index index.php;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_pass unix:/run/php/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

