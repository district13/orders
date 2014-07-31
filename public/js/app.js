define(['jquery'], function($){
			return {
		        validateInput: function(inputs) {
		            var valid = true;
		        	$.each(inputs, function(index, field) {
		        		if($(field).val() == '') {
		        			$(field).parent().addClass('has-error');
			                valid = false;
			            } else {
			            	$(field).parent().removeClass('has-error');
			            }
		        	});
		            return valid;
		        },
		        
		        alertError: function() {
					 $("#alert_error").show().delay(3000).fadeOut();
		        }
			};
		}); 