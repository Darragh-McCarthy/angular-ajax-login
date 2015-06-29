(function(){
'use strict';


angular.module('harpoonAjaxLogin')
	.factory('userAuthService', UserAuthService);


UserAuthService.$inject=['$http','$window','$q'];
function UserAuthService( $http,  $window, $q ) {
	var LOGGED_OUT_USER_SCREEN_NAME = 'Guest';
	var isLoggedIn = $window.isUserLoggedIn;
	var screenName = $window.userScreenName;

	return {
		'login': login,
		'logout': logout,
		'isLoggedIn': isLoggedInFunc,
		'getScreenName': getScreenName,
		'createAccount': createAccount
	};

	function getScreenName() {
		return screenName;
	}
	function isLoggedInFunc() {
		return isLoggedIn;
	}

	function logout() {
		return $http.get('/ajaxlogin/logout').then(
				function logoutSuccess(response) {
					screenName = LOGGED_OUT_USER_SCREEN_NAME;
					isLoggedIn = false;
				},
				function logoutError(response) {
					console.log(response);
				}
			);
	}
	function login(email, password, remember) {
		return $http.post('/ajaxlogin/login', {
				'username': email,
				'password': password,
				'remember': remember
			})
			.then(
				function loginSuccess(response) {
					if ( ! response.data.is_logged_in) {
						console.log('loginSuccess handler returned not logged in')
						return $q.reject();
					}
					console.log(response);
					console.log('fullname', response.data.data.fullname);
					screenName = response.data.data.fullname;
					isLoggedIn = true;
				},
				function loginError(response) {
					console.log(response);
				}
			);
	}
	function createAccount(email, password, fullname) {
		return $http.post('/ajaxlogin/register', {
				'email': email,
				'password': password,
				'fullname': fullname
			})
			.then(
				function registerSuccess(response) {
					if ( ! response.data.is_account_creation_success) {
						return $q.reject(response.data.errors);
					}
					screenName = fullname;
					isLoggedIn = true;
				},
				function registerError(response) {
					console.log(response);
				}
			);
	}

}


})();