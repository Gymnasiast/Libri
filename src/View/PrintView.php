<?php
namespace Libri\View;

use Cyndaron\DBConnection;

require_once __DIR__ . '/../../vendor/mpdf/mpdf/mpdf.php';

class PrintView
{
    public function __construct()
    {
        $connection = DBConnection::getInstance();
        $bookListRaw = $connection->doQueryAndFetchAll("SELECT *, DATE_FORMAT(acquisitionDate, '%d-%m-%Y') AS acquisitionDateFriendly FROM books ORDER BY author, title, yearOfPublication");
        $bookList = '';

        foreach ($bookListRaw as $book)
        {
            $bookList .= sprintf('<tr><td>%s</td><td>%s</td></tr>', $book['author'], $book['title']);
        }

        ob_start();
        include __DIR__ . '/../Template/PrintView.php';
        $html = ob_get_clean();

        $mpdf = new \Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}