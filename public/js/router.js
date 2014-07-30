define([
    "app",
    "backbone",
    "views/userView",
    "views/menuView"
], function(app, Backbone, UserView, MenuView){

    var Router = Backbone.Router.extend({
        routes: {
            "": "index",
        },
        
	    index: function() {
			var userView = new UserView();
			$('#user').html(userView.render().$el);
			
			var menuView = new MenuView();
			$('#menu').html(menuView.render().$el);

console.log("router/index");
	    }, 
    });

    return Router;

});
