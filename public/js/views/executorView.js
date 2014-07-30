define([
    "app",
    "backbone",
    "collections/orderCollection",
    "views/orderView"
], function(app, Backbone, OrderCollection, OrderView){

    var ExecutorView = Backbone.View.extend({
    	tagName: 'ul',

		initialize: function(){
			this.orderCollection = new OrderCollection();
			this.listenTo(this.orderCollection, 'reset', this.render);			
			this.orderCollection.fetch({reset: true});
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
