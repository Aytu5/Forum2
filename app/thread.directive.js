/**
 * Created by Alexander on 12/7/2015.
 */
angular
    .module("forum")
    .directive("threadTag", thread);

thread.$inject = ["$compile"];

function thread($compile){
    return {
        restrict: "E",
        replace: true,
        scope: {
            info: "="
        },
        templateUrl: "app/templates/thread.template.html"
    };
}