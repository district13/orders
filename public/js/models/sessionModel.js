define([
    "app",
    "models/userModel",
    "backbone"
], function(app, UserModel, Backbone){

    var SessionModel = Backbone.Model.extend({
        defaults: {
            is_auth: 0,
            user: {}
        },

        checkAuth: function(callback) {
            var that = this;
            if(Viewer.id) {
            	that.set({'user': new UserModel(Viewer), 'is_auth': true});
            } else {
            	that.set({'is_auth': false});
            }
        	if(typeof callback === 'function') callback();
        },
        
        login: function(params, callback){
            var that = this;
            $.ajax({
            	  dataType: "json",
            	  url: "/index/login",
            	  data: params,
            	  type: "post",
            	  success: function(res){
                	that.set({'user': new UserModel(res), is_auth: true});
                	if(typeof callback === 'function') callback();
                },
            });
        }
        
    });
    
    return SessionModel;

});

