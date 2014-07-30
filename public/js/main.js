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
console.log(app.session.get('is_auth'));
		Backbone.history.start({'pushState': true});
	});
});
