
<script>
    jQuery(document).ready(function(){
        var map;
        var zoomkontrol;
        var kordinat=new google.maps.LatLng(<?=$map?>);
        var center = new google.maps.LatLng(<?=$map?>);
        function initialize() {
            var styles = [
                    {
                        featureType: 'all',
                        elementType: 'all',
                        stylers: [
                            { hue: '#608fbe' },
                            { saturation: 0 }
                        ]
                    }
                ];
                var mapOptions = {
                    zoom: <?=$zoomkontrol?>,
                    scrollwheel: false,
                    center: center,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                      style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                      position: google.maps.ControlPosition.TOP_RIGHT,
                      mapTypeIds: ['roadmap', 'satellite']
                  },
                    panControlOptions: {
                        position: google.maps.ControlPosition.RIGHT_CENTER

                    },
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.RIGHT_CENTER
                    },
                    streetViewControl: false,
                };

                var contentString = '<?php mb_internal_encoding("UTF-8");?><a class="left cursor yazi-decoration" href="#">'+
                        '<div class="media cursor" style="width: 317px;">'+
                            '<img class="d-flex align-self-start cursor" src="<?=wp_get_attachment_image_url(get_post_thumbnail_id($content -> ID),array(224,182,true));?>" alt="<?php echo the_title( '', '', true );?>" style="width: 149px; height: 100px;">'+
                            '<div class="media-body pl-3 cursor">'+
                                '<div class="color-orange font-weight-bold font-14 cursor yazi-decoration"><?php echo the_title( '', '', true );?></div>'+
                                '<div class="address cursor yazi-decoration"><?=mb_substr(get_the_excerpt(),0,100); ?>...<span class="color-orange font-weight-bold"> Devamını Gör</span></div>'+
                            '</div>'+
                        '</div></a>';

                var infowindow = new google.maps.InfoWindow({ content: contentString });

                map = new google.maps.Map(document.getElementById('konum-maps-sehir'), mapOptions);
                var marker = new google.maps.Marker({
                    position: kordinat,
                    map: map,
                    title: "<?php echo get_post_type(get_the_ID()) == 'page' ? strip_tags($map_title) : strip_tags(mb_convert_case(get_the_title(), MB_CASE_TITLE, "UTF-8"))?>",
                    icon: '<?=get_template_directory_uri() ?>/img/yer1.png',
                    animation: google.maps.Animation.DROP,
                    draggable:false,
                });

                infowindow.open(map,marker);

            };
            google.maps.event.addDomListener(window, 'load', initialize);
    })
</script>