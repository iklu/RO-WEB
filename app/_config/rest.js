(function () {
  'use strict';

  angular
    .module('frapp')
    .factory('RestServiceInterceptor', RestServiceInterceptor)
    .factory('RestService', RestService);
  
  function RestServiceInterceptor() {
    return {
      response: function (response) {
        response.$httpStatus = response.status;

        return response;
      }
    };
  }
  
  RestService.$inject = ['$resource', 'RestServiceInterceptor', 'config'];

  function RestService($resource, RestServiceInterceptor, config) {
    var defaultParams = {},
    determineApi = function (path, parameters) {
      var keys = Object.keys(parameters);
      for (var i = 0; i < keys.length; i++) {
        path = path.replace(':' + keys[i], parameters[keys[i]]);
      }

      return config.api + path;
    };
    
    return {
      search: function (parameters) {
        console.log(parameters); 
        var searchValue = parameters.searchValue;
        return $resource(config.api + 's=:searchValue&page=:searchPage', parameters, {
          get: {
            method: 'GET',
            params: {},
            interceptor: RestServiceInterceptor,
            headers: {
              'Content-Type': 'application/json'
            }
          }
        })
      },
      
      google: function (parameters) {
        return $resource(config.google.urlShortner + config.google.apiKey, defaultParams, {
          post: {
            method: 'POST',
            params: {},
            interceptor: RestServiceInterceptor,
            headers: {
              'Content-Type': 'application/json'
            }
          }
        })
      },
      
      image: function (parameters) {
        return $resource(':imageUrl', { imageUrl: '@imageUrl' }, {
          get: {
            method: 'GET',
            params: {},
            interceptor: RestServiceInterceptor,
            headers: {
              'Content-Type': 'application/json'
            }
          }
        })
      }
    };
  }
})();