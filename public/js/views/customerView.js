define([
    "app",
    "backbone",
    "text!templates/customer.html"
], function(app, Backbone, CustomerTpl){

    var CustomerView = Backbone.View.extend({
        render:function () {
        	this.$el.html(_.template(CustomerTpl));
            return this;
        }
    });

    return CustomerView;
});

