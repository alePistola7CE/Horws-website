$(function() {

    //Set up instafeed
    if (window.location.pathname == "/index.html" || window.location.pathname == "/" || window.location.pathname == "/Horws-website/"){
      var feed = new Instafeed({
          clientId: '404795xxxx394bf3bdfdfxxxx84c908b',
          accessToken: '45068215xxxx04795e.21136a7408xxxx6d9e76d98e97b36e69',
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
    } else if(window.location.pathname == "/photos.html" || window.location.pathname == "/Horws-website/photos.html"){
      var hashTags = new Array("canazei", "conero", "roma");
      var urls_canazei = new Array("images/canazei1.jpg", "images/canazei2.jpg", "images/canazei3.jpg");
      var descrizioni_canazei = new Array("Mostratemi un cuore non contaminato da folli sogni, e io vi mostrerò un uomo felice. Ma solo nei sogni gli uomini sono davvero felici, è da sempre così, e così sarà per sempre! -L'attimo fuggente-.", "When the sun comes up 🌄", "Dobbiamo solo avere la forza di riscoprire il nostro sole interiore..");
      var descrizioni_sirolo = new Array("Spiral clouds", "HDR throught my vision", "Ma ti sbagli se pensi che le gioie della vita vengano soprattutto dai rapporti tra le persone. Dio ha messo la felicità dappertutto e ovunque, in tutto ciò in cui possiamo fare esperienza. Abbiamo solo bisogno di cambiare il modo di guardare le cose. (Christopher McCandless)");
      var descrizioni_roma = new Array("Scatto attraverso la serratura del portone del Priorato dei Cavalieri di Malta...sullo sfondo la cupola di San Pietro 👀📸", "Sono gli altri le strade, io sono una piazza, non porto in nessun posto, io sono un posto.(Alessandro Baricco)", '"When the gusts came around to blow me down I held on as tightly as you held onto me"');
      var luogo_canazei = new Array("Rifugio Micheluzzi - Val Duron", "Val di Fassa", "Belvedere, Trentino-Alto Adige, Italy");
      var luogo_sirolo = new Array("San Michele, Sirolo", "Mezzavalle", "Spiaggia Urbani");
      var luogo_roma = new Array("Piazza Cavalieri Di Malta", "Piazza Navona", "Villa Pamphili");
      var luoghi = new Array(luogo_canazei, luogo_sirolo, luogo_roma);
      var descrizioniFoto = new Array(descrizioni_canazei, descrizioni_sirolo, descrizioni_roma);
      var urls_sirolo = new Array("images/sirolo1.jpg", "images/sirolo2.jpg", "images/sirolo3.jpg");
      var urls_roma = new Array("images/roma1.jpg", "images/roma2.jpg", "images/roma3.jpg");
      var uris = new Array(urls_canazei, urls_sirolo, urls_roma);
      var titles = new Array("Canazei", "Riviera del conero", "Roma");
      var ids = new Array("Canazei", "Riviera-del-conero", "Roma");
      var descrizioneCanazei = new String("<b>Canazei</b><a href='http://www.canazei.com/it/Origini-Del-Nome-Canazei'> (Cianacèi in lingua ladina)</a>, è senza dubbio uno dei &lsquo;paesi gioiello&rsquo; della provincia di Trento, situato in una magnifica conca verdeggiante all&rsquo;estremità settentrionale della <b>Val di Fassa</b>. L&rsquo;ubicazione felice, la storia e la lunga tradizione in materia di ospitalità la collocano tra le più note località dolomitiche. È considerata la <b>capitale degli sport sulla neve in Val di Fassa</b>, grazie soprattutto alla sua posizione strategica che la vede circondata dalle vette dolomitiche del <a href='http://www.canazei.com/it/Il-Gruppo-Del-Sassolungo'>Sassolungo</a>, del <a href='http://www.canazei.com/it/Gruppo-Del-Sella'>Gruppo del Sella</a> e della <a href='http://www.canazei.com/it/La-Marmolada'>Marmolada</a> che fa parte del <b>Patrimonio dell&rsquo;Umanità UNESCO</b>.");
      var descrizioneConero = new String("Un litorale unico, una sorprendente cornice a un <b>mare pulito</b> e <b>balneabile</b>. La fascia costiera a sud di <a href='http://www.turismo.marche.it/Guida/Chiese/Title/Ancona/IdPOI/5595/C/042002'>Ancona</a> è una distesa di bianche <a href='http://www.conero.it/it/itinerari/le-spiagge-della-riviera/'>spiagge</a> ancora incontaminate.");
      var descrizioneRoma = new String("<a href='https://it.wikipedia.org/wiki/Roma'>Roma</a>, capitale d&rsquo;Italia, è considerata una delle più belle città del mondo. Il suo <b>centro storico</b>, insieme alle proprietà extraterritoriali della <b>Santa Sede</b> dentro la città e alla <b>Basilica di San Paolo</b> Fuori le Mura, è tra i 51 siti italiani inseriti dall’<b>Unesco</b> nella <a href='http://whc.unesco.org/en/list/91'>World Heritage List </a>.");
      var descrizioni = new Array(descrizioneCanazei, descrizioneConero, descrizioneRoma);
      for (i=0; i<hashTags.length; i++){
        var Titolo = document.createElement('h3');
        var Descrizione = document.createElement('span');
        Titolo.innerHTML = titles[i];
        Titolo.id = ids[i];
        Descrizione.className = "descrizione";
        Descrizione.innerHTML = descrizioni[i];
        var divContenitoreInsta = document.createElement('div');
        var divContenitoreFoto = document.createElement('div');
        var divFeed = document.createElement('div');
        var divAnother = document.createElement('div');
        var aMore = document.createElement('a');
        divAnother.className = 'another';
        aMore.className = 'more';
        aMore.id = 'more';
        aMore.innerHTML = "Load more";
        divContenitoreInsta.className = "instagram-content";
        divContenitoreFoto.className = "row photos-wrap"
        divFeed.id = hashTags[i];

        divuno = document.getElementsByClassName('col-xs-12')[0];
        divuno.appendChild(divContenitoreInsta);
        divContenitoreInsta.appendChild(Titolo);
        divContenitoreInsta.appendChild(Descrizione);
        divContenitoreInsta.appendChild(divContenitoreFoto);
        divContenitoreFoto.appendChild(divFeed);

        //creazione immagini
        for (z=0; z<3; z++){
          var modal = document.getElementById('myModal');
          var modalImg = document.getElementById("img01");
          var captionText = document.getElementById("caption");
          var riga = document.getElementById(hashTags[i]);
          divResize = document.createElement("div");
          divResize.className = "col-xs-12 col-sm-6 col-md-4 col-lg-4";
          divFeed.appendChild(divResize);
          divPhotoBox = document.createElement('div');
          divPhotoBox.className = "photo-box";
          divResize.appendChild(divPhotoBox);
          divImagewrap = document.createElement('div');
          divImagewrap.className = "image-wrap";
          divPhotoBox.appendChild(divImagewrap);
          img = document.createElement('img');
          img.src = uris[i][z];
          img.className = "photo";
          img.alt = descrizioniFoto[i][z];
          img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
          }
          divImagewrap.appendChild(img);
          //icona gps
          iconGps = document.createElement('img');
          iconGps.src = "images/gps.png";
          iconGps.style.width = '22px';
          iconGps.style.display = 'inline-block';
          iconGps.alt = "Gps, position";

          //span Luogo
          spanLuogo = document.createElement('span');
          spanLuogo.innerHTML = luoghi[i][z];

          //divLikes
          divLikes = document.createElement("div");
          divLikes.className = "likes";
          divLikes.appendChild(iconGps);
          divLikes.appendChild(spanLuogo);

          divImagewrap.appendChild(divLikes);

          divDescription = document.createElement("div");
          divDescription.className = "description";
          divDescription.innerHTML = descrizioniFoto[i][z];
          divPhotoBox.appendChild(divDescription);

          }

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
        modal.style.display = "none";
        }

        //see more
        sMore = document.createElement('div');
        sMore.innerHTML = "See more about ";
        aLink = document.createElement('a');
        aLink.href =  '#' + ids[i]; //ids[i] + ".html";
        aLink.innerHTML = titles[i];
        sMore.style.textAlign = 'right';
        sMore.style.position = 'static';
        sMore.style.marginRight = "20px";
        sMore.appendChild(aLink);
        divContenitoreFoto.appendChild(sMore);
}
}

  /*divAnother.appendChild(aMore);
  divuno.appendChild(divAnother);*/


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
