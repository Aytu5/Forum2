/**
 * Created by Alexander on 12/8/2015.
 */
angular
    .module("forum")
    .directive("comment", comment);

comment.$inject = ["$compile"];

function comment($compile){
    return{
        restrict: "E",
        replace: true,
        scope: {
            info: "="
        },
        templateUrl: "app/templates/comment.template.html",
        link: function(scope, element, attrs){
            if(angular.isArray(scope.info.replies)){
                element.replaceWith($compile("<thread-tag info='info' ></thread-tag>")(scope));
            }
        }
    }
}