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
require(['app', 'router'], function(app, Router){
	app.router = new Router();
	Backbone.history.start({ pushState: true, root: '/' } );
});
