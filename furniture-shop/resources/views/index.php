<!DOCTYPE html>
<html lang="en-US" ng-app="customerRecords">
    <head>
        <title>Furniture Shop</title>
        <meta charset="utf-8">
        <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">

    </head>
    <body style="background-color:#edd9c0;" ng-controller="IndexController as indexCtrl">
        <navbar-index></navbar-index>
     
        <h4 style="color:black;">Bienvenido a Furniture Shop</h4>
        <script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>
        <script src="<?= asset('js/jquery.min.js') ?>"></script>
        <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/index.js') ?>"></script>
    </body>
</html>

