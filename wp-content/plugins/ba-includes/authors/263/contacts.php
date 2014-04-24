<?php

getBaForm(0, 'contacts', '', '<hr />', 'authors');

//helper_likebox(array(
//    'facebook' => 'https://www.facebook.com/pages/LED-Computers/130383693659465',
//    'vkontakte' => '29728267',
//));

?>

<div id="map_led_1" class="contacs-page-map">
</div>

<?php if (WPLANG == 'am_HY') : ?>
<script>
    var _image = 'http://led.am/images/icon-led.png';
    /////////////////////

    var myLatlng = new google.maps.LatLng(40.185037,44.503126);
    var myOptions = {
     zoom: 14,
     center: myLatlng,
     mapTypeId:google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map_led_1"), myOptions);


    var myLatlng = new google.maps.LatLng(40.186636,44.512975);
    var	infowindow;
    marker = new google.maps.Marker({
        map:map,
        draggable:true,
        icon: _image,
        title:'Մասնաճյուղ Մաշտոց 37',
        position: myLatlng
      });
    google.maps.event.addListener(marker,'click',function() {
	    if (!infowindow) {
		    infowindow = new google.maps.InfoWindow();
	    }
	    infowindow.setContent('Օպերայի դիմաց, «ԲՈՒՐՄՈՒՆՔ»  խանութի հարևանությամբ  գտնվում է «Կոզիրյոկ» սրճարանը: «Կոզիրյոկ» սրճարանի մոտ անցնում է նեղ փողոց` սկիզբ առնելով «Մաշտոց» պողոտայից մինչև «Թումանյան» փ.: Դուք պետք է քայլեք այդ փողոցով, «Կոզիրյոկ» սրճարանից դեպի «Թումանյան» փ. ');
    infowindow.open(map, marker);
    });

    var myLatlng = new google.maps.LatLng(40.196622,44.490552);
    var	infowindow1;
    marker1 = new google.maps.Marker({
        map:map,
        draggable:true,
        icon: _image,
        title:'Մասնաճյուղ Կիևյան 11',
        position: myLatlng
      });
    google.maps.event.addListener(marker1,'click',function() {
	    if (!infowindow1) {
		    infowindow1 = new google.maps.InfoWindow();
	    }
	    infowindow1.setContent('Խանութը գտնվում է «Կիեվյան» փողոցում, մետրո «Բարեկամություն»-ից 100 մ. ներքև` «ՎիվաՍել» սրահի մոտ:');
    infowindow1.open(map, marker1);
    });

    var myLatlng = new google.maps.LatLng(40.177451,44.51879);
    var	infowindow2;
    marker2 = new google.maps.Marker({
        map:map,
        draggable:true,
        icon: _image,
        title:'Մասնաճյուղ Հանրապետության 62',
        position: myLatlng
      });
    google.maps.event.addListener(marker2,'click',function() {
	    if (!infowindow2) {
		    infowindow2 = new google.maps.InfoWindow();
	    }
	    infowindow2.setContent('Իջնելով Հանրապետության փ. (հին Ալավերդյան) հասնում եք Հանրապետության և Վարդանանց փողոցների խաչմերուկը, որտեղ գտնվում է «ԱՐԱՅ» խանութը, և թեքվում եք դեպի ձախ: Քայլելով Վարդանանց փողոցով, դեպի «Գնունի» շուկայի ուղությամբ մոտ 50 մետր, ձախ կողմի վրա, չհասած «');
    infowindow2.open(map, marker2);
    });
</script>
<?php endif ?>

<?php if (WPLANG == 'en_EN') : ?>
    <script>
var _image = 'http://led.am/images/icon-led.png';
/////////////////////

var myLatlng = new google.maps.LatLng(40.185037,44.503126);
var myOptions =
{
 zoom: 14,
 center: myLatlng,
 mapTypeId:google.maps.MapTypeId.ROADMAP
}
var map = new google.maps.Map(document.getElementById("map_led_1"), myOptions);


var myLatlng = new google.maps.LatLng(40.186636,44.512975);
var	infowindow;
marker = new google.maps.Marker({
    map:map,
    draggable:true,
    icon: _image,
    title:'Branch Mashtots 37',
    position: myLatlng
  });
google.maps.event.addListener(marker,'click',function() {
	if (!infowindow) {
		infowindow = new google.maps.InfoWindow();
	}
	infowindow.setContent('"Coziryok" is a cafe opposite the "Opera" next to the store "Burmunk". Next to the cafe "Coziryok",  a narrow street from avenu Mashtots to str.Tumanyan. You have to go down this street from the cafe "Coziryok" is approximately 50 meters towards str.Tuman');
infowindow.open(map, marker);
});

var myLatlng = new google.maps.LatLng(40.196622,44.490552);
var	infowindow1;
marker1 = new google.maps.Marker({
    map:map,
    draggable:true,
    icon: _image,
    title:'Branch Kievyan 11',
    position: myLatlng
  });
google.maps.event.addListener(marker1,'click',function() {
	if (!infowindow1) {
		infowindow1 = new google.maps.InfoWindow();
	}
	infowindow1.setContent('The shop is about 100m. below the subway station of "Barekamutyun" on the street Kievian.  In the neighborhood of salon "VivaCell".');
infowindow1.open(map, marker1);
});

var myLatlng = new google.maps.LatLng(40.177451,44.51879);
var	infowindow2;
marker2 = new google.maps.Marker({
    map:map,
    draggable:true,
    icon: _image,
    title:'Branch Hanrapetutyan 62',
    position: myLatlng
  });
google.maps.event.addListener(marker2,'click',function() {
	if (!infowindow2) {
		infowindow2 = new google.maps.InfoWindow();
	}
	infowindow2.setContent('Walking down the street Hanrapetutyan (old name str. Alaverdyan) walk to the crossroads of Hanrapetutyan and Vardanants streets where the store "ARAY", and turn left. Take a walk down the street towards the market str. Vardanants  "Gnuni" about 50m. a');
infowindow2.open(map, marker2);
});



</script>
<?php endif ?>

<?php if (WPLANG == 'ru_RU') : ?>
<script>
    var _image = 'http://led.am/images/icon-led.png';
    /////////////////////

    var myLatlng = new google.maps.LatLng(40.185037,44.503126);
    var myOptions =
    {
     zoom: 14,
     center: myLatlng,
     mapTypeId:google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map_led_1"), myOptions);


    var myLatlng = new google.maps.LatLng(40.186636,44.512975);
    var	infowindow;
    marker = new google.maps.Marker({
        map:map,
        draggable:true,
        icon: _image,
        title:'Филиал Маштоца 37',
        position: myLatlng
      });
    google.maps.event.addListener(marker,'click',function() {
	    if (!infowindow) {
		    infowindow = new google.maps.InfoWindow();
	    }
	    infowindow.setContent('Напротив Оперы находится кафе "Козырек" рядом с магазином "Бурмунк". Рядом с кафе "Козырек" проходит узкая улица от проспекта "Маштоца" до ул.Туманяна. Вы должны пройти по этой улице от кафе "Козырек" приблизительно 50 метров по направлению к ул.Туманяна,');
    infowindow.open(map, marker);
    });

    var myLatlng = new google.maps.LatLng(40.196622,44.490552);
    var	infowindow1;
    marker1 = new google.maps.Marker({
        map:map,
        draggable:true,
        icon: _image,
        title:'Филиал Киевяна 11',
        position: myLatlng
    });
    google.maps.event.addListener(marker1,'click',function() {
	    if (!infowindow1) {
		    infowindow1 = new google.maps.InfoWindow();
	    }
	    infowindow1.setContent('Магазин находится около 100м. ниже метро "Дружба" по улице Киевяна. Около салона "Vivacell".');
        infowindow1.open(map, marker1);
    });

    var myLatlng = new google.maps.LatLng(40.177451,44.51879);
    var	infowindow2;
    marker2 = new google.maps.Marker({
        map:map,
        draggable:true,
        icon: _image,
        title:'Филиал Анрапетутяна 62',
        position: myLatlng
    });
    google.maps.event.addListener(marker2,'click',function() {
	    if (!infowindow2) {
		    infowindow2 = new google.maps.InfoWindow();
	    }
	    infowindow2.setContent('Спускаясь по улице Анрапетутяна (стар. Алавердян) дойдите до перекрестка Анрапетутяна и Вардананца, где находится магазин "АРАЙ", и сверните налево. Пройдитесь по улице Вардананца в сторону рынка "Гнуни" около 50м. и слева, не доходя до детского кафе ');
        infowindow2.open(map, marker2);
    });
</script>
<?php endif ?>
