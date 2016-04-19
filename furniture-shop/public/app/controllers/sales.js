app.controller('salesController',function($scope,$http,API_URL) {
   
    $scope.showSales = true;
    $scope.showForm = false;
    $scope.showPaySale = false;
    $scope.showMonthsPayments = false;
    $scope.showAlert = false;
    $scope.message = "Nothing to show";
    $scope.realpay;
    $scope.customers = new Array();
    $scope.products = new Array();
    

    //Initialize the view with the registered users from API
    $scope.initialize = function(){
        $scope.sale  = { };

        var URL= API_URL + "sales";
        $http.get(URL)
                .success(function(response) {
                    $scope.sales = response;
        });   
        $http.get(API_URL + "customers")
            .success(function(response){
                $scope.customers = response;
        });

        $http.get(API_URL + "products")
            .success(function(response){
                $scope.products = response;
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
            $scope.sale = {};
          
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
    //Function to delete a sale
    $scope.confirmDelete = function(id) {
        var URL = API_URL + 'sales/' + id;
       
        $http({
                method: 'DELETE',
                url: URL
        }).
            success(function(data) {     
                $scope.message = data;
                $scope.showAlert = true;
                var URL= API_URL + "sales";
                 $http.get(URL)
                        .success(function(response) {
                            $scope.sales = response;
                        });
            }).
            error(function(data) {
                $scope.message = "Error al eliminar, por favor contacte al administrador";
                $scope.showAlert = true;
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
            
            $scope.message = response;
            $scope.initialize();
            $scope.showSales = true;
            $scope.showForm = false;
            $scope.showPaySale = false;
            $scope.showAlert = true;

        }).error(function(response) {
              $scope.message  = "Por favor verifica los campos";
              $scope.showAlert = true;
        });
    }


    //Show a sale to give a initial pay
    $scope.showSale = function(idSale){    
         var URL= API_URL + "showSale/"+idSale;
         $http.get(URL)
                .success(function(response) {
                    $scope.saleShow = response;
                    $scope.realpay =  $scope.saleShow.firstpay;
                    $scope.showSales = false;
                    $scope.showForm = false;
                    $scope.showPaySale = true;
                });
    }


    $scope.payment = function(id){
    
        $scope.saleShow.firstpay = $scope.realpay;
        
        var URL= API_URL + "sales/"+id;
        $http({
            method: 'POST',
            url: URL,
            data: $.param($scope.saleShow),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {

        }).error(function(response) {

        });
    }

    $scope.showPaymentsMonth = function(id){
        
        $scope.showMonthsPayments = true;
        $scope.pays  = new Array();
        var totalPay = $scope.saleShow.subtotal - $scope.saleShow.firstpay;
        var interestsPay = $scope.saleShow.interests -  $scope.saleShow.bonus;  
        var months  = $scope.saleShow.numbers_months;
        var repeat = months/3;

        //Obtain the remain interests by month
        var interestsByMonth = interestsPay/months;
       
        for (var i = 1; i <= repeat; i++) {
            
            //Calculate the interests and payments if the user give the initial pay  
            var actualMonth = i*3;
            //Obtain the pay for the remaing without initialpay
            var payPerMonth = totalPay / actualMonth;    
            //Obtain the interests to pay
            var interestsTotalPay = interestsByMonth*actualMonth;
            //Save to early pay 
            var saveInterests = interestsPay - interestsTotalPay;

            $scope.pays.push(new Array(actualMonth,payPerMonth+interestsByMonth,saveInterests));
        }
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

app.directive('formSale',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/form-sale.html'
    }
});

app.directive('showProduct',function(){
    return{
        restrict:'E',
        templateUrl: 'directives/show-products.html'
    }
});

