define([
    "app",
    "backbone",
], function(app, Backbone){

    var Router = Backbone.Router.extend({
        routes: {
            "": "index",
        },
        
	    index: function() {
console.log("router/index");	    	
	    }, 
    });

    return Router;

});
