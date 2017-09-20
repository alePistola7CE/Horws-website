$(function() {

    //Set up instafeed
    var feed = new Instafeed({
        clientId: '404795e9bb394bf3bdfdf4e5684c908b',
        accessToken: '4506821562.404795e.21136a7408dd426d9e76d98e97b36e69',
        target: 'instafeed',
        get: 'tagged',
        tagName: '1',
        links: true,
        limit: 6,
        sortBy: 'random',
        resolution: 'standard_resolution',
        template: '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"><div class="photo-box"><div class="image-wrap"><a href="{{link}}"><img src="{{image}}"></a><div class="likes">{{likes}} Likes</div></div><div class="description">{{caption}}<div class="date">{{model.date}}</div></div></div></div>'
    });

    feed.run();

  /*  //Set up instafeed
    var feed2 = new Instafeed({
        clientId: '404795e9bb394bf3bdfdf4e5684c908b',
        accessToken: '4506821562.404795e.21136a7408dd426d9e76d98e97b36e69',
        target: 'instafeed2',
        get: 'tagged',
        tagName: '2',
        links: true,
        limit: 3,
        sortBy: 'random',
        resolution: 'standard_resolution',
        template: '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"><div class="photo-box"><div class="image-wrap"><a href="{{link}}"><img src="{{image}}"></a><div class="likes">{{likes}} Likes</div></div><div class="description">{{caption}}<div class="date">{{model.date}}</div></div></div></div>'
    });

    feed2.run();*/





});
