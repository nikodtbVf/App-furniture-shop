app.controller('productsController',function($scope,$http,API_URL) {
   
    $scope.showProducts = true;
    $scope.showForm = false;
    $scope.message = "Nothing to show";
    //Initialize the view with the registered users from API
    $scope.initialize = function(){

         var URL= API_URL + "products";
         $http.get(URL)
                .success(function(response) {
                    console.log(response);
                    $scope.products = response;
                });
    }

    //Add form to create users
    $scope.addForm = function(idAction,idProduct){
        //Create a customer
        if(idAction == 1){
            $scope.currentAction = "add";
            $scope.form_title = "Agregar Producto";
            $scope.showProducts = false;
            $scope.showForm = true;
        }
        //Edit a customer
        if(idAction == 2){
            $scope.currentAction = "edit";
            $scope.id = idProduct;
            $scope.form_title = "Editar Producto";
            var URL = API_URL + 'products/' + idProduct;
            $http.get(URL)
                .success(function(response) {
                    $scope.product = response;
                });
            $scope.showProducts = false;
            $scope.showForm = true;
        }
       
    }

    //Function to return at the previous menu
    $scope.backMenu = function(idDisplay){
        if(idDisplay == 1){
           $scope.showProducts = true;
           $scope.showForm = false;
        }
    }
    //Function to delete a customer
    $scope.confirmDelete = function(id) {
        var URL = API_URL + 'products/' + id;
       
        $http({
                method: 'DELETE',
                url: URL
        }).
            success(function(data) {     
                $scope.message = data;
                var URL= API_URL + "products";
                 $http.get(URL)
                        .success(function(response) {
                            $scope.products = response;
                        });
            }).
            error(function(data) {
                $scope.message = "Error al eliminar, por favor contacte al administrador";
            });
    }

    //save a new register or edit
    this.save = function() {

        var url = API_URL + "products";
        
        if ($scope.currentAction === 'edit'){
            url += "/" + $scope.id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.product),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
            console.log("success")
            $scope.message = response;
             $scope.initialize();
            $scope.showProducts = true;
            $scope.showForm = false;

        }).error(function(response) {
              $scope.message  = "Por favor verifica los campos";
        });
    }
    //Call function to init the view
     $scope.initialize();
});

app.directive('formProduct',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/form-products.html'
    }
});

app.directive('formAlerts',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/formalerts.html'
    }
});
