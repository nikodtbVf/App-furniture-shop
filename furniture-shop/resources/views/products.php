<!DOCTYPE html>
<html ng-app="customerRecords">
<head>
	<title>Products</title>
	<meta charset="utf-8">
    <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('css/styles.css')?>" rel="stylesheet">
</head>
<body ng-controller="productsController as productCtrl">
	<div ng-controller="IndexController as indexCtrl">
            <navbar-index></navbar-index>
		</div>
	<div class="container">
		<h4>Productos Registrados</h4>
		<div ng-show="showProducts"> 
		    <table class="table table-striped">
		    	<thead> 
		    		<tr>
		    			<th>Nombre</th>
		    			<th>Descripción</th>
		    			<th>Existencia</th>
		    			<th>Precio</th>
		    			<th><button class="btn btn-primary" ng-click="addForm(1,0)">Agregar </button></th>
		    		</tr>
		    	</thead>
		    	<tbody>
		    		<tr  ng-repeat="product in products">
		    			<td>{{ product.name }}</td>
		    			<td>{{ product.description }}</td>
		    			<td>{{ product.stock }}</td>
		    			<td>{{ product.price }}</td>
		    			<td><button class="btn btn-default" ng-click="addForm(2,product.id)">Editar </button>
		    			<button class="btn btn-danger" ng-click="confirmDelete(product.id)">Eliminar</button>
		    			</td>
		    		</tr>
		    	</tbody>
		    </table>
		</div>
		<div ng-show="showForm">
			<form name="registerProductForm" ng-submit="registerProductForm.$valid && productCtrl.save()" novalidate>
				<form-product></form-product>
				<button class="btn btn-danger" ng-click="backMenu(1)">Regresar Menú</button>
			</form>
		</div>
	</div>
	<script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>
    <script src="<?= asset('js/jquery.min.js') ?>"></script>
    <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
    <script src="<?= asset('app/app.js') ?>"></script>
    <script src="<?= asset('app/controllers/index.js') ?>"></script>
    <script src="<?= asset('app/controllers/products.js') ?>"></script>
</body>
</html>