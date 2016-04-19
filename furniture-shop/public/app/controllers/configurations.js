app.controller('configurationsController',function($scope,$http,API_URL) {
    
    $scope.message = "Nothing to show";
    $scope.showAlert = false;
    //Initialize the view with the registered users from API
    $scope.initialize = function(){
        var URL= API_URL + "configurations";
        $http.get(URL)
            .success(function(response) {
                $scope.configurations = response;
        });
    }

    //Form to edit 
    $scope.addForm = function(idConfig){

        $scope.id = idConfig;
        $scope.form_title = "Editar Configuracion";
        var URL = API_URL + 'configurations/' + idConfig;
        $http.get(URL)
            .success(function(response) {
                $scope.configuration = response;
        });
        $scope.showConfigs = false; 
    }

    //Function to return at the previous menu
    $scope.backMenu = function(idDisplay){
        if(idDisplay == 1){
           $scope.showConfigs = true;
           $scope.showForm = false;
        }
    }

    //save a edit register
    this.save = function() {

        var url = API_URL + "configurations/" + $scope.id;
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.configuration),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
           
            $scope.message = response;
            $scope.initialize();
            $scope.showConfigs = true;
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

app.directive('formConfigurations',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/form-configurations.html'
    }
});