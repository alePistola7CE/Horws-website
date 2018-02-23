$(function() {

    //Set up instafeed
    if (window.location.pathname == "/index.html" || window.location.pathname == "/" || window.location.pathname == "/Horws-web/wordpress-horws/"){
      var feed = new Instafeed({
          clientId: '404795e9bb394bf3bdfdf4e5684c908b',
          accessToken: '4506821562.404795e.21136a7408dd426d9e76d98e97b36e69',
          target: 'instafeed',
          get: 'tagged',
          tagName: '1',
          links: false,
          limit: 6,
          sortBy: 'random',
          resolution: 'standard_resolution',
          template: '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"><div class="photo-box"><div class="image-wrap"><img src="{{image}}" class="photo" alt="{{caption}}"><div class="likes">{{likes}} Likes</div></div><div class="description">{{caption}}<div class="date">{{model.date}}</div></div></div></div>',
          after: function(){
            var modal = document.getElementById('myModal');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            var instafeed = document.getElementById('instafeed');
            for (i = 1; i < instafeed.childElementCount; i++) {
              var div = instafeed.children[i];
              var photobox = div.children[0];
              var imagewrap = photobox.children[0];
              //var a = imagewrap.children[0];
              var img = imagewrap.children[0];
              img.onclick = function(){
              modal.style.display = "block";
              modalImg.src = this.src;
              captionText.innerHTML = this.alt;
              }
            }

            var span = document.getElementsByClassName("close")[0];
            span.onclick = function() {
            modal.style.display = "none";
            }
          }
      });
      feed.run();
    } else {  //if(window.location.pathname == "/photos.html" || window.location.pathname == "/Horws-website/photos.html" ||  window.location.pathname == "/Horws-web/wordpress-horws/")
        var hashTags = new Array("canazei", "conero", "roma");

        //creazione immagini

        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        var img = document.getElementsByClassName("photo");
        for (s=0; s < img.length; s++){
          img[s].onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
          }
        }

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
          modal.style.display = "none";
        }

      }




    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
                        //se non siamo in cima alla pagina
            $('#top').fadeIn(); //faccio apparire il box
        } else {
                        //altrimenti (il visitatore è in cima alla pagina scrollTop = 0)
            $('#top').fadeOut();//Il box scompare
        }
    });//Allo scroll function


    $('#top').click(function() {
                //Se clicco sul box torno su (scrollTop:0) con un timing di animazione.
        $('body,html').animate({scrollTop:0},800);
    });//Click

});
