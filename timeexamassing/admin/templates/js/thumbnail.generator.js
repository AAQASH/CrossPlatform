(function($){
	
	$.addThumbnailParam = function(btn,p){
		p = $.extend({
			REQUEST_URL: '',
			dataType: 'json',
			METHOD: 'POST',
			image: '',
			total_rows: 0,
			ID: 0
		}, p);
		
		displayActionLog('worning', 'Thumbnail generation has been started, please do not close this window...');
		prepareThumbnailGeneration(btn, p);
		return btn;
	};
	
	
	
	prepareThumbnailGeneration = function(btn, p){
		$.ajax({
			type: p.METHOD,
			url: p.REQUEST_URL,
			data: p,
			dataType: p.dataType,
			success: function(data){ dataHandler(data, btn, p); },
			error: function(XMLHttpRequest, textStatus, errorThrown) { try { if (p.onError) p.onError(XMLHttpRequest, textStatus, errorThrown); } catch (e) {} }
		});
	}//end function
	
	
	dataHandler = function (data, btn, p){
		if(data.total_rows > 0){
			displayActionLog('success', 'Total: '+data.total_rows+' records found.');
			p.total_rows = data.total_rows;
			p.ID = data.ID;
			displayActionLog('success', 'Generating thumbnail for Image ID: '+p.ID+'.');
			generateThumbnail(data, btn, p);
		} else {
			displayActionLog('success', 'Total: '+data.total_rows+' records found.');
			displayActionLog('error', 'Stop Processing.');
		}
	}//end function
	
	generateThumbnail = function(data, btn, p){
		$.ajax({
			type: p.METHOD,
			url: p.REQUEST_URL,
			data: p,
			dataType: p.dataType,
			success: function(data){ errorHandler(data, btn, p); },
			error: function(XMLHttpRequest, textStatus, errorThrown) { try { if (p.onError) p.onError(XMLHttpRequest, textStatus, errorThrown); } catch (e) {} }
		});
	}//end function
	
	errorHandler = function(data, btn, p){
		if(data.type){
			displayActionLog(data.type, data.msg);
		}
		if(data.ID != null && data.ID > 0){
			p.ID = data.ID;
			displayActionLog('success', 'Generating thumbnail for Image ID: '+p.ID+'.');
			generateThumbnail(data, btn, p);
		}else{
			displayActionLog('error', 'Stop Processing.');
		}
	}//end function
	
	
	displayActionLog = function(type, msg){
		switch(type){
			case "error":
				$("#action_log").append('<div class="alert alert-danger">'+msg+'</div>');
			break;
			
			case "success":
				$("#action_log").append('<div class="alert alert-success">'+msg+'</div>');
			break;
			
			case "worning":
				$("#action_log").append('<div class="alert alert-warning">'+msg+'</div>');
			break;
		}//end switch
	}//end function
	

	
	$.fn.thumbnailgenerator = function(p) {
		return this.each( function() {
			var btn = this;
			$(document).ready(function (){
				$.addThumbnailParam(btn,p);
			});
		});
	}; //end flexigrid
	
})(jQuery);