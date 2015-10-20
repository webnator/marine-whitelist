'use strict';

/**
 * @ngdoc overview
 * @name marineWhiteList
 * @description
 * # marineWhiteList
 *
 * Main module of the application.
 */
angular
  .module('marineWhiteList', [
    'ngResource',
    'ngRoute',
    'ui.bootstrap'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/provider-profile', {
        templateUrl: global_url+'/app/views/provider-profile.html',
        controller: 'ProviderProfileController'
      })
      .when('/admin-profile', {
        templateUrl: global_url+'/app/views/admin-profile.html',
        controller: 'AdminProfileController'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
