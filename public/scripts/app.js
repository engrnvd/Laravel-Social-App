(function() {

    'use strict';

    angular
        .module('authApp', ['ui.router', 'satellizer','ui.bootstrap'])
        .config(function($stateProvider, $urlRouterProvider, $authProvider) {

            // Satellizer configuration that specifies which API
            // route the JWT should be retrieved from
            $authProvider.loginUrl = '/api/authenticate';

            // Redirect to the auth state if any other states
            // are requested other than users
            $urlRouterProvider.otherwise('/auth');

            $stateProvider
                .state('users', {
                    url: '/users',
                    templateUrl: '../views/usersView.html',
                    controller: 'UsersController'
                })
                .state('auth', {
                    url: '/auth',
                    templateUrl: '../views/authView.html',
                    controller: 'AuthController as auth'
                })
                .state('home', {
                    url: '/home',
                    templateUrl: '../views/userView.html',
                    controller: 'UserController as user'
                });
        });
})();