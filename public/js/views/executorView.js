define([
    "app",
    "backbone",
    "views/listOrderView",
    "text!templates/order/listWrap.html"
], function(app, Backbone, ListOrderView, ListWrapTpl){

    var ExecutorView = Backbone.View.extend({
		render: function(){
			var listContent = new ListOrderView().render().el;
console.log(listContent);			
	 		this.$el.html(_.template(ListWrapTpl));
	 		this.$("#wrap_thead").after(listContent);
	 		return this;
		}
    });

    return ExecutorView;
});