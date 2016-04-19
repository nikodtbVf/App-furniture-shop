<!DOCTYPE html>
<html lang="en-US" ng-app="customerRecords">
    <head>
        <title>Configuraciones</title>
        <meta charset="utf-8">
        <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">

    </head>
    <body ng-controller="IndexController as indexCtrl" >
        
        <navbar-index></navbar-index>
        <div class="container" ng-controller="configurationsController as configCtrl"> 
            <div class="row alert alert-info" ng-show="showAlert">
                <label class="col-sm-11" > {{ message }} </label> 
                <button class="col-sm-1" ng-click="changeStateAlert()" > Close </button>
            </div>
            <h4>Configuraciones</h4>
            <div ng-show="showConfigs">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Intereses Mensuales</th>
                            <th>Pago Inicial</th>
                            <th>Total Meses</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr ng-repeat="configuration in configurations">
                            <td>{{ configuration.interests }}</td>
                            <td>{{ configuration.initialpay }}</td>
                            <td>{{ configuration.numbers_months }}</td>
                            <td> <button class="btn btn-default" ng-click="addForm(configuration.id)">Editar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
         
            <div ng-show="!showConfigs"> 
                <form name="registerConfigForm" ng-submit=" registerConfigForm.$valid && configCtrl.save()"  novalidate>
                    <form-configurations> </form-configurations>
                    <button class="btn btn-danger" ng-click="backMenu(1)"> Regresar Menu </button>
                </form>  
            </div>
        <script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>
        <script src="<?= asset('js/jquery.min.js') ?>"></script>
        <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/index.js') ?>"></script>
        <script src="<?= asset('app/controllers/configurations.js') ?>"></script>

        </div>
    </body>
</html>

