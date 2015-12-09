/**
 * Created by Alexander on 12/8/2015.
 */
angular
    .module("forum")
    .directive("comment", comment);

comment.$inject = ["$compile", "isAuth"];

function comment($compile, isAuth){
    return{
        restrict: "E",
        replace: true,
        scope: {
            info: "=",
            //authenticated: isAuth.authenticated
        },
        templateUrl: "app/templates/comment.template.html",
        link: function(scope, element){
            if(angular.isArray(scope.info.replies)){
                element.replaceWith($compile("<thread-tag info='info' ></thread-tag>")(scope));
            }
        }
    }
}