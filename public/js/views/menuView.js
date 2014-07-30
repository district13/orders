define([
    "app",
    "backbone",
    "text!templates/menu.html"
], function(app, Backbone, MenuTpl){

    var MenuView = Backbone.View.extend({

        events: {
            "click .menu_item" : "navigate"
        },
        
        navigate: function(event) {
        	event.preventDefault();
        	app.router.navigate(event.currentTarget.pathname, true);
        },

        initialize: function () {
            _.bindAll(this);
			app.session.on("change:is_auth", this.render);
        },
        
        render:function () {
        	if(app.session.get('is_auth'))
        		this.$el.html(_.template(MenuTpl));
        	else
        		this.$el.html('');
            return this;
        }

    });

    return MenuView;
});

