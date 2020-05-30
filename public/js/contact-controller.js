const app = angular.module('contact', []);
app.controller('contactCtrl', ($scope) => {
  $scope.handleSubmit = () => {
    $scope.success = true;
  };
});
