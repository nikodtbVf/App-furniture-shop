<!DOCTYPE html>
<html lang="en-US" ng-app="customerRecords">
    <head>
        <title>Ventas</title>
        <meta charset="utf-8">
        <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= asset('css/styles.css') ?>" rel="stylesheet">
    </head>
    <body  ng-controller="salesController as saleCtrl">
        <div  ng-controller="IndexController as indexCtrl">
            <navbar-index></navbar-index>
        </div>
            <div class="container">
                <div class="row alert alert-info" ng-show="showAlert">
                    <label class="col-sm-11" > {{ message }} </label> 
                    <button class="col-sm-1" ng-click="changeStateAlert()" > Close </button>
                </div> 
                <h4>Ventas</h4>
                <div ng-show="showSales">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Producto</th>
                                <th>Total Restante </th>
                                <th><button class="btn btn-primary" ng-click="addForm(1,0)">Agregar</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="sale in sales">
                                <td>{{ sale.customer }}</td>
                                <td>{{ sale.product}}</td>
                                <td>{{ sale.interests + sale.subtotal | currency }}</td>
                                <td> <button class="btn btn-info" ng-click="showSale(sale.id)">Mostrar</button> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div ng-show="showForm"> 
                    <form name="registerSaleForm" ng-submit=" registerSaleForm.$valid && saleCtrl.save()"  novalidate>
                        <form-sale></form-sale>
                        <button class="btn btn-danger" ng-click="backMenu(1)"> Regresar Menu </button>
                    </form>  
                </div>
                <div ng-show="showPaySale">
                    <show-product></show-product>
                     <button class="btn btn-danger" ng-click="backMenu(1)"> Regresar Menu </button>
                </div>
       
                <script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>
                <script src="<?= asset('js/jquery.min.js') ?>"></script>
                <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
                <script src="<?= asset('app/app.js') ?>"></script>
                <script src="<?= asset('app/controllers/index.js') ?>"></script>
                <script src="<?= asset('app/controllers/sales.js') ?>"></script>

        </div>
    </body>
</html>

