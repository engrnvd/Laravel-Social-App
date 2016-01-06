(function() {
    'use strict';
    angular.module('authApp')
        .controller('UsersController', ['$scope','$http', '$uibModal', function ($scope,$http,$uibModal) {
            $scope.users = [];
            $scope.error = null;

            $http.get("api/users").then(function (res) {
                $scope.users = res.data;
            }, function (res) {
                $scope.error = res.data;
            });

            $scope.showDetails = function (user) {
                $uibModal.open({
                    templateUrl: 'views/user-details.html',
                    controller: 'ModalInstanceCtrl',
                    resolve: {
                        user: function () {
                            return user;
                        }
                    }
                });
            };

        }])

        .controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, $http, user) {
            $scope.user = user;
            $scope.skills = [];
            $scope.followers = [];
            $scope.following = [];
            $scope.error = null;

            $http.get("api/skill/user/"+user.id).then(function (res) {
                $scope.skills = res.data;
            });

            $http.get("api/user/"+user.id+"/following").then(function (res) {
                $scope.following = res.data;
            });

            $http.get("api/user/"+user.id+"/followers").then(function (res) {
                $scope.followers = res.data;
            });

            $scope.follow = function () {
                $http.get("api/user/follow/"+$scope.user.id).then(function () {
                    $uibModalInstance.close();
                }, function (res) {
                    $scope.error = res.data;
                });
            };

            $scope.cancel = function () {
                $uibModalInstance.dismiss('cancel');
            };
        });

})();