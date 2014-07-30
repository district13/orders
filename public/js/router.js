define([
    "app",
    "backbone",
    "views/userView",
    "views/menuView",
    "views/startPageView",
    "views/executorView",
    "views/customerView"
], function(app, Backbone, UserView, MenuView, 
		StartPageView, ExecutorView, CustomerView){

    var Router = Backbone.Router.extend({
        routes: {
            "": "index",
            "executor": "executor",
            "customer/addorderform": "customer"
        },
        
        _renderPage: function(View) {
        	if(!this.renderLayout) {
				$('#user').html(new UserView().render().$el);
    			$('#menu').html(new MenuView().render().$el);
    			this.renderLayout = true;
        	}
			$('#content').html(View.render().$el);
        },
        
	    index: function() {
	    	this._renderPage(new StartPageView());
	    }, 
        
        executor: function() {
	    	this._renderPage(new ExecutorView());
        },
        
        customer: function() {
	    	this._renderPage(new CustomerView());
        }
        
    });

    return Router;

});
