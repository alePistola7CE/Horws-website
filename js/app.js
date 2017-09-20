$(function() {

    //Set up instafeed
    var feed = new Instafeed({
        accessToken: '4506821562.1677ed0.ed6e9447b7594b5b810127e23dd0770b',
        target: 'instafeed',
        get: 'tagged',
        tagName: 'dolomiti',
        links: true,
        limit: 8,
        sortBy: 'most-recent',
        resolution: 'standard_resolution',
        template: '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3"><div class="photo-box"><div class="image-wrap"><a href="{{link}}"><img src="{{image}}"></a><div class="likes">{{likes}} Likes</div></div><div class="description">{{caption}}<div class="date">{{model.date}}</div></div></div></div>'
    });
    feed.run();

});
