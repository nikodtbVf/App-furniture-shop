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
	$scope.get = function(){


		var URL= API_URL + "sales/getConfig";
        $http.get(URL)
            .success(function(response) {
             console.log(response);
         });
		
	}
	
});
	
app.directive('navbarIndex', function(){
	return{
		restrict: 'E',
		templateUrl: 'directives/navbar.html'
	}
})