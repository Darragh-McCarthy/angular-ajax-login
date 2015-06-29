(function(){
'use strict';

angular.module('harpoonAjaxLogin')
    .config(configureRoutes)
    .run(logStateChangeErrors)
    //.run(requiredLogin);



configureRoutes.$inject=['$stateProvider','$urlRouterProvider'];
function configureRoutes( $stateProvider,  $urlRouterProvider ) { 
    $stateProvider
      .state('app', {
        url: '',
        //abstract: true,
        views: {
          'content': {
            templateUrl: '/templates/homepage.template.html',
            controller: 'Homepage as homepage',
          },
          'header': { 
            templateUrl: '/templates/header.template.html',
            controller: 'Header as header',
          }
        }
      })
      .state('app.login', {
        url: '/accounts/login',
        views: {
          'content@': {
            templateUrl: '/templates/login.template.html',
            controller: 'Login as login',
            resolve: { 'previousState': getPreviousState }
          }
        }
      })
      .state('app.register', {
        url: '/accounts/register',
        views: {
          'content@': {
            templateUrl: '/templates/register.template.html',
            controller: 'Register as register',
            resolve: { 'previousState': getPreviousState }
          }
        }
      })
      .state('app.forgot-password', {
        url: '/accounts/forgot-password',
        views: {
          'content@': {
            templateUrl: '/templates/forgot-password.template.html',
            controller: 'ForgotPassword as forgotPassword',
          }
        }
      });




    $urlRouterProvider.otherwise( function($injector, $location) {
      var $state = $injector.get("$state");
      $state.go("app");
    });
}





logStateChangeErrors.$inject=['$rootScope'];
function logStateChangeErrors( $rootScope ) {
    $rootScope.$on("$stateChangeError", console.log.bind(console));
}

requiredLogin.$inject=['$rootScope','$state','userAuthService'];
function requiredLogin( $rootScope,  $state,  userAuthService) {
  $rootScope.$on('$stateChangeStart', function(e, toState, toParams, fromState, fromParams) {
      if ( ! userAuthService.isLoggedIn() && toState.name !== "app.login" ) {
        $state.go('app.login');
        e.preventDefault();
      }
  });
}


getPreviousState.$inject=["$state"]
function getPreviousState($state) {
  var currentStateData = null;
  if ($state.current && $state.current.name) {
    var currentStateData = {
      name:   $state.current.name,
      params: $state.params,
      url:    $state.href($state.current.name, $state.params)
    };
  }
  return currentStateData;
}



})();