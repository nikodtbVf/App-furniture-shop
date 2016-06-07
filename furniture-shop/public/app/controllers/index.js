app.controller('IndexController',function($scope,$http,API_URL){
	
	$scope.showCustomers  = function(){
		window.location.href="customers";
	}
	$scope.showProducts  = function(){
		window.location.href="products";
	}
	$scope.showSales  = function(){
		window.location.href="sales";
	}
	$scope.showConfigs = function(){
		console.log("show")
		window.location.href = "configurations";
	}
	$scope.showMostrar = function(){

		window.location.href = "mostrar";
	}
	$scope.showReestablecer = function(){

		window.location.href = "reestablecer";
	}
	$scope.get = function(){
		var URL= API_URL + "sales/getConfig";
        $http.get(URL)
            .success(function(response) {
             console.log(response);
         });
		
	};	

	$scope.showCategory = function(){
		window.location.href = "categorias";
	}

	$scope.showContact = function(){
		window.location.href = "contacto";
	}

	$scope.showSend = function(){
		window.location.href = "envio";
	}
	
    $scope.showShoppingCar = function(){
		window.location.href = "carrito";
	}                    
});
	
app.directive('navbarIndex', function(){
	return{
		restrict: 'E',
		templateUrl: 'directives/navbar.html'
	}
});
app.directive('formAlert',function(){
	return{
		restrict: 'E',
		templateUrl: 'directives/formalerts.html'
	}
});