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

var num_of_videos = 2; //to be changed in Youtube.php too
var youtube_video_index = 1 + num_of_videos;

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

function youtubeVideoLoadMore (base_url) {
        var jqxhr =
              $.ajax({
                  url: base_url + 'index.php/youtube/getVideoDataAJAX/' + youtube_video_index,
                  dataType: 'json',
                  beforeSend: function(){
                                          waitingDialog.show('Loading more youtube videos');
                                        },
                  complete: function () {
                                          waitingDialog.hide();
                                        }
              })
              .done (function(data) {
                   youtube_video_index = youtube_video_index + num_of_videos;
                   var videoData = $.parseJSON(data["json"]);
                   loopVideoCards(videoData);
                })
              .fail   (function()     { console.error("Error in getting more youtube videos")   ; })
              ;
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

  populateHighChart( months, likes, shares, views );

}

function populateHighChart (months, likes, shares, views) {
      if( $('#jumbotron-line-chart').highcharts() != null )
        $('#jumbotron-line-chart').highcharts().destroy();
  
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
                          type: 'column',
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

  // populateSubscribersChart(months, subscribersGained, subscribersLost);
     populateSubscribersHighChart(months, subscribersGained, subscribersLost);
}

function populateSubscribersHighChart(months, subscribersGained, subscribersLost){

    if( $('#jumbotron-bar-chart').highcharts() != null )
      $('#jumbotron-bar-chart').highcharts().destroy();

    $('#jumbotron-bar-chart').highcharts({
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Subscribers stats for last 12 months'
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
                    text: ''
                }
            },
            legend: {
                enabled: true
            },

            series: [
                      {
                          type: 'column',
                          name: 'New Subscribers',
                          color: Highcharts.getOptions().colors[0],
                          data: subscribersGained
                      },
                      {
                          type: 'column',
                          name: 'Unsubscribers',
                          color: Highcharts.getOptions().colors[1],
                          data: subscribersLost
                      }
            ]
        });

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
  
  // populateFacebookChart( days, views );
  populateFacebookHighChart(days, views);

}

function populateFacebookHighChart (days, views) {
    if( $('#jumbotron-line-chart').highcharts() != null )
      $('#jumbotron-line-chart').highcharts().destroy();
  

    $('#jumbotron-line-chart').highcharts({
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Page views stats for last 12 months'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                //type: 'datetime',
                categories: days
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            legend: {
                enabled: true
            },

            series: [
                      {
                          type: 'line',
                          name: 'Views',
                          color: Highcharts.getOptions().colors[0],
                          data: views
                      }
            ]
        });

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
  if( $('#my-polar-area-chart').highcharts() != null )
    $('#my-polar-area-chart').highcharts().destroy();

  $('#my-polar-area-chart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Page reach',
            align: 'center',
            verticalAlign: 'middle',
            y: 40
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: 'Page impressions',
            innerSize: '50%',
            data: [
                ['Viral',   pageData.page_impressions_viral],
                ['Organic',       pageData.page_impressions_organic],
                ['Paid', pageData.page_impressions_paid],
                {
                    name: 'Proprietary or Undetectable',
                    y: 0.2,
                    dataLabels: {
                        enabled: false
                    }
                }
            ]
        }]
    });
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
    comment = postData.comment;
    fan = postData.fan;
    link = postData.link;
    other = postData.other;
  }
  

  // setTimeout(populateFacebookPostModalChart, 5000, comment, fan, link, other); //chart has a bug so sleeping till canvas is ready
  // populateFacebookPostModalChart(comment, fan, link, other);
  populateFacebookPostModalHighChart(comment, fan, link, other);
}


function populateFacebookPostModalHighChart (comment, fan, link, other) {
  
  $("#fbModalText").text("Post impressions"); //change from Loading to the title
  if( $('#modal-polar-area-chart').highcharts() != null )
    $('#modal-polar-area-chart').highcharts().destroy();
  $('#modal-polar-area-chart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Page reach',
            align: 'center',
            verticalAlign: 'middle',
            y: 40
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: 'Page impressions',
            innerSize: '50%',
            data: [
                ['Comment',   comment],
                ['Fan', fan],
                ['Link', link],
                ['Other', other],
                {
                    name: 'Proprietary or Undetectable',
                    y: 0.2,
                    dataLabels: {
                        enabled: false
                    }
                }
            ]
        }]
    });
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

