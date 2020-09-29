const app = angular.module('register', []);
app.controller('registerCtrl', ($scope, $http) => {
  $scope.registerUser = () => {
    $http
      .post('../resources/process-register.php', {
        username: $scope.username,
        firstName: $scope.firstName,
        lastName: $scope.lastName,
        email: $scope.email,
        phone: $scope.phone,
        password: $scope.password,
        passwordConfirm: $scope.passwordConfirm,
      })
      .then((res) => {
        $scope.message = res.data.message;
        $scope.success = res.data.success;
        // console.log(res.data);
        $scope.username = null;
        $scope.firstName = null;
        $scope.lastName = null;
        $scope.email = null;
        $scope.phone = null;
        $scope.password = null;
        $scope.passwordConfirm = null;
        $scope.regForm.$setPristine();
        $scope.regForm.$setUntouched();
      })
      .catch((err) => {
        console.error(err);
      });
  };
});

app.directive('passwordVerify', function () {
  return {
    require: 'ngModel',
    scope: {
      passwordVerify: '=',
    },
    link: function (scope, element, attrs, ctrl) {
      scope.$watch(
        function () {
          var combined;

          if (scope.passwordVerify || ctrl.$viewValue) {
            combined = scope.passwordVerify + '_' + ctrl.$viewValue;
          }
          return combined;
        },
        function (value) {
          if (value) {
            ctrl.$parsers.unshift(function (viewValue) {
              var origin = scope.passwordVerify;
              if (origin !== viewValue) {
                ctrl.$setValidity('passwordVerify', false);
                return undefined;
              } else {
                ctrl.$setValidity('passwordVerify', true);
                return viewValue;
              }
            });
          }
        }
      );
    },
  };
});
