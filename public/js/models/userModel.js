define([
    "backbone"
], function(Backbone){
    var User = Backbone.Model.extend({
    	defaults: {
    		id: 0,
    		name: '',
    		role: 0
    	}
    });
    return User;
});

