(function() {

    'use strict';

    angular.module('authApp')
        .controller('UserController', UserController);
    function UserController($http,$rootScope,$auth,$state,$scope) {
        $scope.user = null;
        $scope.error = null;
        $scope.form = {};
        $scope.updating = null;

        var url = "api/skill";
        var successCallback = function (response) {
            $scope.skills = response.data;
            $scope.form = {};
            $scope.updating = null;
        };
        var errorCallback = function (response) {
            $scope.error = response;
        };
        var beforeRequest = function () {
            console.log("Requesting ...");
        };

        $http.get(url).then(successCallback,errorCallback);

        $scope.save = function () {
            beforeRequest();
            $http.post(url,$scope.form).then(successCallback,errorCallback);
        };

        $scope.delete = function (skill) {
            $http.delete(url+"/"+skill.id).then(successCallback,errorCallback);
        };

        $scope.update = function (skill) {
            $http.put(url+"/"+skill.id,skill).then(successCallback,errorCallback);
        };

        $scope.edit = function (skill) {
            $scope.updating = skill.id;
        };

        // This request will hit the index method in the AuthenticateController
        // on the Laravel side and will return the list of users
        $http.get('api/authenticate').then(function(res) {
            $scope.user = res.data;
            $rootScope.currentUser = res.data;
        },function(error) {
            $scope.error = error;
        });

        $scope.logout = function() {
            $http.get("api/logout").then(function () {
                $state.go('auth', {});
                $auth.logout().then(function() {
                    $rootScope.currentUser = null;
                });
            });
        }

    }

})();
