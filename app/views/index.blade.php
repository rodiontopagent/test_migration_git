<!DOCTYPE html>
<html lang="en" ng-app="tourTime">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Angular Laravel</title>

    <base href="/">

</head>
<body>

<header class="header">
    <nav class="navigation">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/test">Test</a></li>
            <li><a href="/db_test">DB Test</a></li>
        </ul>
    </nav>
</header>


    <section ng-view></section>

<!-- Scripts -->
<script src="{{ asset('node_modules/angular/angular.js') }}"></script>
<script src="{{ asset('node_modules/angular-route/angular-route.js') }}"></script>
<script src="{{ asset('node_modules/js-data/dist/js-data.js') }}"></script>
<script src="{{ asset('node_modules/js-data-angular/dist/js-data-angular.js') }}"></script>
<!-- Application -->
<script src="{{ asset('application/app.js') }}"></script>
<script src="{{ asset('application/routes.js') }}"></script>
<!--Controllers-->
<script src="{{ asset('application/controllers/HomeCtrl.js') }}"></script>
<script src="{{ asset('application/controllers/TestCtrl.js') }}"></script>
<script src="{{ asset('application/controllers/DBTestCtrl.js') }}"></script>
<!--Services-->
<script src="{{ asset('application/services/services/services.service.js') }}"></script>
<script src="{{ asset('application/services/services/services/test.service.js') }}"></script>



</body>
</html>