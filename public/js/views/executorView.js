define([
    "app",
    "backbone",
    "text!templates/executor.html"
], function(app, Backbone, ExecutorTpl){

    var ExecutorView = Backbone.View.extend({
        render:function () {
        	this.$el.html(_.template(ExecutorTpl));
            return this;
        }
    });

    return ExecutorView;
});

