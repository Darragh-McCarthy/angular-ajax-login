(function(){
'use strict';


angular.module('harpoonAjaxLogin')
	.controller('Login', Login);

Login.$inject=['userAuthService','$state'];
function Login( userAuthService, $state ) {
	var DEFAULT_PASSWORD_INPUT_TYPE = 'password';
	var ALTERNATIVE_PASSWORD_INPUT_TYPE = 'text';

	var _this = this;
	_this.isWrongUsernamePassword = false;
	_this.passwordInputType = DEFAULT_PASSWORD_INPUT_TYPE;
	_this.togglePasswordInputType = function togglePasswordInputType() {
		if (_this.passwordInputType === DEFAULT_PASSWORD_INPUT_TYPE) {
			_this.passwordInputType = ALTERNATIVE_PASSWORD_INPUT_TYPE;
		} else {
			_this.passwordInputType = DEFAULT_PASSWORD_INPUT_TYPE;			
		}
	}


	_this.login = function() {
		userAuthService.login(_this.username, _this.password, _this.remember).then(
			function loginSuccess(){
				$state.go("app", {}, {
					reload: true
				});
			},
			function loginError(){
				_this.isWrongUsernamePassword = true;
			}
		);
	}
}


})();