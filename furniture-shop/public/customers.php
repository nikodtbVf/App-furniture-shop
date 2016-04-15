<!DOCTYPE html>
<html lang="en-US" ng-app="customerRecords">
    <head>
        <title>Furniture Shop</title>
        <meta charset="utf-8">
         
        <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">
    </head>
    <body ng-controller="customersController as customCtrl">
        <div class="container"> 
        
            <h4>Clientes Registrados</h4>
            <div ng-show="showCustomers">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Calle</th>
                            <th>No.Casa</th>
                            <th>Municipio</th>
                            <th>Estado</th>
                            <th>RFC</th>
                            <th>Num.Tel.</th>
                            <th><button class="btn btn-primary" ng-click="addForm(1,0)">Agregar</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="customer in customers">
                            <td>{{ customer.name }}</td>
                            <td>{{ customer.email }}</td>
                            <td>{{ customer.street }}</td>
                            <td>{{ customer.house_number }}</td>
                            <td>{{ customer.municipality }}</td>
                            <td>{{ customer.state }}</td>
                            <td>{{ customer.rfc }}</td>
                            <td>{{ customer.phone_number }}</td>
                            <td> <button class="btn btn-default" ng-click="addForm(2, customer.id)">Editar</button>
                                <button class="btn btn-danger" ng-click="confirmDelete(customer.id)">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div ng-show="showForm"> 
                <form name="registerCustomerForm" ng-submit=" registerCustomerForm.$valid && customCtrl.save()"  novalidate>
                    <form-customer> </form-customer>
                    <button class="btn btn-danger" ng-click="backMenu(1)"> Regresar Menu </button>
                </form>  
            </div>
        </div>

        <script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>
        <script src="<?= asset('js/jquery.min.js') ?>"></script>
        <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/customers.js') ?>"></script>
    </body>
</html>

