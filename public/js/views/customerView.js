define([
    "app",
    "backbone",
    "text!templates/order/addform.html"
], function(app, Backbone, AddFormTpl){

    var CustomerView = Backbone.View.extend({
        events: {
            "click #addorder": "addOrder",
            "keyup #price": "changePrice"
        },

        render:function () {
        	this.$el.html(_.template(AddFormTpl));
            return this;
        },
        
		addOrder: function(){
        	event.preventDefault();
			var that = this;
            if(!app.validateInput(this.$('input'))) return false;
        	var params = { name: this.$("#name").val(), price: this.$("#price").val() };
            $.ajax({
          	  dataType: "json",
          	  url: "/customer/addorder",
          	  type: "post",
          	  data: params,
          	  success: function(response){
          		  if(response.status){
					  that.$("#name").val('');
					  that.$("#price").val('');
					  $("#alert_ok").show().delay(3000).fadeOut();
          		  }
          		  else {
          			  app.alertError();
          		  }
          	  }
        	});
		},

        changePrice: function(event) {
        	var value = this.$("#price").val();
		    if (value.match(/[^0-9]/g)) {
			       value = value.replace(/[^0-9]/g, '');
			}
			this.$("#price").val(value);
        }
		
		
        
    });

    return CustomerView;
});

