<?php
session_start();

function checkAuth($login, $password) {
    return $login === 'Edma' && $password === '32221';
}

if (!isset($_SESSION['films'])) {
    $_SESSION['films'] = [
        ['id' => 1, 'title' => 'Аватар', 'genre' => 'Фантастика', 'year' => 2009],
        ['id' => 2, 'title' => 'Форсаж', 'genre' => 'Боевик', 'year' => 2001],
        ['id' => 3, 'title' => 'Холодное сердце', 'genre' => 'Мультфильм', 'year' => 2013]
    ];
}

function getFilms() {
    return $_SESSION['films'];
}

function addFilm($title, $genre, $year) {
    $newId = count($_SESSION['films']) > 0 ? max(array_column($_SESSION['films'], 'id')) + 1 : 1;
    $_SESSION['films'][] = [
        'id' => $newId,
        'title' => $title,
        'genre' => $genre,
        'year' => $year
    ];
    return true;
}

function updateFilm($id, $title, $genre, $year) {
    foreach ($_SESSION['films'] as &$film) {
        if ($film['id'] == $id) {
            $film['title'] = $title;
            $film['genre'] = $genre;
            $film['year'] = $year;
            return true;
        }
    }
    return false;
}

function deleteFilm($id) {
    foreach ($_SESSION['films'] as $key => $film) {
        if ($film['id'] == $id) {
            unset($_SESSION['films'][$key]);
            $_SESSION['films'] = array_values($_SESSION['films']); // Переиндексация
            return true;
        }
    }
    return false;
}
?>
