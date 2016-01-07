<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Angular-Laravel Authentication</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
</head>
<body ng-app="authApp">

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Laravel + Angular Sandbox</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" ng-controller="UserController as user">
                <li><a href="#/home">Home</a></li>
                <li><a href="#/users">Explore Other Users</a></li>
                <li><a href="#/settings">Settings</a></li>
                <li><a href="javascript:void(0)" ng-click="logout()">Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <div ui-view></div>
</div>

</body>

<!-- Application Dependencies -->
<script src="node_modules/angular/angular.js"></script>
<script src="node_modules/angular-ui-router/release/angular-ui-router.js"></script>
<script src="node_modules/satellizer/satellizer.js"></script>
<script src="node_modules/ui-bootstrap.min.js"></script>

<!-- Application Scripts -->
<script src="scripts/app.js"></script>
<script src="scripts/authController.js"></script>
<script src="scripts/userController.js"></script>
<script src="scripts/usersController.js"></script>
<script src="scripts/settingsController.js"></script>
</html>