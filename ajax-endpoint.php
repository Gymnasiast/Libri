<?php
use Cyndaron\DBConnection;

$connectie = DBConnection::getInstance();
$answer = [];

if (empty($_POST['action'])) {
    $_POST['action'] = '';
}

switch ($_POST['action'])
{
    case 'addBook':
        $worth = $_POST['worth'] ? str_replace(',', '.', $_POST['worth']) : '0.00';
        if (empty($_POST['title']))
        {
            echo 'Titel ontbreekt!';
            break;
        }

        $yearOfPublication = $_POST['yearOfPublication'] > 0 ? $_POST['yearOfPublication'] : NULL;
        $acquisitionDate = $_POST['acquisitionDate'] != '' ? $_POST['acquisitionDate'] : NULL;

        $id = $connectie->doQuery(
            "INSERT INTO books (title, author, publicationType, genre, rating, description, worth, language, publisher, edition, yearOfPublication, origin, acquisitionDate, originSource) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [$_POST['title'], $_POST['author'], $_POST['publicationType'], $_POST['genre'], $_POST['rating'], $_POST['description'], $worth, $_POST['language'], $_POST['publisher'], $_POST['edition'], $yearOfPublication, $_POST['origin'], $acquisitionDate, $_POST['originSource']]
        );
        if ($id != false)
        {
            $answer = ['action' => 'add', 'status' => 'ok', 'id' => $id];
        }
        else
        {
            echo 'Invoegen niet gelukt!';
        }
        break;
    case 'editBook':
        $worth = $_POST['worth'] ? str_replace(',', '.', $_POST['worth']) : '0.00';
        $id = $_POST['id'];
        if (!empty($id))
        {
            $yearOfPublication = $_POST['yearOfPublication'] > 0 ? $_POST['yearOfPublication'] : NULL;
            $acquisitionDate = $_POST['acquisitionDate'] != '' ? $_POST['acquisitionDate'] : NULL;

            $connectie->doQuery(
                'UPDATE books
                 SET `title` = ?, `author` = ?, `publicationType` = ?, `genre` = ?, `rating` = ?, `description` = ?, `worth` = ?, `language` = ?, `publisher` = ?, `edition` = ?, `yearOfPublication` = ?, `origin` = ?, `acquisitionDate` = ?, `originSource` = ? 
                 WHERE id = ?',
                [$_POST['title'], $_POST['author'], $_POST['publicationType'], $_POST['genre'], $_POST['rating'], $_POST['description'], $worth, $_POST['language'], $_POST['publisher'], $_POST['edition'], $yearOfPublication, $_POST['origin'], $acquisitionDate, $_POST['originSource'], $id]
            );
            $answer = ['action' => 'edit', 'status' => 'ok', 'id' => $id];
        }
        else
        {
            echo 'Geen ID opgegeven!';
        }
        break;
    case 'getBookData':
        $id = intval($_POST['bookId']);
        $bookData = $connectie->doQueryAndFetchFirstRow('SELECT * FROM books WHERE id = ?', [$id]);
        $bookData['worth'] = str_replace('.', ',', $bookData['worth']);
        $answer = $bookData;
        break;
    case 'deleteBook':
        $id = intval($_POST['bookId']);
        if ($id > 0)
        {
            $connectie->doQuery('DELETE FROM books WHERE id = ?', [$id]);
            $answer = ['status' => 'ok'];
        }
        else
        {
            echo 'Geen ID opgegeven!';
        }
        break;
    default:
        echo 'Geen geldige actie!';
        var_dump($_POST);
}

if (!empty($answer))
{
    echo json_encode($answer, JSON_FORCE_OBJECT);
}