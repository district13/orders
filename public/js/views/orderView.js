define([
    "backbone",
    "text!templates/order/show.html"
], function(Backbone, ShowTpl){
	
	var OrderView = Backbone.View.extend({
        events: {
            "click.executor_work" : "executorWork"
        },

        tagName: 'li',
		render: function() {
			var template = _.template(ShowTpl);
	 		this.$el.html(template(this.model.toJSON()));
	 		return this;
		},
		
		executorWork: function() {
        	event.preventDefault();
        	var that = this;
            $.ajax({
	          	dataType: "json",
	          	url: "/executor/work",
	          	data: {order_id: this.model.id},
	          	type: "post",
	          	success: function(response){
		      		if(response.status == 1) {
		    			 $(that.el).hide();
					} else {
	    			}
	          	}
            });
		}
	});
	return OrderView;
});