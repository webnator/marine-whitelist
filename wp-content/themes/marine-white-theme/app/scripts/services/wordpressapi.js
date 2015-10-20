'use strict';

/**
 * @ngdoc service
 * @name marineWhiteList.wordpressApi
 * @description
 * # wordpressApi
 * Factory in the marineWhiteList.
 */
angular.module('marineWhiteList')
  .factory('wordpressApi', ['$http', function ($http) {
    
    var host = global_url + '/php_functions/marineapi.php';
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

    function getCurrentProvider(){

      var post_data = {
        'action':'get_provider'
      };

      return $http.post(host, post_data);
    }

    function getCurrentUser(){

      var post_data = {
        'action':'get_user'
      };

      return $http.post(host, post_data);
    }

    function updateProvider(provider){

      var post_data = {
        'action':'update_provider', 
        'provider':provider
      };

      return $http.post(host, post_data);
    }


    return {
      getCurrentProvider: getCurrentProvider,
      getCurrentUser: getCurrentUser,
      updateProvider: updateProvider
    };
  }]);
