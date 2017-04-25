(function () {
  'use strict';
  
  angular
    .module('frapp')
    .factory('Utils', Utils);
  
  function Utils (){
    return {
      appLoading: false,
      
      generateNumberBetweenInterval: function(min, max) {
        return Math.floor(Math.random() * (max-min+1) + min)
      }
    }
  }
})();