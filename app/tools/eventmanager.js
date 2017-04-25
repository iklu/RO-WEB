(function() {
  'use strict';

  angular
    .module('frapp')
    .factory('EventManager', EventManager);

  function EventManager() {
    var _channel = angular.element({});

    return {
      // Binds to a specific 'event'.
      subscribe: function(event, callback) {
        _channel.on(event, function(e, data) {
          if (angular.isFunction(callback)) {
            callback(e, data);
          }

          _channel.off(event, callback);
        });

        return this;
      },

      unsubscribe: function(event) {
        _channel.off(event);

        return this;
      },

      // Triggers a specific 'event'.
      publish: function(event, data) {
        var parts = event.split(' ');

        for (var i = 0; i < parts.length; i++) {
          _channel.trigger(parts[i], data);
        }

        return this;
      }
    };
  }
})();