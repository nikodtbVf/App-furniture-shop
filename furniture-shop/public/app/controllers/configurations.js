app.controller('configurationsController',function($scope,$http,API_URL) {
    
    $scope.showConfigs = true;
    $scope.showForm = false;
    $scope.message = "Nothing to show";
    //Initialize the view with the registered users from API
    $scope.initialize = function(){
        console.log("initialize")
         var URL= API_URL + "configurations";
         $http.get(URL)
                .success(function(response) {
                    $scope.configurations = response;
                });
    }

    //Add form to create
    $scope.addForm = function(idAction,idConfig){
      
        //Edit a config
        if(idAction == 2){
            $scope.currentAction = "edit";
            $scope.id = idConfig;
            $scope.form_title = "Editar Configuracion";
            var URL = API_URL + 'configurations/' + idConfig;
            $http.get(URL)
                .success(function(response) {
                    $scope.configuration = response;
                });
            $scope.showConfigs = false;
            $scope.showForm = true;
        }
       
    }

    //Function to return at the previous menu
    $scope.backMenu = function(idDisplay){
        if(idDisplay == 1){
           $scope.showConfigs = true;
           $scope.showForm = false;
        }
    }
    //Function to delete a customer
    $scope.confirmDelete = function(id) {
        var URL = API_URL + 'configurations/' + id;
       
        $http({
                method: 'DELETE',
                url: URL
        }).
            success(function(data) {     
                $scope.message = data;
                var URL= API_URL + "configurations";
                 $http.get(URL)
                        .success(function(response) {
                            $scope.configurations = response;
                        });
            }).
            error(function(data) {
                $scope.message = "Error al eliminar, por favor contacte al administrador";
            });
    }

    //save a new register or edit
    this.save = function() {

        var url = API_URL + "configurations";
        
        if ($scope.currentAction === 'edit'){
            url += "/" + $scope.id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.configuration),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
            $scope.message = response;
            $scope.initialize();
            $scope.showConfigs = true;
            $scope.showForm = false;

        }).error(function(response) {
              $scope.message  = "Por favor verifica los campos,asegurate que tu email y rfc sean validos";
        });
    }
    //Call function to init the view
    $scope.initialize();
});

app.directive('formConfigurations',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/form-configurations.html'
    }
});

app.directive('formAlerts',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/formalerts.html'
    }
});

