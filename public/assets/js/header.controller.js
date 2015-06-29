(function(){
'use strict';


angular.module('harpoonAjaxLogin')
	.controller('Header', Header);

Header.$inject=['$window','userAuthService','$state'];
function Header( $window, userAuthService, $state ) {
	var _this = this;
	_this.userScreenName = userAuthService.getScreenName();
	if (_this.userScreenName === 'Guest') {
		_this.userScreenName = null;
	}
	_this.isUserLoggedIn = userAuthService.isLoggedIn();

	_this.logout = function(){
		userAuthService.logout().then(
			function logoutSuccessful(){
				$state.go($state.current, {}, {
					reload: true
				});
			}
		);
	}



}


})();