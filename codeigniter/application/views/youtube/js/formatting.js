function videoDataFormat () {
				var jqxhr =
					    $.ajax({
					        url: 'getVideoDataAJAX',
					        dataType: 'json'
					    })
					    .done (function(data) {
    					     var videoData = $.parseJSON(data["json"]);
    					     loopVideoCards(videoData);
					     
					      })
					    .fail   (function()     { alert("Error in getting video data")   ; })
					    ;
}


function loopVideoCards ( json_data ) {
	json_data.forEach(function(data){
		$("#videoCards").append('\
			<p>\
			 <div class="col-md-4 col-sm-12">\
                <div class="thumbnail no-margin-bottom">\
                    <img src="' + data.thumbnail_medium + '">\
                    <div class="caption">\
                        <h3 id="thumbnail-label">' + data.title + '<a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>\
                        <p> Description: '+ data.description + '</p>\
                        <p>\
                        <div>\
                            <ul class="list-group">\
                                <li class="list-group-item list-group-item-success">\
                                    <span class="badge">' + data.likes + '</span> Likes\
                                </li>\
                                <li class="list-group-item list-group-item-info">\
                                    <span class="badge">' + data.views + '</span> Views\
                                </li>\
                                <li class="list-group-item list-group-item-warning">\
                                    <span class="badge">' + data.shares + '</span> Shares\
                                </li>\
                                <li class="list-group-item list-group-item-danger">\
                                    <span class="badge">' + data.comments + '</span> Comments\
                                </li>\
                            </ul>\
                        </div>\
                        </p>\
                        <p><a target="_blank" href="https://www.youtube.com/watch?v='+ data.id + '" class="btn btn-primary" role="button">Launch</a></p>\
                    </div>\
                </div>\
                </p>'
			);
	});
}


function channelDataFormat () {
				var jqxhr =
					    $.ajax({
					        url: 'getChannelDataAJAX',
					        dataType: 'json'
					    })
					    .done (function(data) {
    					     var channelData = $.parseJSON(data["json"]);
    					     populateChannelData(channelData);
					     
					      })
					    .fail   (function()     { alert("Error in getting channel data")   ; })
					    ;
}

function populateChannelData (channelData) {
	$("#channelLikes").html(channelData.likes);
	$("#channelViews").html(channelData.views);
	$("#channelShares").html(channelData.shares);
	$("#channelComments").html(channelData.comments);
}