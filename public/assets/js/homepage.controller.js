(function(){
'use strict';


angular.module('harpoonAjaxLogin')
	.controller('Homepage', Homepage);

Homepage.$inject=[];
function Homepage() {
	var _this = this;
	_this.homepageTestText = 'Homepage goes here';
}


})();