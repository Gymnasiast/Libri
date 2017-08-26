<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="vendor/Bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="vendor/jQuery/css/jquery-ui.min.css" type="text/css" rel="stylesheet"/>
    <link href="css/libri.css" type="text/css" rel="stylesheet"/>
    <title>Boekenbeheer</title>
    <link rel="icon" type="image/png" href="/favicon.png" />

</head>
<body>

<div class="container">
    <div class="page-header">
        <h1>Boekenlijst</h1>
    </div>

    <button id="addButton" type="button" class="btn btn-default btn-success" data-toggle="modal" data-target="#editBookPopup"><span class="glyphicon glyphicon-plus"></span> Toevoegen</button>
    <a id="printButton" type="button" class="btn btn-default btn-info" href="/print"><span class="glyphicon glyphicon-print"></span> Afdrukversie</a>

    <br><br>

    <p>De database bevat momenteel <?php echo $numberOfBooks;?> boeken.</p>
    <table id="bookList" class="table table-bordered table-striped">
        <thead>
            <th>Auteur</th>
            <th>Titel</th>
            <th>Genre</th>
            <th>Jaar</th>
            <th>Bew./verw.</th>
        </thead>
        <tbody id="bookListBody">
            <?php echo $bookList; ?>
        </tbody>
    </table>
</div>

<div id="editBookPopup" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 id="bookPopupTitle" class="modal-title">Boek invoeren</h4>
            </div>
            <div class="modal-body">
                <form id="editBookPopupForm" class="form-horizontal">
                    <h2>Algemeen</h2>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Boektitel:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                    </div>
                 <div class="form-group">
                        <label for="author" class="col-sm-2 control-label">Auteur(s) / samensteller(s):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="author" name="author" list="authorList">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="publicationType" class="col-sm-2 control-label">Type publicatie:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="publicationType" name="publicationType" value="Boek" list="publicationTypeList">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="genre" class="col-sm-2 control-label">Genre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="genre" name="genre" value="" list="genreList">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Beoordeling:</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="rating" value="1"> <span
                                        class="glyphicon glyphicon-star"></span>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="rating" value="2"> <span
                                        class="glyphicon glyphicon-star"></span><span
                                        class="glyphicon glyphicon-star"></span>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="rating" value="3"> <span
                                        class="glyphicon glyphicon-star"></span><span
                                        class="glyphicon glyphicon-star"></span><span
                                        class="glyphicon glyphicon-star"></span>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="rating" value="4"> <span
                                        class="glyphicon glyphicon-star"></span><span
                                        class="glyphicon glyphicon-star"></span><span
                                        class="glyphicon glyphicon-star"></span><span
                                        class="glyphicon glyphicon-star"></span>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="rating" value="5"> <span
                                        class="glyphicon glyphicon-star"></span><span
                                        class="glyphicon glyphicon-star"></span><span
                                        class="glyphicon glyphicon-star"></span><span
                                        class="glyphicon glyphicon-star"></span><span
                                        class="glyphicon glyphicon-star"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">Omschrijving:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="worth" class="col-sm-2 control-label">Aanschafwaarde:</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">&euro;</span>
                                <input type="text" class="form-control" id="worth" name="worth" value="">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h2>Versie</h2>
                    <div class="form-group">
                        <label for="language" class="col-sm-2 control-label">Taal:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="language" name="language" value="Nederlands" list="languageList">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="publisher" class="col-sm-2 control-label">Uitgever:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="publisher" name="publisher" value="" list="publisherList">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edition" class="col-sm-2 control-label">Druk:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="edition" name="edition" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="yearOfPublication" class="col-sm-2 control-label">Jaar van publicatie:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="yearOfPublication" name="yearOfPublication" value="">
                        </div>
                    </div>
                    <hr>
                    <h2>Status</h2>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Herkomst:</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="origin" value="bought"> Gekocht
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="origin" value="present"> Gekregen
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="origin" value="borrowed"> Geleend
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="acquisitionDate" class="col-sm-2 control-label">Gekocht/gekregen op:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control hasDatePicker" id="acquisitionDate" name="acquisitionDate"
                                   placeholder="Voorbeeld: 1946-08-15" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="originSource" class="col-sm-2 control-label">Gekocht bij/gekregen van:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="originSource" name="originSource" value="" list="originSourceList">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                <button id="saveConfirm" type="button" class="btn btn-primary">Opslaan</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="deleteBookPopup" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 id="bookPopupTitle" class="modal-title">Boek verwijderen</h4>
            </div>
            <div class="modal-body">
                <p>Weet u zeker dit u dit boek wilt verwijderen?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                <button id="deleteConfirm" type="button" class="btn btn-danger">Verwijderen</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<datalist id="authorList">
    <?=$authorList; ?>
</datalist>
<datalist id="genreList">
    <?=$genreList; ?>
</datalist>
<datalist id="languageList">
    <?=$languageList; ?>
</datalist>
<datalist id="publisherList">
    <?=$publisherList; ?>
</datalist>
<datalist id="publicationTypeList">
    <?=$publicationTypeList; ?>
</datalist>
<datalist id="originSourceList">
    <?=$originSourceList; ?>
</datalist>

<script src="vendor/jQuery/js/jquery-3.2.1.min.js"></script>
<script src="vendor/jQuery/js/jquery-ui.min.js"></script>
<script src="vendor/jQuery/js/datepicker-nl.js"></script>
<script src="vendor/Bootstrap/js/bootstrap.min.js"></script>
<script src="js/mainView.js"></script>
</body>
</html>