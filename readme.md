# Guía de instalación Contratos abiertos

# Requerimientos técnicos:
PHP 5.4
Mysql
Composer
Bower

1: copiar los archivos del siguiente repositorio:
[github] (https://github.com/GobiernoFacil/the-gummy-bears.git)

2: en la carpeta raíz, hay que correr el siguiente comando:
```bash
composer install
```

3: en la carpeta raíz, hay que copiar el archivo .env.example a .env
```bash
cp .env.example .env
```

4: crear la base de datos que se va a ocupar

5: editar el archivo .env, en el que se debe poner la información de conexión a la DB, y una variable llamada "ENDPOINTS". Esta variable debe cualquier nombre, menos 'production'. (Es para decidir cuál será la conexión al endpoint)

6: Despues de guardar y cerrar el archivo .env, hay que generar la llave de encriptación con:
```bash
php artisan key:generate
```

7: Acto siguiente, hay que crear las tablas en la base de datos, con el siguiente comando:
```bash
php artisan migrate
```

8: Ya con las tablas disponibles, es posible obtener la información más reciente del api de la CDMX así:
```bash
php artisan contracts:update
```

9: Ahora, ya con la información disponible, se debe optimizar para las gráficas y las apis:
```bash
php artisan contracts:optimize
```

10: por último, hay que descargar las librerías de Javascript necesarias. Dentro de la carpeta de public/js, hay que ejecutar el siguiente comando:
```bash
bower install
```

y eso es todo amigos!
