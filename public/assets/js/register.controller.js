(function(){
'use strict';


angular.module('harpoonAjaxLogin')
	.controller('Register', Register);

Register.$inject=['userAuthService','$state','$scope'];
function Register( userAuthService, $state, $scope ) {
	var DEFAULT_PASSWORD_INPUT_TYPE = 'password';
	var ALTERNATIVE_PASSWORD_INPUT_TYPE = 'text';

	var _this = this;
	_this.serverErrors = null;
	_this.passwordInputType = DEFAULT_PASSWORD_INPUT_TYPE;
	_this.togglePasswordInputType = togglePasswordInputType;
	_this.register = register;


	function togglePasswordInputType() {
		if (_this.passwordInputType === DEFAULT_PASSWORD_INPUT_TYPE) {
			_this.passwordInputType = ALTERNATIVE_PASSWORD_INPUT_TYPE;
		} else {
			_this.passwordInputType = DEFAULT_PASSWORD_INPUT_TYPE;			
		}
	}
	function register() {
		userAuthService.createAccount(_this.email, _this.password, _this.fullname).then(
			function onCreateAccountSuccess() {
				$state.go('app', {}, {
					reload: true
				});
			},
			function onCreateAccountError(serverErrors) {
				_this.serverErrors = serverErrors;
			}
		);
	}
}


})();