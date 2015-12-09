/**
 * Created by Alexander on 12/8/2015.
 */
angular
    .module("forum")
    .factory("isAuth", isAuth);

isAuth.$inject = ["$rootScope"]

function isAuth($rootScope){
    return{
        authenticated: $rootScope.authenticated
    }
}