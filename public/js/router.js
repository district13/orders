define([
    "app",
    "backbone",
    "views/userView",
    "views/menuView",
    "views/startPageView",
    "views/executorView",
    "views/customerView",
    "views/page404View",
], function(app, Backbone, UserView, MenuView, 
		StartPageView, ExecutorView, CustomerView,
		Page404View
		){

    var Router = Backbone.Router.extend({
        routes: {
            "": "index",
            "executor": "executor",
            "customer/addorderform": "customer",
            '*default': '404'
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
        },
        404: function() {
	    	this._renderPage(new Page404View());
        }
        
    });

    return Router;

});
