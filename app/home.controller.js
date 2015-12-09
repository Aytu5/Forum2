/**
 * Created by Alexander on 12/7/2015.
 */

angular
    .module("forum")
    .controller("home", home);

home.$inject = ["data", "$location"];

function home(data, $location){
    var vm = this;
    //vm.numResults = 11;
    vm.onPageChange = onPageChange;
    vm.isError = false;

    if("error" in $location.search()){
        vm.error = decodeURI($location.search().error);
        vm.isError = true;
    }

    run(vm, data)


    function onPageChange(newPage){
        data.rootThreads(newPage * 10 - 10, 10).then(function(results){
            vm.numResults = results.shift();
            vm.threads = results;
        })
    }
}


function run(vm, data){
    data.rootThreads(0, 10).then(function(results){
        console.log(results);
        var numResults = results.shift();
        console.log(numResults);
        vm.numResults = numResults;
        vm.threads = results;
    });
}

