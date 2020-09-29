const app = angular.module('login', []);
app.controller('loginCtrl', ($scope, $http) => {
  $scope.loginUser = () => {
    $http
      .post('../resources/process-login.php', {
        username: $scope.username,
        password: $scope.password,
      })
      .then((res) => {
        $scope.message = res.data.message;
        $scope.loggedIn = res.data.loggedIn;
        // console.log(res.data);
        $scope.username = null;
        $scope.password = null;
        $scope.loginForm.$setPristine();
        $scope.loginForm.$setUntouched();
      })
      .catch((err) => {
        console.error(err);
      });
  };
});
