'use strict';

/**
 * @ngdoc function
 * @name marineWhiteList.controller:AdminProfileController
 * @description
 * # AdminProfileController
 * Controller of the marineWhiteList
 */
angular.module('marineWhiteList')
  .controller('AdminProfileController', 
    ['$scope', '$uibModal', 'wordpressApi', function ($scope, $uibModal, wordpressApi) {

      $scope.user = {};

      $scope.loadUser = function(){
        wordpressApi.getCurrentUser().then(function(response){
          if(response.data.status === 'unauthorized'){
            window.location.replace(global_url);
          }else{
            $scope.user = response.data;
          }
          
        }, function(error){

        });
      }

      $scope.loadUser();


      $scope.parseDate = function(theDate){
        return moment(theDate).format('MMMM Do YYYY');
      }

      $scope.concatenateGlobal = function(url){
        return global_url + url;
      }

      $scope.openActivationModal = function(provider){
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'modalActivate.html',
          controller: 'modalActivateCtrl',
          resolve: {
            provider: function () {
              return provider;
            }
          }
        });

        modalInstance.result.then(function (provider) {
          wordpressApi.updateProvider(provider).then(function(response){
            var prov = response.data;
            
            for(var i=0; i<$scope.user.providers.length; i++){
              if($scope.user.providers[i].ID == prov.ID){
                $scope.user.providers[i] = prov;
                break;
              }
            }
          }, function(error){

          });
        }, function () {
        });
      }
  }]);





//MODAL CONTROLLER
angular.module('marineWhiteList')
.controller('modalActivateCtrl', function ($scope, $modalInstance, provider) {

  $scope.provr = angular.copy(provider);

  $scope.saveProvider = function () {
    $modalInstance.close($scope.provr);
  };

  $scope.parseDate = function(theDate){
    return moment(theDate).format('MMMM Do YYYY');
  }

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
});





