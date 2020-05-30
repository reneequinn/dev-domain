const app = angular.module('details', []);
app.controller('detailsCtrl', ($scope, $http) => {
  $scope.updateUser = () => {
    $http
      .post('../resources/process-details.php', {
        username: $scope.username,
        firstName: $scope.firstName,
        lastName: $scope.lastName,
        email: $scope.email,
        phone: $scope.phone,
        password: $scope.password,
      })
      .then((res) => {
        $scope.message = res.data.message;
        $scope.success = res.data.success;
        // console.log(res.data);
        if ($scope.success) {
          $scope.username = res.data.username;
          $scope.firstName = res.data.firstName;
          $scope.lastName = res.data.lastName;
          $scope.email = res.data.email;
          $scope.phone = res.data.phone;
        }
        $scope.password = null;
        $scope.updateForm.$setPristine();
        $scope.updateForm.$setUntouched();
      })
      .catch((err) => {
        console.error(err);
      });
  };
});
