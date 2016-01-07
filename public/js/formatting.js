//------------------------------------------------------------------------------------------------
//                                                 ,----,                                 
//                  ,----..                      ,/   .`|                                 
//                 /   /   \                   ,`   .'  :               ,---,.     ,---,. 
//         ,---,  /   .     :          ,--,  ;    ;     /       ,--,  ,'  .'  \  ,'  .' | 
//        /_ ./| .   /   ;.  \       ,'_ /|.'___,/    ,'      ,'_ /|,---.' .' |,---.'   | 
//  ,---, |  ' :.   ;   /  ` ;  .--. |  | :|    :     |  .--. |  | :|   |  |: ||   |   .' 
// /___/ \.  : |;   |  ; \ ; |,'_ /| :  . |;    |.';  ;,'_ /| :  . |:   :  :  /:   :  |-, 
//  .  \  \ ,' '|   :  | ; | '|  ' | |  . .`----'  |  ||  ' | |  . .:   |    ; :   |  ;/| 
//   \  ;  `  ,'.   |  ' ' ' :|  | ' |  | |    '   :  ;|  | ' |  | ||   :     \|   :   .' 
//    \  \    ' '   ;  \; /  |:  | | :  ' ;    |   |  ':  | | :  ' ;|   |   . ||   |  |-, 
//     '  \   |  \   \  ',  / |  ; ' |  | '    '   :  ||  ; ' |  | ''   :  '; |'   :  ;/| 
//      \  ;  ;   ;   :    /  :  | : ;  ; |    ;   |.' :  | : ;  ; ||   |  | ; |   |    \ 
//       :  \  \   \   \ .'   '  :  `--'   \   '---'   '  :  `--'   \   :   /  |   :   .' 
//        \  ' ;    `---`     :  ,      .-./           :  ,      .-./   | ,'   |   | ,'   
//         `--`                `--`----'                `--`----'   `----'     `----'     
//------------------------------------------------------------------------------------------------

function YoutubePageLoad (base_url) {
  googleProfileDataFormat(base_url);
  channelDataFormat(base_url);
  videoDataFormat(base_url);
  chartDataFormat(base_url);
  subscribersChartDataFormat(base_url);

}

