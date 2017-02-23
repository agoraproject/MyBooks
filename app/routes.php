<?php

// Home page
$app->get('/', function () use ($app) {
    $books = $app['dao.book']->findAll();
    return $app['twig']->render('index.html.twig', array('books' => $books));
})->bind('home');

// Article details with books
$app->get('/author/{id}', function ($id) use ($app) {
    $author = $app['dao.author']->find($id);
    $books = $app['dao.book']->findAllByAuthor($id);
    return $app['twig']->render('author.html.twig', array('author' => $author, 'books' => $books));
})->bind('author');
