define([
    "app",
    "backbone",
    "text!templates/login.html",
    "text!templates/userpanel.html",
], function(app, Backbone, LoginTpl, UserPanelTpl){

    var LoginView = Backbone.View.extend({
        
        initialize: function () {
			app.session.on("change:is_auth", this.render);
        },

        render:function () {
        	if(app.session.get('is_auth')) {
            	var template = _.template(UserPanelTpl); 
                this.$el.html(template(
                		app.session.get('user').toJSON()
                ));
        	} else 
        		this.$el.html(_.template(LoginTpl));
            return this;
        }

    });

    return LoginView;
});

