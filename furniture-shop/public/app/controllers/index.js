app.controller('IndexController',function($scope,$http,API_URL){
	
	$scope.showCustomers  = function(){
		window.location.href="customers";
	}
	$scope.showProducts  = function(){
		window.location.href="products";
	}
});
	
app.directive('navbarIndex', function(){
	return{
		restrict: 'E',
		templateUrl: 'directives/navbar.html'
	}
})