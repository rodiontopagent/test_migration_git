function HomeCtrl($scope, testService) {
    console.log('HomeCtrl');
    $scope.message = "Home controller";

    testService.findAll().then(function(user) {
        console.log(user);
    })
}

tourTime.controller('HomeCtrl', ['testService'], HomeCtrl);