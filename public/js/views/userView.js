define([
    "app",
    "backbone",
    "text!templates/login.html",

], function(app, Backbone, LoginTpl){

    var LoginView = Backbone.View.extend({
        
        initialize: function () {
			app.session.on("change:is_auth", this.render);
        },

        render:function () {
            this.$el.html(_.template(LoginTpl));
            return this;
        }

    });

    return LoginView;
});

