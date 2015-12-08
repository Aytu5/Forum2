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
        vm.base = "classdb.it.mtu.edu/~ajdavid/HW9/Forum2/";
    }
})();