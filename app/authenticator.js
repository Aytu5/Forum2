/**
 * Created by Alexander on 12/2/2015.
 */
(function(){
    'use strict';

    angular
        .module('forum')
        .factory('authenticator', authenticator);

    authenticator.$inject = ["$rootScope", "data"];

    function authenticator($rootScope, data){
        return {
            initialize: initialize
        };

        function initialize(){
            $rootScope.authenticated = false;
            //console.log("initialize hit");
            data.session().then(function(response){
                //console.log(response);
                if(response.user){
                    //console.log("user found");
                    $rootScope.authenticated = true;
                    $rootScope.user = response.user;
                }
            })
        }
    }
})();