(function() {
    'use strict';
    angular.module('authApp')
        .controller('SettingsController', ['$scope','$http', function ($scope,$http) {
            $scope.settings = null;
            $scope.error = null;
            $scope.options = [
                'Everyone',
                'Only me',
                'Only those who are following me',
                'Only those I am following'
            ];

            $http.get("api/setting").then(
                function (res) {
                    $scope.settings = res.data;
                },
                function (res) {
                    $scope.error = res.data;
                }
            );

            $scope.saveSettings = function () {
                $http.put("api/setting/"+$scope.settings.id, $scope.settings).then(
                    function (res) {
                        $scope.message = res.data;
                    },
                    function (res) {
                        $scope.error = res.data;
                    }
                );
            };

        }])
;

})();