
/* Setup DOM-connections */
var $vegas_target   = $('body');
var $tickers_target = $('#ticker-container');
var $screens        = $('#screens');
var $updated_at     = $('#updated_at');
var $client_id      = $('#client_id');

$('html').addClass('animated');

var displayBackdrops = false;

/* Functions for access & changes in DOM */
function get_screens_from(element){
    var images = [];
    element.find('li').each(function() {
        images.push(
            { src: '/' + $(this).attr('src') }
        );
    })
    return images;
};
function put_screens_in(element,screens){
    var new_content = '';
    for (i=0 ; i<screens.length ; i++){
        new_content += "<li src='"+screens[i].image+"'></li>";
    }
    element.html(new_content); // Replace content in element
};
function put_tickers_in(element,tickers){
    var new_content = "<ul id='ticker'>";
    for (i=0 ; i<tickers.length ; i++){
        new_content += "<li>"+tickers[i].text+"</li>";
    }
    new_content += "</ul>";
    element.html(new_content); // Replace content in element
};

/*
var backgrounds = [
    { src: "/screens/images/$2y$10$HUabKjNqFsvOV3jsOp5ePuhUDIBag1zELC0BnMUx3OqwEgZ8SaZVa.png" },
    { src: "/screens/images/image_0.83359500 1455543895.png" }
];
*/

/* Start Ticker */
function start_ticker(){
  $tickers_target.find('#ticker').ticker({
    speed: 0.10,           // The speed of the reveal
    ajaxFeed: false,       // Populate jQuery News Ticker via a feed
    feedUrl: false,        // The URL of the feed
                           // MUST BE ON THE SAME DOMAIN AS THE TICKER
    feedType: 'xml',       // Currently only XML
    htmlFeed: true,        // Populate jQuery News Ticker via HTML
    debugMode: true,       // Show some helpful errors in the console or as alerts
                           // SHOULD BE SET TO FALSE FOR PRODUCTION SITES!
    controls: false,       // Whether or not to show the jQuery News Ticker controls
    titleText: '',         // To remove the title set this to an empty String
    displayType: 'fade',   // Animation type - current options are 'reveal' or 'fade'
    direction: 'ltr',      // Ticker direction - current options are 'ltr' or 'rtl'
    pauseOnItems: 10000,   // The pause on a news item before being replaced
    fadeInSpeed: 600,      // Speed of fade in animation
    fadeOutSpeed: 300      // Speed of fade out animation
  });
}
start_ticker();

/* Start Vegas */
$vegas_target.vegas({
    preload: true,
    transitionDuration: 4000,
    delay: 10000,
    slides: get_screens_from( $('#screens') )
});

/* Update-check */
var ajax_call = function () {
    var request = $.ajax({
        type: "get",
        url: "/play/" + $client_id.val(),
    });
    request.done(function() {
        var data = JSON.parse(request.responseText); // Fetch JSON-output
        if($updated_at.val() != data['updated_at']) { // Newer data found, update player:
            console.log('Client Updated, fetching newer data: (site: '+ $client_id.val() +', updated: '+ data['updated_at'] +')');
            update_player(
                data['photo_list'],
                data['tickers'],
                data['updated_at']
            );
        }
    });
}

setInterval( ajax_call, 1000*10 ); // Check for newer data each 10 sec

/* Perform update */
function update_player(new_screens, new_tickers, new_updated_at) {
    
    // Replace contents in DOM for screens-list
    put_screens_in( $screens, new_screens );

    // Restart Player Chain
    $vegas_target
      .vegas('pause')    // Pause
      .vegas('destroy')  // Destroy
      .vegas({           // Start New
        preload: true,
        transitionDuration: 4000,
        delay: 10000,
        slides: get_screens_from( $screens )
      })
      .vegas('play');    // Play
    
    // Replace contents in DOM for tickers
    put_tickers_in( $tickers_target, new_tickers );

    // Restart Ticker
    start_ticker();

    // Replace value of updated_at
    $updated_at.val(new_updated_at);
};