# gmj-laravel_block2_breadcrumb

Laravel Block for backend and frontend - need tailwindcss support

**composer require gmj/laravel_block2_breadcrumb**

package for test<br>
composer.json#autoload-dev#psr-4: "GMJ\\LaravelBlock2Breadcrumb\\": "package/laravel_block2_breadcrumb/src/",<br>
config > app.php > providers: GMJ\LaravelBlock2Breadcrumb\LaravelBlock2BreadcrumbServiceProvider::class,
in terminal run:<br>
composer dump-autoload

---

in terminal run:

```
php artisan vendor:publish --provider="GMJ\LaravelBlock2Breadcrumb\LaravelBlock2BreadcrumbServiceProvider" --force
php artisan migrate
php artisan db:seed --class=LaravelBlock2BreadcrumbSeeder
```
