/**
 * Created by Alexander on 12/7/2015.
 */

angular
    .module("forum")
    .controller("home", home);

home.$inject = ["data"];

function home(data){
    var vm = this;

    run(vm, data)
}


function run(vm, data){
    data.rootThreads(0, 10).then(function(results){
        vm.threads = results;
    });
}