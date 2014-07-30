define([
    "app",
    "backbone",
    "text!templates/order/addform.html"
], function(app, Backbone, AddFormTpl){

    var CustomerView = Backbone.View.extend({
        events: {
            "click #addorder" : "addOrder"
        },

        render:function () {
        	this.$el.html(_.template(AddFormTpl));
            return this;
        },
        
		addOrder: function(){
        	event.preventDefault();
            var params = { name: this.$("#name").val(), price: this.$("#price").val() }
        	$.post("/customer/addorder", params, function(response){
        		console.log(response);
        	});
		}
        
    });

    return CustomerView;
});

