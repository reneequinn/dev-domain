const app = angular.module('pass', []);
app.controller('passCtrl', ($scope, $http) => {
  $scope.updatePass = () => {
    $http
      .post('../resources/process-pass.php', {
        username: $scope.username,
        currentPass: $scope.currentPass,
        newPass: $scope.newPass,
        confirmPass: $scope.confirmPass,
      })
      .then((res) => {
        $scope.message = res.data.message;
        $scope.success = res.data.success;
        // console.log(res.data);
        $scope.currentPass = null;
        $scope.newPass = null;
        $scope.confirmPass = null;
        $scope.passForm.$setPristine();
        $scope.passForm.$setUntouched();
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
