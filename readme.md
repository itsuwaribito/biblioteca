
<p align="justify">
Este proyecto fue creado para el manejo de préstamos y devoluciones de una biblioteca. Con el fin de optimizar la administración de préstamos de libros y mantener una bitácora actualizada y disponible en todo momento. Las herramientas de desarrollo utilizadas son VueJS (v2.5), Laravel (v5.8), Vuetify (v1.5.4) y VueRouter (v3.0). Para la implementación y/o mejora de este proyecto se recomienda conocer el uso y la implementación de las herramientas de desarrollo antes mencionadas.
</p>

## Acerca de Laravel
Laravel es un framework de aplicaciones web que se enfoca en la sintaxis elegante. Laravel es accesible y provee de las herramientas necesarias para el desarrollo de aplicativos robustos.


## Acerca de VueJS
VueJs es un framework del lado del cliente que, al igual que Laravel, provee de las herramientas necesarias para la creación de páginas dinámicas. Aunque en este proyecto solamente se utilizó VueJS para el desarrollo del front-end, el framework funciona perfectamente en conjunto con otras herramientas. La documentación es muy extensa y vasta, ya que no solo ofrece ejemplos de cómo utilizar VueJS sino también de cómo implementarlo en proyectos ya existentes.

## Enlaces de interes
- [Documentación de Laravel en ingles](https://laravel.com/docs/)
- [Documentación de Laravel en español (desactualizada)](https://laraveles.com/)
- [Laracasts (foro)](https://laracasts.com)
- [VueJS](https://vuejs.org/)
- [Vuetify](https://vuetifyjs.com/es-MX/)
- [Vue Router](https://router.vuejs.org/)
- [Styde.net](https://styde.net/)

## Desarrollo
``` bash
# clonar proyecto de Github
git clone https://github.com/itsuwaribito/biblioteca.git

# ubicarse en la carpeta generada 
cd biblioteca

# instalar dependencias de Laravel
composer install

# configurar la base de datos en el archivo de variables de entorno de Laravel
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=nombre_db
    DB_USERNAME=user_db
    DB_PASSWORD=password_db

# instalar dependencias de JavaScript
npm install

# compilar archivos JavaScript
npm run dev

# ejecutar migraciones
php artisan migrate

# ejecutar seeders
php artisan db:seed

# montar servidor con artisan
php artisan serve
```
## Licencia
Esto es un software open-source bajo la licencia [MIT](https://opensource.org/licenses/MIT).

[Jairo Nava Magaña](https://github.com/itsuwaribito)
