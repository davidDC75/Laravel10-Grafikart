<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Tutoriel grafikart sur laravel 10

[Doc Laravel: Eloquent ORM](https://laravel.com/docs/10.x/eloquent)

[Doc Laravel: Database seeding](https://laravel.com/docs/10.x/seeding)

[Doc Laravel: Query Builder](https://laravel.com/docs/10.x/queries)

[Doc Laravel: Blade](https://laravel.com/docs/10.x/blade)

[Doc Laravel: Validation](https://laravel.com/docs/10.x/validation#main-content)

[Doc Laravel: String](https://laravel.com/docs/10.x/strings#main-content)

[Doc Laravel: Route Model Binding](https://laravel.com/docs/10.x/folio#route-model-binding)

## Installer la debug bar de développement

[barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)

## Installation Laravel IDE Helper

Pour l'auto-complètion des Models avec l'IDE. Permet de récupérer des propriétés et des méthodes que l'IDE ne trouve pas avec PhPDocs.

[barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)

```
php artisan ide-helpers:models
```

```
php artisan ide-helper:models -M
```

```
php artisan ide-helper:generate
```

Pour PhPstorm :

```
php artisan ide-helper:meta
```

## Utiliser le serveur web

```
php artisan serve
```

## Lister les routes configurées dans routes/web.php

```
php artisan route:list
```

## Créer un fichier de migration pour la database dans database/migrations

```
php artisan make:migration CreatePostTable
```

## Faire la migration

```
php artisan migrate
```

## Créer un model dans app/Models (exemple model Post)

```
php artisan make:model Post
```

## Créer un classe seeder dans database/seeders (exemple seeder pour les Post)

```
php artisan make:seeder PostSeeder
```

## Tuto pour générer un slug unique

[Tutoriel d'installation et d'utilisation](https://www.tutsmake.com/laravel-10-create-unique-slug-tutorial-example/)

## Pour la génération d'un slug unique

### Natif Laravel

```
\Str::slug();
```

### En utilisant une lib externe

```
composer require cviebrock/eloquent-sluggable
```

```
php artisan vendor:publish --provider="Cviebrock\EloquentSluggable\ServiceProvider"
```

## Lancer le seed de la db

```
php artisan db:seed
```

## Créer un controller

```
php artisan make:controller BlogController
```

## Créer une request
```
php artisan make:request BlogFilterRequest
```

# ACTUELLEMENT VIDEO 7
