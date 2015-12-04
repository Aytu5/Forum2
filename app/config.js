/**
 * Created by Alexander on 12/2/2015.
 */
(function(){
    'use strict';

    angular
        .module("forum")
        .config(configure)
        .run(runBlock);

    function configure(){

    }

    runBlock.$inject = ["authenticator", "$rootScope"];

    function runBlock(authenticator, $rootScope){
        authenticator.initialize();


        $rootScope.$on('$routeChangeSuccess', function(){
            document.title += $route.current.title;

        });
        console.log("made it to the end of config");
        console.log($rootScope.authenticated);
    }

})();