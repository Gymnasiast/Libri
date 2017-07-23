<?php
namespace Libri\View;

use Cyndaron\DBConnection;

class MainView
{
    public function __construct()
    {
        $connection = DBConnection::getInstance();
        $bookListRaw = $connection->doQueryAndFetchAll("SELECT *, DATE_FORMAT(acquisitionDate, '%d-%m-%Y') AS acquisitionDateFriendly FROM books ORDER BY author, title, yearOfPublication");
        $bookList = '';
        $authorListRaw= $connection->doQueryAndFetchAll("SELECT DISTINCT author FROM books ORDER BY author");
        $authorList = '';
        $genreListRaw = $connection->doQueryAndFetchAll("SELECT DISTINCT genre FROM books ORDER BY genre");
        $genreList = '';
        $languageListRaw = $connection->doQueryAndFetchAll("SELECT DISTINCT language FROM books ORDER BY language");
        $languageList = '';
        $publisherListRaw = $connection->doQueryAndFetchAll("SELECT DISTINCT publisher FROM books ORDER BY publisher");
        $publisherList = '';
        $publicationTypeListRaw = $connection->doQueryAndFetchAll("SELECT DISTINCT publicationType FROM books ORDER BY publicationType");
        $publicationTypeList = '';
        $originSourceListRaw = $connection->doQueryAndFetchAll("SELECT DISTINCT originSource FROM books ORDER BY originSource");
        $originSourceList = '';
        $numberOfBooks = count($bookListRaw);

        foreach ($bookListRaw as $book)
        {
            $buttons = sprintf('
                <div class="btn-group">
                    <button type="button" class="editButton btn btn-default btn-warning" data-book-id="%d" data-toggle="modal" data-target="#editBookPopup">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button type="button" class="deleteButton btn btn-default btn-danger" data-book-id="%d" data-toggle="modal" data-target="#deleteBookPopup">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                </div>', $book['id'], $book['id']
            );

            $bookList .= sprintf('<tr id="bookRow-%s"><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $book['id'], $book['author'], $book['title'], $book['genre'], $book['yearOfPublication'], $buttons);
        }

        foreach ($authorListRaw as $author)
        {
            $authorList .= sprintf('<option value="%s">%s</option>', $author['author'], $author['author']);
        }

        foreach ($genreListRaw as $genre)
        {
            $genreList .= sprintf('<option value="%s">%s</option>', $genre['genre'], $genre['genre']);
        }

        foreach ($languageListRaw as $language)
        {
            $languageList .= sprintf('<option value="%s">%s</option>', $language['language'], $language['language']);
        }

        foreach ($publisherListRaw as $publisher)
        {
            $publisherList .= sprintf('<option value="%s">%s</option>', $publisher['publisher'], $publisher['publisher']);
        }

        foreach ($publicationTypeListRaw as $publicationType)
        {
            $publicationTypeList .= sprintf('<option value="%s">%s</option>', $publicationType['publicationType'], $publicationType['publicationType']);
        }

        foreach ($originSourceListRaw as $originSource)
        {
            $originSourceList .= sprintf('<option value="%s">%s</option>', $originSource['originSource'], $originSource['originSource']);
        }

        include __DIR__ . '/../Template/MainView.php';
    }
}