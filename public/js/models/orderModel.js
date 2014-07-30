define([
    "backbone",
], function(Backbone){
	var Order = Backbone.Model.extend({
		defaults: {
			id: 0,
			name: 'no name',
			price: 0
		}
	});
	return Order;
});