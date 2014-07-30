define([
    "backbone",
    "models/orderModel"
], function(Backbone, Order){
	var OrderCollection = Backbone.Collection.extend({
		model: Order,
		url: '/executor/orders' 
	});
	return OrderCollection;
});