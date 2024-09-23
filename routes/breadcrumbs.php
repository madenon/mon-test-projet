<?php

use App\Models\Category;
use App\Models\Type;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Accueil', route('home'));
});

// Home > Offres
Breadcrumbs::for('offersall', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Offres', route('alloffers.index', []));
});
// Home > Propositions
Breadcrumbs::for('propositionsall', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Propositions', route('propositions.index', []));
});
// Home > Offres
Breadcrumbs::for('offers', function (BreadcrumbTrail $trail) {
    if(count(request()->all())){
        $trail->parent('offersall');
        $trail->push('Offres filtrés', route('alloffers.index'));
    }else{
        $trail->parent('home');
        $trail->push('Offres', route('alloffers.index'));
    }
    
});
// Home > Offres
Breadcrumbs::for('offer', function (BreadcrumbTrail $trail) {
    $trail->parent('offersall');
    $trail->push('Offre', route('offer.index', []));
});
// Home > Offres>Create
Breadcrumbs::for('create', function (BreadcrumbTrail $trail) {
    $trail->parent('offers');
    $trail->push('create', route('offer.create'));
    
});
// Home > Offres>CreateProp
Breadcrumbs::for('createprop', function (BreadcrumbTrail $trail, $offerId, $userId,$slug) {
    $trail->parent('offersall');
    $trail->push('Offre', route('offer.offer', ['offerId' => $offerId,'slug'=>$slug]));
    $trail->push('Create Proposition', route('propositions.create', ['offerid' => $offerId, 'userid' => $userId]));
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
