(function(){
'use strict';

angular.module('harpoonAjaxLogin')
	.directive('input', FocusTextInputsOnMouseover);

function FocusTextInputsOnMouseover() {
	return function(scope, element, attrs) {
		angular.forEach(attrs,function(a, key){
			if (key === 'type' && attrs[key] === 'text' || attrs[key] === 'password' || attrs[key] === 'email'){
				element.on('mouseover', function() {
					element[0].focus();					
				});
			}
		});
	}
}

})();