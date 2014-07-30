require.config({
    baseUrl: '/js',
    paths: {
        'jquery': 'libs/jquery',
        'underscore': 'libs/underscore',
        'backbone': 'libs/backbone',
        'text': 'libs/text'
    },
    shim: {
        'underscore': { exports  : '_' },
        'backbone': { deps : ['underscore', 'jquery'], exports : 'Backbone' },
    }

});
require(['app', 'router', 'models/sessionModel'], function(app, Router, Session){
	app.router = new Router();
	app.session = new Session();
	app.session.checkAuth(function(){
		Backbone.history.start({'pushState': true});
		
	    $("body").on("click", "a.links", function(event) {
	        event.preventDefault();
	        app.router.navigate(event.currentTarget.pathname, true);
	    });
		
	});
});
