<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boekenlijst</title>
</head>
<body>
<style type="text/css">
    @page
    {
        size: portrait;
        margin: 5mm;
    }
    body
    {
        font-family: "Times New Roman", Garamond, sans-serif;
        font-size: 8pt;
    }
</style>
    <table>
        <?php echo $bookList; ?>
    </table>
</body>
</html>