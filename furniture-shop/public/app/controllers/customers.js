app.controller('customersController',function($scope,$http,API_URL) {
    
    $scope.showCustomers = true;
    $scope.showAlert = false;
    $scope.message = "Nothing to show";
    
    //Initialize the view with the registered users from API
    $scope.initialize = function(){
         var URL= API_URL + "customers";
         $http.get(URL)
                .success(function(response) {
                    $scope.customers = response;
                });
    }

    //Add form to create users
    $scope.addForm = function(idAction,idCustomer){
        //Create a customer
        if(idAction == 1){
            $scope.currentAction = "add";
            $scope.form_title = "Agregar Cliente";
            $scope.showCustomers = false;
            $scope.customer ={};
        }
        //Edit a customer
        if(idAction == 2){
            $scope.currentAction = "edit";
            $scope.id = idCustomer;
            $scope.form_title = "Editar Cliente";
            var URL = API_URL + 'customers/' + idCustomer;
            $http.get(URL)
                .success(function(response) {
                    $scope.customer = response;
                });
            $scope.showCustomers = false;
        }
       
    }

    //Function to return at the previous menu
    $scope.backMenu = function(idDisplay){
        if(idDisplay == 1){
           $scope.showCustomers = true;
        }
    }
    //Function to delete a customer
    $scope.confirmDelete = function(id) {
        var URL = API_URL + 'customers/' + id;
       
        $http({
                method: 'DELETE',
                url: URL
        }).
            success(function(data) { 
                $scope.message = data; 
                $scope.showAlert = true;   
                $scope.initialize();
            }).
            error(function(data) {
                $scope.message = "Error al eliminar, por favor contacte al administrador";
                $scope.showAlert = true;  
            });
    }

    //save a new register or edit
    this.save = function() {

        var url = API_URL + "customers";
        
        if ($scope.currentAction === 'edit'){
            url += "/" + $scope.id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.customer),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
            
            $scope.message = response;
            $scope.initialize();
            $scope.showCustomers = true;
            $scope.showAlert = true;  

        }).error(function(response) {
            $scope.message  = "Por favor verifica los campos,asegurate que tu email y rfc sean validos";
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

app.directive('formCustomer',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/form.html'
    }
});
