<?php

use App\Models\Category;
use App\Models\Type;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('home', route('home'));
});

// Home > Offres
Breadcrumbs::for('offers', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('offers', route('alloffers.index'));
    
});
// Home > Offres>Create
Breadcrumbs::for('create', function (BreadcrumbTrail $trail) {
    $trail->parent('offers');
    $trail->push('create', route('offer.create'));
    
});

// Home > Offres > Type
Breadcrumbs::for('type', function (BreadcrumbTrail $trail, $type) {
    $trail->parent('offers');
    $trail->push($type, route('type.index', ['type' => $type]));
});

// Home > Offres > Type > Category
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $type, $category) {
    $trail->parent('type', $type);
    $trail->push($category, route('category.index', ['type' => $type, 'category' => $category]));
});
Breadcrumbs::for('account', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('account', route('myaccount.index'));
});
Breadcrumbs::for('ratings', function (BreadcrumbTrail $trail) {
    $trail->parent('ratings');
    $trail->push('ratings', route('ratings.index'));
});
