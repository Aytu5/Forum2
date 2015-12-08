/**
 * Created by Alexander on 12/2/2015.
 */
(function(){
    'use strict';

    angular
        .module("forum")
        .config(configure)
        .run(runBlock);

    configure.$inject = ["$locationProvider"];

    function configure($locationProvider){
        $locationProvider.html5Mode(true);

    }

    runBlock.$inject = ["authenticator", "$rootScope"];

    function runBlock(authenticator, $rootScope){
        authenticator.initialize();


        //$rootScope.$on('$routeChangeSuccess', function(){
        //    document.title += $route.current.title;
        //
        //});
    }

})();