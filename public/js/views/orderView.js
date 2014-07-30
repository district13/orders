define([
    "backbone",
    "text!templates/order/show.html"
], function(Backbone, ShowTpl){
	var OrderView = Backbone.View.extend({
		tagName: 'li',
		render: function() {
			var template = _.template(ShowTpl);
	 		this.$el.html(template(this.model.toJSON()));
	 		return this;
		},
		
	});
	return OrderView;
});