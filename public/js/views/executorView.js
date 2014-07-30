define([
    "app",
    "backbone",
    "collections/orderCollection",
    "views/orderView"
], function(app, Backbone, OrderCollection, OrderView){

    var ExecutorView = Backbone.View.extend({
    	tagName: 'ul',

		initialize: function(){
var initOrders = [{id: 1, name: '12345', price: 23323}, {id: 2, name: '2223', price: 3232}];
			this.orderCollection = new OrderCollection(initOrders);
		},
		
		render: function(){
			this.orderCollection.each(function(order){
				var orderView = new OrderView({'model': order});
				this.$el.append(orderView.render().el);
			}, this)
			return this;
		}
    });

    return ExecutorView;
});

