<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Головна
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Головна', route('home'));
});

// Головна > Спецтехніка
Breadcrumbs::for('equipments.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Спецтехніка', route('equipments.index'));
});

// Головна > Спецтехніка > [Техніка]
Breadcrumbs::for('equipments.show', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('equipments.index');
    $trail->push($item->title, route('equipments.show', $item->slug));
});

// Головна > Послуги
Breadcrumbs::for('services.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Послуги', route('services.index'));
});

// Головна > Послуги > [Послуга]
Breadcrumbs::for('services.show', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('services.index');
    $trail->push($item->title, route('services.show', $item->slug));
});

// Головна > Об'єкти
Breadcrumbs::for('projects.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Наші роботи', route('projects.index'));
});

// Головна > Об'єкти > [Об'єкт]
Breadcrumbs::for('projects.show', function (BreadcrumbTrail $trail, $item) {
    $trail->parent('projects.index');
    $trail->push($item->title, route('projects.show', $item->slug));
});
