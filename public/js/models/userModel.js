define([
    "backbone"
], function(Backbone){
    var User = Backbone.Model.extend({
    	defaults: {
    		name: '',
    		role: 0
    	}
    });
    return User;
});

