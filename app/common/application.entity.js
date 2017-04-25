(function () {
  'use strict';
  
  angular
    .module('frapp')
    .factory('ApplicationEntity', ApplicationEntity)
  
  function ApplicationEntity() {
    return {
      someProp: '',
      anotherProp: ''
    }
  }
})();