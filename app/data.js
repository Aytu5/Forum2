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
            login: login,
            rootThreads: rootThreads,
            getThread: getThread
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

        function rootThreads(offset, number){
            return $http.get("api/getThreads", {"params": {"offset": offset, "number": number}}).then(function(results){
                return results.data;
            })
        }

        function getThread(id){
            return $http.get("api/getThread", {"params": {"id": id}}).then(function(results){
                return results.data;
            })
        }
    }
})();