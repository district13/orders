define([
    "app",
    "backbone",
    "collections/orderCollection",
    "views/order/view",
], function(app, Backbone, OrderCollection, OrderView){

    var ListOrderView = Backbone.View.extend({

    	tagName: 'tbody',

		initialize: function(){
			this.orderCollection = new OrderCollection();
			this.listenTo(this.orderCollection, 'reset', this.render);			
			this.orderCollection.fetch({reset: true});
		},
		
		render: function(){
			this.orderCollection.each(function(order){
				var orderView = new OrderView({'model': order});
				this.$el.append(orderView.render().el);
			}, this);
        	return this;
		}
    });

    return ListOrderView;
});