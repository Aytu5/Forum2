/**
 * Created by Alexander on 12/2/2015.
 */
(function(){
    'use strict';

    angular
        .module("forum")
        .controller("index", index);


    function index(){
        var vm = this;
        vm.test = "TEST";
        this.test2 = "test2";
        vm.boolean = true;
        console.log("made it to the end of controller");
    }
})();