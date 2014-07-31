define([
    "app",
    "backbone",
    "text!templates/404.html"
], function(app, Backbone, Page404Tpl){

    var Page404View = Backbone.View.extend({
        render:function () {
        	this.$el.html(_.template(Page404Tpl));
            return this;
        }
    });

    return Page404View;
});

