function HomeCtrl($scope, testService, $http) {
    console.log('HomeCtrl');
    $scope.message = "Home controller";

    $http.get('/test').then(
        function(data) {
            console.log(data.data);
            $scope.data = data.data;
        },
        function(error) {
            console.error(error);
        }
    )
}

tourTime.controller('HomeCtrl', ['testService'], HomeCtrl);