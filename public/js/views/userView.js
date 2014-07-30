define([
    "app",
    "backbone",
    "text!templates/login.html",
    "text!templates/userpanel.html",
], function(app, Backbone, LoginTpl, UserPanelTpl){

    var LoginView = Backbone.View.extend({

    	events: {
            "click #login_button" : "onLogin"
        },

        initialize: function () {
            _.bindAll(this);
			app.session.on("change:is_auth", this.render);
        },
        
        onLogin: function(event) {
            event.preventDefault();
            var params = { name: this.$("#name").val(), pass: this.$("#pass").val() }
            app.session.login(params, function(response){
            	
            });
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

