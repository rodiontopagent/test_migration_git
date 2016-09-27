function router($routeProvider, $locationProvider) {
    $routeProvider
        .when('/', {
            templateUrl: '/application/partials/_home.html',
            controller: HomeCtrl
        })
        .when('/test', {
            templateUrl: '/application/partials/_test.html',
            controller: TestCtrl
        })
        .when('/db_test', {
            templateUrl: '/application/partials/_bd-test.html',
            controller: DBTestCtrl
        })
        .otherwise({
            redirectTo: '/'
        });

    $locationProvider.html5Mode(true);
}

tourTime.config(router);