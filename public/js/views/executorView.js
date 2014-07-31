define([
    "app",
    "backbone",
    "views/order/listView",
    "text!templates/order/listWrap.html"
], function(app, Backbone, orderListView, ListWrapTpl){

    var ExecutorView = Backbone.View.extend({
		render: function(){
			var orderListContent = new orderListView().render().el;
	 		this.$el.html(_.template(ListWrapTpl));
	 		this.$("#wrap_thead").after(orderListContent);
	 		return this;
		}
    });

    return ExecutorView;
});