function videoDataFormat (base_url) {
				var jqxhr =
					    $.ajax({
					        url: base_url + 'index.php/youtube/getVideoDataAJAX',
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


function channelDataFormat (base_url) {
				var jqxhr =
					    $.ajax({
					        url: base_url + 'index.php/youtube/getChannelDataAJAX',
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

function chartDataFormat (base_url) {
				var jqxhr =
					    $.ajax({
					        url: base_url + 'index.php/youtube/getChannelMonthlyDataAJAX',
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



	//populateChart( months, likes, shares, views );
  populateHighChart( months, likes, shares, views );

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

function populateHighChart (months, likes, shares, views) {
    $('#jumbotron-line-chart').highcharts({
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Stats for last 12 months'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                //type: 'datetime',
                categories: months
            },
            yAxis: {
                title: {
                    text: 'Exchange rate'
                }
            },
            legend: {
                enabled: true
            },

            series: [
                      {
                          type: 'line',
                          name: 'Likes',
                          color: Highcharts.getOptions().colors[0],
                          data: likes
                      },
                      {
                          type: 'line',
                          name: 'Shares',
                          color: Highcharts.getOptions().colors[1],
                          data: shares
                      },
                      {
                          type: 'line',
                          name: 'Views',
                          color: Highcharts.getOptions().colors[2],
                          data: views
                      }
            ]
        });
}


function googleProfileDataFormat (base_url) {
        var jqxhr =
              $.ajax({
                  url: base_url + 'index.php/youtube/getGoogleProfileDataAJAX',   //making it compatible for youtube and fb both
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


function subscribersChartDataFormat (base_url) {
        var jqxhr =
              $.ajax({
                  url: base_url + 'index.php/youtube/getGoogleChannelSubscribersDataAJAX',
                  dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Fetching monthly subscribers data');
                                        },
                  complete: function(){
                                          waitingDialog.hide();
                                        }
              })
              .done (function(data) {
                   var subscribersData = $.parseJSON(data["json"]);
                   populateSubscribersChartData(subscribersData);
               
                })
              .fail   (function()     { console.error("Error in getting subscribers data")   ; })
              ;
}


function populateSubscribersChartData (subscribersData) {
  months = [];
  subscribersGained = [];
  subscribersLost = [];

  $.each(subscribersData, function(key, value){
      months.push(key);
      subscribersGained.push(value[0]);
      subscribersLost.push(value[1]);
  });

  populateSubscribersChart(months, subscribersGained, subscribersLost);
}

function populateSubscribersChart (months, subscribersGained, subscribersLost ) {
    var ctx, data, myBarChart, option_bars;
    Chart.defaults.global.responsive = true;
    ctx = $('#jumbotron-bar-chart').get(0).getContext('2d');
    option_bars = {
      scaleBeginAtZero: true,
      scaleShowGridLines: true,
      scaleGridLineColor: "rgba(0,0,0,.05)",
      scaleGridLineWidth: 1,
      scaleShowHorizontalLines: true,
      scaleShowVerticalLines: false,
      barShowStroke: true,
      barStrokeWidth: 1,
      barValueSpacing: 5,
      barDatasetSpacing: 3,
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
          label: "Subscribers Gained",
          fillColor: "rgba(26, 188, 156,0.6)",
          strokeColor: "#1ABC9C",
          pointColor: "#1ABC9C",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "#1ABC9C",
          data: subscribersGained
        }, {
          label: "Subscribers Lost",
          fillColor: "rgba(34, 167, 240,0.6)",
          strokeColor: "#22A7F0",
          pointColor: "#22A7F0",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "#22A7F0",
          data: subscribersLost
        }
      ]
    };
    myBarChart = new Chart(ctx).Bar(data, option_bars);
     //then you just need to generate the legend
    var legend = myBarChart.generateLegend();
    $('#bar-chart-legend').html(legend);
}



//------------------------------------------------------------------------------------------------
//                                                           ,----..       ,----..          ,--. 
//     ,---,.   ,---,         ,----..      ,---,.    ,---,.    /   /   \     /   /   \     ,--/  /| 
//   ,'  .' |  '  .' \       /   /   \   ,'  .' |  ,'  .'  \  /   .     :   /   .     : ,---,': / ' 
// ,---.'   | /  ;    '.    |   :     :,---.'   |,---.' .' | .   /   ;.  \ .   /   ;.  \:   : '/ /  
// |   |   .':  :       \   .   |  ;. /|   |   .'|   |  |: |.   ;   /  ` ;.   ;   /  ` ;|   '   ,   
// :   :  :  :  |   /\   \  .   ; /--` :   :  |-,:   :  :  /;   |  ; \ ; |;   |  ; \ ; |'   |  /    
// :   |  |-,|  :  ' ;.   : ;   | ;    :   |  ;/|:   |    ; |   :  | ; | '|   :  | ; | '|   ;  ;    
// |   :  ;/||  |  ;/  \   \|   : |    |   :   .'|   :     \.   |  ' ' ' :.   |  ' ' ' ::   '   \   
// |   |   .''  :  | \  \ ,'.   | '___ |   |  |-,|   |   . |'   ;  \; /  |'   ;  \; /  ||   |    '  
// '   :  '  |  |  '  '--'  '   ; : .'|'   :  ;/|'   :  '; | \   \  ',  /  \   \  ',  / '   : |.  \ 
// |   |  |  |  :  :        '   | '/  :|   |    \|   |  | ;   ;   :    /    ;   :    /  |   | '_\.' 
// |   :  \  |  | ,'        |   :    / |   :   .'|   :   /     \   \ .'      \   \ .'   '   : |     
// |   | ,'  `--''           \   \ .'  |   | ,'  |   | ,'       `---`         `---`     ;   |,'     
// `----'                     `---`    `----'    `----'                                 '---'   
// 
//------------------------------------------------------------------------------------------------
function FbPageLoad (page_id, base_url) {
  
    googleProfileDataFormat(base_url);
    FbPageDataFormat(page_id, base_url);
    FbChartDataFormat(page_id, base_url);
    FbPageReachChartDataFormat(page_id, base_url);
    FbPagePostsDataFormat(page_id, base_url);


}


function FbPageDataFormat (page_id, base_url) {
        var jqxhr =
              $.ajax({
                  url: base_url + 'index.php/facebook/facebookPageDataAggregatorAJAX/' + page_id,
                  dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Fetching facebook page data');
                                        },
                  complete: function () {
                                          waitingDialog.hide();
                                        }
              })
              .done (function(data) {
                   var pageData = $.parseJSON(data["json"]);
                   populateFbPageData(pageData);
               
                })
              .fail   (function()     { console.error("Error in getting fb page data")   ; })
              ;
}

function populateFbPageData (pageData) {
  $("#channelLikes").html(pageData.lifetime_likes);
  $("#channelViews").html(pageData.total_views);
  $("#channelShares").html(pageData.total_clicks);
  $("#channelComments").html(pageData.total_impressions);
}



function FbChartDataFormat (page_id, base_url) {
        var jqxhr =
              $.ajax({
                  url: base_url + 'index.php/facebook/getFacebookPageViewsAJAX/' + page_id,
                  dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Fetching page views daily data');
                                        },
                  complete: function () {
                                          waitingDialog.hide();
                                        }
              })
              .done (function(data) {
                   var pageData = $.parseJSON(data["json"]);
                   populateFBChartData(pageData["data"][0]["values"]);
               
                })
              .fail   (function()     { console.error("Error in getting page views daily data")   ; })
              ;
}

function populateFBChartData (data) {
  days = [];
  views = [];
  $.each(data, function(key, valueSet){
      days.push(valueSet["end_time"].split("T")[0]);
      views.push(valueSet["value"]);

  });
  
  populateFacebookChart( days, views );

}

function populateFacebookChart (days,views) {
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
      labels: days,
      datasets: [
        {
          label: "Page Views",
          fillColor: "rgba(34, 167, 240,0.2)",
          strokeColor: "#22A7F0",
          pointColor: "#22A7F0",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "#22A7F0",
          data: views
        }
      ]
    };
    fbLineChart = new Chart(ctx).Line(data, options);
    //then you just need to generate the legend
  var legend = fbLineChart.generateLegend();
  $('#line-chart-legend').html(legend);

}

function FbPageReachChartDataFormat (page_id, base_url) {
        var jqxhr =
              $.ajax({
                  url: base_url + 'index.php/facebook/getFacebookPageImpressionsAggregatorAJAX/' + page_id,
                  dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Fetching page impressions data');
                                        },
                  complete: function () {
                                          waitingDialog.hide();
                                        }
              })
              .done (function(data) {
                   var pageData = $.parseJSON(data["json"]);
                   populateFbPageImpressionChartData(pageData);
               
                })
              .fail   (function()     { console.error("Error in getting page impressions data")   ; })
              ;
}

function populateFbPageImpressionChartData (pageData) {
  populateFacebookPageImpressionChart( pageData );
}

function populateFacebookPageImpressionChart (pageData) {
    var ctx, data, myPolarAreaChart, option_bars;
    Chart.defaults.global.responsive = true;
    ctx = $('#my-polar-area-chart').get(0).getContext('2d');
    option_bars = {
      scaleShowLabelBackdrop: true,
      scaleBackdropColor: "rgba(255,255,255,0.75)",
      scaleBeginAtZero: true,
      scaleBackdropPaddingY: 2,
      scaleBackdropPaddingX: 2,
      scaleShowLine: true,
      segmentShowStroke: true,
      segmentStrokeColor: "#fff",
      segmentStrokeWidth: 2,
      animationSteps: 100,
      animationEasing: "easeOutBounce",
      animateRotate: true,
      animateScale: false,
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    data = [
      {
        value: pageData.page_impressions_viral,
        color: "#FA2A00",
        highlight: "#FA2A00",
        label: "Viral"
      }, {
        value: pageData.page_impressions_organic,
        color: "#1ABC9C",
        highlight: "#1ABC9C",
        label: "Organic"
      }, {
        value: pageData.page_impressions_paid,
        color: "#FABE28",
        highlight: "#FABE28",
        label: "Paid"
      }
    ];
    myPolarAreaChart = new Chart(ctx).PolarArea(data, option_bars);
  }

function FbPagePostsDataFormat (page_id, base_url) {
        var jqxhr =
              $.ajax({
                  url: base_url + 'index.php/facebook/getFacebookPagesPostsAJAX/' + page_id,
                  dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Fetching page posts');
                                        },
                  complete: function () {
                                          waitingDialog.hide();
                                        }
              })
              .done (function(data) {
                   var pageData = $.parseJSON(data["json"]);
                   $("#message-load-more").attr({"href" : pageData["paging"]["next"]}); //for load more url
                   populateFbPagePostData(pageData["data"]);
                })
              .fail   (function()     { console.error("Error in getting page posts")   ; })
              ;
}



function populateFbPagePostData (pageData) {
  waitingDialog.show('Displaying page posts');
  
  days = [];
  views = [];
  $.each(pageData, function(key, valueSet){
    createPagePost(valueSet);
  });

  waitingDialog.hide();
}

function createPagePost (valueSet) {
  if(valueSet["message"] == null)
      message = valueSet["story"];
    else
      message = valueSet["message"];
    date = valueSet["created_time"].split("T")[0];
    time = valueSet["created_time"].split("T")[1].split("+")[0];
    time_of_post = date + " " + time;
    id = valueSet["id"];

    //creating the html content
    content = contentBodyforPagePost( message, time_of_post, id );
    $("#fb_posts_list").append(content);
}


function contentBodyforPagePost (message, time_of_post, id) {
    content ='<a href="' + id + '" data-toggle="modal" data-target="#fbPostModal"> \
              <li> \
                  <div class="message-block"> \
                      <div><span class="username">Tui2Tone</span> <span class="message-datetime">' + time_of_post + '</span> \
                      </div> \
                      <div class="message">' + message + '</div> \
                  </div> \
              </li> \
          </a>';

    return content;
}

function pagePostsLoadMore (next_url) {
        var jqxhr =
              $.ajax({
                  url: next_url,
                  dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Loading more page posts');
                                        },
                  complete: function () {
                                          waitingDialog.hide();
                                        }
              })
              .done (function(data) {
                   $("#message-load-more").attr({"href" : data["paging"]["next"]}); //for load more url
                   pageData = data["data"];
                   populateFbPagePostData(pageData);
               
                })
              .fail   (function()     { console.error("Error in getting page posts")   ; })
              ;
}  

function FbPostsChartDataFormat (post_id, base_url) {
        var jqxhr =
              $.ajax({
                  url: base_url + 'index.php/facebook/getFacebookPostImpressionsByStoryTypeAJAX/' + post_id,
                  dataType: 'json',
                  /*
                  beforeSend: function(){
                                          waitingDialog.show('Fetching page posts');
                                        },
                  complete: function () {
                                          waitingDialog.hide();
                                        }
                  */
              })
              .done (function(data) {
                   var postData = $.parseJSON(data["json"]);
                   populateFbPostChartData(postData.data[0].values[0].value);
                })
              .fail   (function()     { console.error("Error in getting post data")   ; })
              ;
}

function populateFbPostChartData (postData) {
  
  if(postData.length == 0)
    comment = fan = link = other = 0;
  else{
    populateFacebookPostModalChart(postData);
    comment = postData.comment;
    fan = postData.fan;
    link = postData.link;
    other = postData.other;
  }
  

  setTimeout(populateFacebookPostModalChart, 5000, comment, fan, link, other); //chart has a bug so sleeping till canvas is ready
  // populateFacebookPostModalChart(comment, fan, link, other);
}


function populateFacebookPostModalChart (comment, fan, link, other) {

    $("#fbModalText").text("Post impressions"); //change from Loading to the title

    var ctx, data, option_bars;
    Chart.defaults.global.responsive = true;
    ctx = $('#modal-polar-area-chart').get(0).getContext('2d');
    option_bars = {
      scaleShowLabelBackdrop: true,
      scaleBackdropColor: "rgba(255,255,255,0.75)",
      scaleBeginAtZero: true,
      scaleBackdropPaddingY: 2,
      scaleBackdropPaddingX: 2,
      scaleShowLine: true,
      segmentShowStroke: true,
      segmentStrokeColor: "#fff",
      segmentStrokeWidth: 2,
      animationSteps: 100,
      animationEasing: "easeOutBounce",
      animateRotate: true,
      animateScale: false,
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    data = [
      {
        value: comment,
        color: "#FA2A00",
        highlight: "#FA2A00",
        label: "Comment"
      }, {
        value: fan,
        color: "#1ABC9C",
        highlight: "#1ABC9C",
        label: "Fan"
      }, {
        value: link,
        color: "#FABE28",
        highlight: "#FABE28",
        label: "Link"
      }, {
        value: other,
        color: "##9FEAAE",
        highlight: "#40D65D",
        label: "Other"
      }
    ];
    modalPolarAreaChart = new Chart(ctx).PolarArea(data, option_bars);
  }


function FbPostStoryDataFormat (post_id, base_url) {
        var jqxhr =
              $.ajax({
                  url: base_url + 'index.php/facebook/getFacebookPostStoryByActionTypeAJAX/' + post_id,
                  dataType: 'json',
                  /*
                  beforeSend: function(){
                                          waitingDialog.show('Fetching page posts');
                                        },
                  complete: function () {
                                          waitingDialog.hide();
                                        }
                  */
              })
              .done (function(data) {
                   var postData = $.parseJSON(data["json"]);
                   populateFbPostStoryData(postData.data[0].values[0].value);
                })
              .fail   (function()     { console.error("Error in getting post data")   ; })
              ;
}

function populateFbPostStoryData (pageData) {
  $("#postLikes").text(pageData.like);
  $("#postComments").text(pageData.comment);
  $("#postShares").text(pageData.share);
}

