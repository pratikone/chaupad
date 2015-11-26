function videoDataFormat () {
				var jqxhr =
					    $.ajax({
					        url: 'getVideoDataAJAX',
					        dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Fetching video data');
                                        },
                  complete: function function_name (argument) {
                                          waitingDialog.hide();
                                        }
					    })
					    .done (function(data) {
    					     var videoData = $.parseJSON(data["json"]);
    					     loopVideoCards(videoData);
					     
					      })
					    .fail   (function()     { console.error("Error in getting video data");
               })
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
					        dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Fetching channel data');
                                        },
                  complete: function function_name (argument) {
                                          waitingDialog.hide();
                                        }
					    })
					    .done (function(data) {
    					     var channelData = $.parseJSON(data["json"]);
    					     populateChannelData(channelData);
					     
					      })
					    .fail   (function()     { console.error("Error in getting channel data")   ; })
					    ;
}

function populateChannelData (channelData) {
	$("#channelLikes").html(channelData.likes);
	$("#channelViews").html(channelData.views);
	$("#channelShares").html(channelData.shares);
	$("#channelComments").html(channelData.comments);
}

function chartDataFormat () {
				var jqxhr =
					    $.ajax({
					        url: 'getChannelMonthlyDataAJAX',
					        dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Fetching monthly channel data');
                                        },
                  complete: function function_name (argument) {
                                          waitingDialog.hide();
                                        }
					    })
					    .done (function(data) {
    					     var channelData = $.parseJSON(data["json"]);
    					     populateChartData(channelData);
					     
					      })
					    .fail   (function()     { console.error("Error in getting channel chart data")   ; })
					    ;
}

function populateChartData (data) {
	months = [];
	likes = [];
	views = [];
	shares = [];
	$.each(data, function(key, value){
    	months.push(key);
    	likes.push(value[0]);
    	views.push(value[1]);
    	shares.push(value[2]);

	});
	
	/*
	//cumulative data
	for (var sum = 0, i = 0; i < likes.length; i++) {
		likes[i] += sum;
		sum = likes[i];
	};
	
	for (var sum = 0, i = 0; i < views.length; i++) {
		views[i] += sum;
		sum = views[i];
	};

	for (var sum = 0, i = 0; i < shares.length; i++) {
		shares[i] += sum;
		sum = shares[i];
	};
	*/



	populateChart( months, likes, shares, views );

}

function populateChart (months, likes, shares, views) {
    var ctx, data, myLineChart, options;
    Chart.defaults.global.responsive = true;
    ctx = $('#jumbotron-line-chart').get(0).getContext('2d');
    options = {
      showScale: true,
      scaleShowGridLines: false,
      scaleGridLineColor: "rgba(0,0,0,.05)",
      scaleGridLineWidth: 0,
      scaleShowHorizontalLines: false,
      scaleShowVerticalLines: false,
      bezierCurve: false,
      bezierCurveTension: 0.4,
      pointDot: false,
      pointDotRadius: 1,
      pointDotStrokeWidth: 2,
      pointHitDetectionRadius: 20,
      datasetStroke: true,
      datasetStrokeWidth: 4,
      datasetFill: true,
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\">\
      <% for (var i=0; i<datasets.length; i++){%>\
      <li style=\" display:inline;\"><span style=\"background-color:<%=datasets[i].strokeColor%>\">\
      <%if(datasets[i].label){%>\
      	<%=datasets[i].label%><%}%>\
      	</span></li><%}%></ul>"
    };
    data = {
      labels: months,
      datasets: [
        {
          label: "Likes",
          fillColor: "rgba(34, 167, 240,0.2)",
          strokeColor: "#22A7F0",
          pointColor: "#22A7F0",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "#22A7F0",
          data: likes
        },
        {
          label: "Views",
          fillColor: "rgba(34, 210, 240,0.2)",
          strokeColor: "#22F0E2",
          pointColor: "#22F0E2",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "#22F0E2",
          data: views
        },
        {
          label: "Shares",
          fillColor: "rgba(134, 21, 240,0.2)",
          strokeColor: "#AF22F0",
          pointColor: "#AF22F0",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "#AF22F0",
          data: shares
        }

      ]
    };
    myLineChart = new Chart(ctx).Line(data, options);
    //then you just need to generate the legend
  var legend = myLineChart.generateLegend();
  $('#line-chart-legend').html(legend);

}


function googleProfileDataFormat () {
        var jqxhr =
              $.ajax({
                  url: 'getGoogleProfileDataAJAX',
                  dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Fetching google profile data');
                                        },
                  complete: function function_name (argument) {
                                          waitingDialog.hide();
                                        }
              })
              .done (function(data) {
                   var profileData = $.parseJSON(data["json"]);
                   populateGoogleProfileData(profileData);
               
                })
              .fail   (function()     { console.error("Error in getting profile data")   ; })
              ;
}

function populateGoogleProfileData (data) {
  $("#google-profile-name").html(data.name + '<span class="caret"></span>');
  $("div.profile-info").find("h4").html(data.name);
  $("div.profile-info").find("p").html(data.email);
  $("#google-profile-link").attr({"href" : data.profile_link});
  $("img.profile-img").attr({"src" : data.picture});

}
