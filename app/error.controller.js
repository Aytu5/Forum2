/**
 * Created by Alexander on 12/9/2015.
 */
angular
    .module("forum")
    .controller("error", error);

error.$inject = ['$location']

function error($location){
    var vm = this;

    vm.error = $location.search().error;
}