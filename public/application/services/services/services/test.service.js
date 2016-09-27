'use strict';

angular.module('tourTime.services').factory('testService', ['DS', function(DS) {
    var DSConfig = {
        name: 'user',
        afterFindAll: function(Resource, data, cb) {
            cb(null, data.data[Resource.name])
        }
    }
    var testResource = DS.defineResource(DSConfig);
    return testResource;
}]);