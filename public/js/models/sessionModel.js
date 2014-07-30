define([
    "app",
    "models/userModel",
    "backbone"
], function(app, UserModel, Backbone){

    var SessionModel = Backbone.Model.extend({
        defaults: {
            is_auth: 0,
        },

        checkAuth: function(callback) {
            var that = this;
            if(Viewer.id) {
            	that.set({'is_auth': true});
            } else {
            	that.set({'is_auth': false});
            }
        	if(typeof callback === 'function') callback();
        }
    });
    
    return SessionModel;

});

