(function () {
  'use strict';
  
  angular
    .module('frapp')
    .controller('ApplicationController', ApplicationController)
  
  ApplicationController.$inject = ['$rootScope', 'Utils', 'config', 'ApplicationEntity'];
  
  function ApplicationController($rootScope, Utils, config, ApplicationEntity) {
    /*------------------------------------------------------------------
    Properties
    ------------------------------------------------------------------*/
    var ac = this;
    
    ac.getContentEvent = getContentEvent;
    
    ac.Utils = Utils;
    
    /*------------------------------------------------------------------
     Methods
     ------------------------------------------------------------------*/

    /*------------------------------------------------------------------
     Event Handling
     ------------------------------------------------------------------*/
    
    /*------------------------------------------------------------------
     Init
     ------------------------------------------------------------------*/
    
  }
})();