'use strict';

/**
 * @ngdoc function
 * @name marineWhiteList.controller:ProviderProfileController
 * @description
 * # ProviderProfileController
 * Controller of the marineWhiteList
 */
angular.module('marineWhiteList')
  .controller('ProviderProfileController', 
    ['$scope', 'wordpressApi', function ($scope, wordpressApi) {

      $scope.user = {};
      $scope.dueType = 'good';
      $scope.isSuspended = false;

      $scope.loadUser = function(){
        wordpressApi.getCurrentProvider().then(function(response){
          $scope.user = response.data;

          $scope.checkDueDate();

        }, function(error){

        });
      }

      $scope.loadUser();

      $scope.checkDueDate = function(){
        if($scope.user && $scope.user.payment && $scope.user.payment.due_date){
          var dueDate = moment($scope.user.payment.due_date).diff(moment(), 'days', true);
          
          if(dueDate <= 0){
            $scope.dueType = 'debt';
            if(dueDate <= -6){
              $scope.isSuspended = true;
            }
          }else{
            if(dueDate <6){
              $scope.dueType = 'warn';
            }else{
              $scope.dueType = 'good';
            }
          }

        }else{
          $scope.isSuspended = false;
          $scope.dueType = 'good';
        }
      }

      $scope.parseDate = function(theDate){
        return moment(theDate).format('MMMM Do YYYY');
      }

      $scope.concatenateGlobal = function(url){
        return global_url + url;
      }



  }]);
