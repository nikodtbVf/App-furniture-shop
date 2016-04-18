app.controller('salesController',function($scope,$http,API_URL) {
   
    $scope.showSales = true;
    $scope.showForm = false;
    $scope.showPaySale = false;
    $scope.message = "Nothing to show";
    $scope.customers = new Array();
    $scope.products = new Array();
     $http.get(API_URL + "customers")
               .success(function(response){
                         
                    $scope.customers = response;
                   
               });

         $http.get(API_URL + "products")
                .success(function(response){
                    $scope.products = response;
                })
    //Initialize the view with the registered users from API
    $scope.initialize = function(){
        $scope.sale  = { };

         var URL= API_URL + "sales";
         $http.get(URL)
                .success(function(response) {

                    $scope.sales = response;
                });
        
            
           
    }

    //Add form to create users
    $scope.addForm = function(idAction,idSale){
        //Create a customer
        if(idAction == 1){
            $scope.currentAction = "add";
            $scope.form_title = "Agregar Venta";
            $scope.showSales = false;
            $scope.showForm = true;
        }
        //Edit a customer
        if(idAction == 2){
            $scope.currentAction = "edit";
            $scope.id = idSale;
            $scope.form_title = "Editar Venta";
            var URL = API_URL + 'sales/' + idSale;
            $http.get(URL)               
                .success(function(response) {
                    $scope.sale = response;
                });
            $scope.showSales = false;
            $scope.showForm = true;
        }
       
    }

    //Function to return at the previous menu
    $scope.backMenu = function(idDisplay){
        if(idDisplay == 1){
           $scope.showSales = true;
           $scope.showForm = false;
           $scope.showPaySale = false;
        }
    }
    //Function to delete a customer
    $scope.confirmDelete = function(id) {
        var URL = API_URL + 'sales/' + id;
       
        $http({
                method: 'DELETE',
                url: URL
        }).
            success(function(data) {     
                $scope.message = data;
                var URL= API_URL + "sales";
                 $http.get(URL)
                        .success(function(response) {
                            $scope.sales = response;
                        });
            }).
            error(function(data) {
                $scope.message = "Error al eliminar, por favor contacte al administrador";
            });
    }

    //save a new register or edit
    this.save = function() {

        var url = API_URL + "sales";
        
        if ($scope.currentAction === 'edit'){
            url += "/" + $scope.id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.sale),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
            console.log("success")
            $scope.message = response;
            $scope.initialize();
            $scope.showSales = true;
            $scope.showForm = false;
            $scope.showPaySale = false;

        }).error(function(response) {
              $scope.message  = "Por favor verifica los campos";
        });
    }

    $scope.showSale = function(idSale){
        console.log("sale");
         var URL= API_URL + "showSale/"+idSale;
         $http.get(URL)
                .success(function(response) {
                    $scope.saleShow = response;
                    $scope.showSales = false;
                    $scope.showForm = false;
                    $scope.showPaySale = true;
                });

    }
    //Call function to init the view
     $scope.initialize();
});

app.directive('formSale',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/form-sale.html'
    }
});

app.directive('formAlerts',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/formalerts.html'
    }
});
app.directive('showProduct',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/show-products.html'
    }
});

