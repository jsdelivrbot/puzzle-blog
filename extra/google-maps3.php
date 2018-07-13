
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
                            '<img class="d-flex align-self-start cursor" src="<?=wp_get_attachment_image_url(get_post_thumbnail_id($iceriksehir -> icerik_detay_image_id),array(224,182,true));?>" alt="<?php echo the_title( '', '', true );?>" style="width: 149px; height: 100px;">'+
                            '<div class="media-body pl-3 cursor">'+
                                '<div class="color-orange font-weight-bold font-14 cursor yazi-decoration"><?php echo the_title( '', '', true );?><br><small>(<?=$selectname?>)</small></div>'+
                                '<div class="address cursor yazi-decoration"><?=mb_substr(get_the_excerpt(),0,80); ?>...<span class="color-orange font-weight-bold"> Devamını Gör</span></div>'+
                            '</div>'+
                        '</div></a>';

                /*"<?php echo the_title( '', '', true );?>";*/

                var infowindow = new google.maps.InfoWindow({ content: contentString });

                map = new google.maps.Map(document.getElementById('konum-maps3'), mapOptions);
                var marker = new google.maps.Marker({
                    position: kordinat,
                    map: map,
                    title: "<?php echo the_title( '', '', true );?>",
                    icon: '<?=get_template_directory_uri() ?>/img/yer1.png',
                    animation: google.maps.Animation.DROP,
                    draggable:false,
                });
                      infowindow.open(map, marker);
                    marker.addListener('click', function() {
                            <?php foreach ($eylenmaps as $wkey => $wvalue): ?>
                           
                                infowindoweylen<?=$wkey?>.close();
                            
                            <?php endforeach ?>
                            infowindow.open(map, marker);
                        });
                <?php
                foreach ($eylenmaps as $key => $value) { 
                    $a= get_post_meta($value -> ID, '', true);
                    ?>
                    var image = '<?php bloginfo('template_url'); ?>/img/icon2.png';
                    var contenteylen<?=$key?> = '<?php mb_internal_encoding("UTF-8");?><a class="left cursor yazi-decoration" href="<?=$value->guid?>">'+
                        '<div class="media cursor" style="width: 317px;">'+
                            '<img class="d-flex align-self-start cursor" src="<?=wp_get_attachment_image_url(get_post_thumbnail_id($value -> ID),array(140,79,true));?>" alt="<?=$value->post_title?>" style="width: 149px; height: 100px;">'+
                            '<div class="media-body pl-3 cursor">'+
                                '<div class="color-orange font-weight-bold font-14 cursor yazi-decoration"><?=$value->post_title?><br><small>(Eğlence Mekanları)</small></div>'+
                                '<div class="address cursor yazi-decoration"><?=mb_substr($value->post_content,0,80); ?>...<span class="color-orange font-weight-bold"> Devamını Gör</span></div>'+
                            '</div>'+
                        '</div></a>';
                    var infowindoweylen<?=$key?> = new google.maps.InfoWindow({ content: contenteylen<?=$key?> });
                    var beachMarkereylen<?=$key?> = new google.maps.Marker({
                    position: {lat: <?=$a['icerik_detay_enlem'][0]?>, lng: <?=$a['icerik_detay_boylam'][0]?>},
                    map: map,
                    icon: image,
                    title: "<?=$value->post_title?>"
                  });
                   beachMarkereylen<?=$key?>.addListener('click', function() {
                     infowindow.close();
                    <?php foreach ($eylenmaps as $wkey => $wvalue): 
                       if ($key!=$wkey) { ?>
                            infowindoweylen<?=$wkey?>.close();
                        
                    <?php }  endforeach ?>
                      infowindoweylen<?=$key?>.open(map, beachMarkereylen<?=$key?>);
                    });

                   
                <?php
                } ?>
                
               
                
                
                

            };
            google.maps.event.addDomListener(window, 'load', initialize);
    })
</script>