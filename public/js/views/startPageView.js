define([
    "app",
    "backbone",
    "text!templates/startpage.html"
], function(app, Backbone, StartPageTpl){

    var StartPageView = Backbone.View.extend({
        render:function () {
        	this.$el.html(_.template(StartPageTpl));
            return this;
        }
    });

    return StartPageView;
});

