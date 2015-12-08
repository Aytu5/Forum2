/**
 * Created by Alexander on 12/7/2015.
 */
angular
    .module("forum")
    .controller("thread", thread);

thread.$inject = ["data", "$location"];

function thread(data, $location){
    var vm = this;

    vm.id = $location.search().id;
    console.log($location.search().id);


    run(vm, data, $location.search().id);
}

function run(vm, data, id){
    data.getThread(id).then(function(results){
        vm.thread = results;
        console.log(results);
    });
}