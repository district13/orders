define([
    "app",
    "backbone",
    "views/userView",
], function(app, Backbone, UserView){

    var Router = Backbone.Router.extend({
        routes: {
            "": "index",
        },
        
	    index: function() {
			var userView = new UserView();
			$('#user').html(userView.render().$el);
console.log("router/index");
	    }, 
    });

    return Router;

});
