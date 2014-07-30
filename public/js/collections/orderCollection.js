define([
    "backbone",
    "models/orderModel"
], function(Backbone, Order){
	var OrderCollection = Backbone.Collection.extend({
		model: Order
	});
	return OrderCollection;
});