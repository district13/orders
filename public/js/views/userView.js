define([
    "app",
    "backbone",
    "text!templates/login.html",
    "text!templates/userpanel.html",
], function(app, Backbone, LoginTpl, UserPanelTpl){

    var LoginView = Backbone.View.extend({

    	events: {
            "click #login_button": "onLogin",
            "click #logout": "onLogout"
            	
        },

        initialize: function () {
            _.bindAll(this);
			app.session.on("change:is_auth", this.render);
			app.session.on("change:user.money", this.updateMoney);
        },
        
        
        onLogin: function(event) {
            event.preventDefault();
            if(!app.validateInput(this.$('input'))) return false;
            
            var params = { name: this.$("#name").val(), pass: this.$("#pass").val() }
            app.session.login(params, function(response){
            	if(!response.status) {
            		this.$("#pass").val('');
            		this.$("#pass").parent().addClass('has-error');
            	}
            });
        },

        onLogout: function(event) {
            event.preventDefault();
            app.session.logout(function(response){
            	app.router.navigate("/", true);
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
        },
        
        updateMoney: function() {
        	this.$("#user_money").html(app.session.get('user.money'));
        }
        

    });

    return LoginView;
});

