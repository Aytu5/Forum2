/**
 * Created by Alexander on 12/8/2015.
 */
angular
    .module("forum")
    .controller("createAccount", createAccount);

createAccount.$inject = ['$location'];

function createAccount($location){
    var vm = this;
    vm.isError = false;

    if("error" in $location.search()){
        vm.error = decodeURI($location.search().error);
        vm.isError = true;
    }

    console.log(vm.isError);
    console.log(vm.error);
}