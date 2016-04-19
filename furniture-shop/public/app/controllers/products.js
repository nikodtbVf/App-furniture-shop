app.controller('productsController',function($scope,$http,API_URL) {
   
    $scope.showProducts = true;
    $scope.showAlert = false;
    $scope.message = "Nothing to show";
    //Initialize the view with the registered users from API
    $scope.initialize = function(){

         var URL= API_URL + "products";
         $http.get(URL)
                .success(function(response) {
                    $scope.products = response;
                });
    }

    //Add form to create products
    $scope.addForm = function(idAction,idProduct){
        //Create a product
        if(idAction == 1){
            $scope.currentAction = "add";
            $scope.form_title = "Agregar Producto";
            $scope.product = {};
            $scope.showProducts = false;
        }

        //Edit a product
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
        }
       
    }

    //Function to return at the previous menu
    $scope.backMenu = function(idDisplay){
        if(idDisplay == 1){
           $scope.showProducts = true;
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
                $scope.showAlert = true;
                var URL= API_URL + "products";
                $http.get(URL)
                    .success(function(response) {
                        $scope.products = response;

                    });
            }).error(function(data) {
                $scope.message = "Error al eliminar, por favor contacte al administrador";
                $scope.showAlert = true;
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
            $scope.message = response;
            $scope.initialize();
             $scope.showAlert = true;
            $scope.showProducts = true;

        }).error(function(response) {
            $scope.message  = "Por favor verifica los campos";
            $scope.showAlert = true;
        });
    }

    $scope.changeStateAlert = function(){
        if($scope.showAlert){
            $scope.showAlert = false;
        }else{
            $scope.showAlert = true;
        }
    };
    //Call function to init the view
     $scope.initialize();
});

app.directive('formProduct',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/form-products.html'
    }
});