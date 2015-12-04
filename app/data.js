/**
 * Created by Alexander on 12/2/2015.
 */
(function(){
    'use strict';

    angular
        .module("forum")
        .factory("data", data);

    data.$inject = ['$http'];

    function data($http){
        return {
            session: session,
            login: login
        };

        //////////////////

        function login(username, password){
            return $http.post("/api/login", {username: username, password: password});
        }

        function session(){
            return $http.get("api/session").then(function(results){
                return results.data;
            })
        }
    }
})();