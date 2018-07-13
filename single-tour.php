<?php
/**
 *
 *
 * @package puzzle
 */
get_header(); ?>

<?php

while ( have_posts() ) : the_post();

$content = get_post_meta(get_the_ID(), '', true);
$days = maybe_unserialize( $content['tour_days_repeat_group'][0]);
$include = maybe_unserialize( $content['tour_services_includeservices'][0]);
$extras = maybe_unserialize( $content['tour_services_extraservices'][0]);
$notes = maybe_unserialize( $content['tour_other_details_notes'][0]);
//printarr($content);
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-xl-8 mb-5">
            <div class="cart-form-title d-inline pr-5 pb-2">Tur Güzergahı</div>
            <div class="h3 color-gray hotel-info-res my-3"><?=$content['tour_details_sub_title'][0]?></div>
            <?php foreach($days as $key=>$day): ?>
            <div class="tour-day mt-4">
                <div class="tour-day-header d-flex mb-4">
                    <div class="py-1 px-2 font-weight-bold"><?=$key+1?>. GÜN</div>
                    <div class="pl-3"><?=$day['tour_days_title']?></div>
                </div>
                <div class="d-flex">
                    <?=wp_get_attachment_image($day['tour_days_day_image_id'],array(220,170,true), "", array( "class" => "mr-4" ))?>
                    <div class="text-justify"><?=$day['tour_days_wysiwyg']?></div>
                </div>
            </div>
            <?php endforeach; ?>
                <hr>
            <?php if(isset($content['tour_details_dates'])):?>
            <div>
                <div class="color-orange font-weight-bold mt-4 mb-2">Tarihler</div>
                <?=$content['tour_details_dates'][0]?>
            </div>
                <hr>
            <?php endif;?>
            <div>
                <div class="color-orange font-weight-bold mt-4 mb-2">Fiyat Tablosu</div>
                <?=$content['tour_details_prices'][0]?>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="color-orange font-weight-bold mt-4 mb-2">Dahil Olan Hizmetler</div>
                    <?php foreach($include as $extra): ?>
                        <div class="mb-2 font-size-12"><i class="fa fa-square color-orange pr-2"></i> <?=$extra?></div>
                    <?php endforeach; ?>
                </div>
                <div class="col-xl-6">
                    <div class="color-orange font-weight-bold mt-4 mb-2">Dahil Olmayan Hizmetler</div>
                    <?php foreach($extras as $extra): ?>
                        <div class="mb-2 font-size-12"><i class="fa fa-square color-orange pr-2"></i> <?=$extra?></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div>
                <div class="color-orange font-weight-bold mt-4 mb-2">Önemli Bilgiler</div>
                <?php foreach($notes as $extra): ?>
                    <div class="mb-2 font-size-12"><i class="fa fa-square color-orange pr-2"></i> <?=$extra?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="border-gray-light pt-3 px-2">
                <div class="clearfix tour-side-details">
                    <div class="pull-left h3 w-75"><?php echo the_title( '', '', true );?></div>
                    <?php if($content['tour_details_isvisa'][0] != "visa"): ?>
                    <div class="pull-right relative">
                        <small class="bg-success text-center text-white p-2"><?php _e('novisa', 'puzzle'); ?></small>
                    </div>
                    <?else:?>
                    <div class="pull-right relative">
                        <small class="bg-success text-center text-white p-2">Vizeli</small>
                    </div>
                    <?php endif; ?>
                </div>
                <hr class="my-1">
                <div class="row">
                    <div class="col-xl-6 hotel-info-res text-center">
                        <div><span>Rezervasyon Hattı:</span></div>
                        <div class="font-weight-bold">0392 630 62 00</div>
                    </div>
                    <div class="col-xl-6 hotel-info-res-2">
                        <div>ya da <a href="" data-toggle="modal" data-target="#teklif-formu">tıklayın</a></div>
                        <div>biz sizi arayalım!</div>
                    </div>
                </div>
                <hr class="mt-1 mb-0">
                <div class="row no-gutters">
                    <div class="col">
                        <div class="background-orange p-3 margin-left-reset hotel-info-discount">
                            <?php if(isset($content['tour_details_discountprice'][0]) !== false && isset($content['tour_details_price'][0]) !== false):?>
                            %<?php echo (floor(100 - (100/$content['tour_details_discountprice'][0])*$content['tour_details_price'][0])); ?> İNDİRİM
                            <?php else:?>
                                <div class="font-size-20">Avantajlı Fiyat</div>
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="col text-center hotel-info-price no-wrap"><?=explode(',',$content['tour_details_price'][0])[0]?> <i class="fa fa-<?=$content['tour_details_cour'][0]?>"></i></div>
                </div>
            </div>
            <div class="asistan-container px-3 py-2 mt-4" style="font-size: 18px;">
                <div>
                    Gidiş: <?=$content['tour_flights_from_from_zone'][0]?> <i class="fa fa-plane color-orange"></i> <?=$content['tour_flights_from_to_zone'][0]?>
                </div>
                <div>
                    Dönüş : <?=$content['tour_flights_to_from_zone'][0]?> <i class="fa fa-plane color-orange"></i> <?=$content['tour_flights_to_to_zone'][0]?>
                </div>
            </div>
            <button class="btn w-100 background-orange button-hover border-radius-none cursor my-4" data-toggle="modal" data-target="#teklif-formu">DAHA FAZLA BİLGİ İSTE</button>
            <div class="asistan-container px-3 py-2 mt-4">
                <div class="asistan-title d-flex mb-2">
                    <i class="fa fa-phone mr-2"></i>
                    <div>Asistana mı ihtiyacınız var?</div>
                </div>
                <div class="text-justify mb-2 asistan-desc">
                    Sizi yönlendirecek ve daha bir çok soru hakkında cevap alabileceğiniz asistanınız bir telefon kadar yakın!
                </div>
                <div class="color-orange asistan-phone">0392 630 62 00</div>
            </div>
        </div>
    </div>
</div>


<!-- Rezervasyon Formu Modal -->
<div class="modal fade" id="teklif-formu" tabindex="-1" role="dialog" aria-labelledby="teklif-formu-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teklif-formu-title">Rezervasyon Formu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo do_shortcode( '[contact-form-7 id="6716" title="Rezervasyon Formu"]', false ); ?>
    </div>
  </div>
</div>


<?php
endwhile;
get_footer();