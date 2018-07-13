<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Puzzle_Blog
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="google-site-verification" content="-PTVyZG_un6__weu11y7kQxbrB2shvlG7ZMmfScs7vo" />
<meta name = "description" content = "<?=mb_substr(get_the_excerpt(),0,125); ?>..."/>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="icon" type="image/gif" href="<?=get_template_directory_uri()?>/img/favicon.png">
<script>
    "use strict";
    (function(){
        window.baseURI = '<?=get_template_directory_uri();?>';
    })();
</script>
<?php wp_head(); ?>
<?php if(is_search()):?>
<title><? get_template_part( 'template-search/title', 'search' ); ?></title>
<?php else:?>
<title><?php wp_title(); ?></title>
<?php endif;?> 
<?php $home=home_url();?>
</head>
<body <?php body_class(); ?>>
    <header>
        <!--<div id="top-line" class="container-fluid">
            <div class="container">
                <div class="row justify-content-between">
                    <a href="" id="logo" class="col-7 col-sm-7 col-md-4 col-lg-4 col-xl-4" > <img src="<?php bloginfo('template_url'); ?>/img/logo.jpg" > </a>
                    <ul class="col col-sm-5 col-md-5 col-lg-5 col-xl-5 list-unstyled menu-flex mt-2 hider">
                        <li class="mr-4"><a href="https://www.puzzletravel.com" class="menu">Anasayfa</a></li>
                        <li class="mr-5"><a href="https://www.puzzletravel.com/tr/hakkimizda/" class="menu">Hakkımızda</a></li>
                        <li class="mr-5"><a href="https://www.puzzletravel.com/tr/iletisime-gecin/" class="menu">İletişim</a></li>
                    </ul>
                    <ul class="col hider col-sm-2 col-md-2 col-lg-2 col-xl-2 list-unstyled hider lets-begin justify-content-end menu-flex mt-2">
                        <li class="mr-3"><a href="https://www.facebook.com/Puzzle.Travel/?fref=ts" class="menu"><i class="fa fa-facebook"></i></a></li>
                        <li class="mr-3"><a href="https://twitter.com/puzzletravel" class="menu"><i class="fa fa-twitter"></i></a></li>
                        <li class="mr-3"><a href="https://plus.google.com/+PuzzleTravelGazimağusa" class="menu"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="https://www.linkedin.com/company-beta/3291608/?lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_companies%3Bt66P67CfTMWbOdNeoZ6%2FJg%3D%3D&amp;licu=urn%3Ali%3Acontrol%3Ad_flagship3_search_srp_companies-search_srp_result" class="menu"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                    <div class="mt-2 col-5 col-sm-5 col-md-1 col-lg-1 col-xl-1 text-right">
                        <a href="javascript:void(0)" class="menu" onclick="openNav()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
            </div>  
        </div>
        <div class="top">
            <div id="top-navbar" class="overlay">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div class="container relative h-100">
                    <div class="mega-menu-horizontal-center">
                        <div class="row">
                            <div class="col-xl-4 border-right-white pr-5">
                                <div>
                                    <img class="hider" src="<?=get_template_directory_uri()?>/img/mega-menu-logo.png" alt="">
                                </div>
                               <ul class="list-unstyled mt-2">
                                    <li class="py-0 border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr" class="color-orange font-size-18">ANASAYFA</a>
                                    </li> <li class="py-0 border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/hakkimizda/" class="color-orange font-size-18">HAKKIMIZDA</a>
                                    </li>
                                    <li class="py-0 border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/booking/" class="color-orange font-size-18">PUZZLE BOOKING</a>
                                    </li>
                                </ul>
                                <div class="col-sm-12 hider m-300">
                                    <div class="row mt-2">
                                        <div class="col-sm-4 pr-0 logo-box align-self-center text-center" data-placement="bottom" data-toggle="tooltip" title="Kıbrıs Otelleri"><a href="http://www.tatildukkani.com"><img class="img-fluid" src="https://cdn.puzzletravel.com/static/version1521201964/frontend/PuzzleTravel/Theme/tr_TR/img/tatildukkani.png" alt="Kıbrıs Otelleri"></a> </div>
                                        <div class="col-sm-4 logo-box align-self-center" data-placement="bottom" data-toggle="tooltip" title="www.reservart.com"><a href="http://www.reservart.com"><img class="img-fluid pt-2" src="https://cdn.puzzletravel.com/static/version1521201964/frontend/PuzzleTravel/Theme/tr_TR/img/reservart.png" alt=""></a></div>
                                        <div class="col-sm-4 pb-0 logo-box align-self-center text-center" data-placement="bottom" data-toggle="tooltip" title="www.puzzlebooking.com"><a href="http://www.puzzlebooking.com"><img class="img-fluid pt-2" src="https://cdn.puzzletravel.com/static/version1521201964/frontend/PuzzleTravel/Theme/tr_TR/img/pzlbooking.png" alt=""></a></div>
                                    </div>
                                </div>
                            </div>

                            <div id="new" class="col-xl-4 border-left-white border-right-white padding-left-right-navbar">
                <div id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card background-transparent">
                        <div class="card-header background-transparent border-bottom-gray pl-0" role="tab" id="headingOne">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="font-size-30 new-top-bar-class">
                                    <i class="fa pz-icons-20" aria-hidden="true"></i> MICE <span class="fa fa-angle-down poa-r-0" aria-hidden="true"></span>
                                    <div class="mega-menu-tab-subtitle">Tecrübeli, profesyonel ve dinamik kadrosu ile PUZZLE TRAVEL MICE</div>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="card-block">
                                <ul class="list-unstyled">
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/mice/" class="hover-menu-font-24 new-top-bar-class">MICE ANASAYFA</a>
                                    </li>
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/mice-oteller/" class=hover-menu-font-24 new-top-bar-class">MICE OTELLERİ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div  class="card background-transparent">
                        <div class="card-header background-transparent border-bottom-gray pl-0" role="tab" id="headingTwo">
                            <h5 class="mb-0">
                                <a class="collapsed font-size-30 new-top-bar-class" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa pz-icons-se-90" aria-hidden="true"></i> Oteller <span class="fa fa-angle-down poa-r-0" aria-hidden="true"></span>
                                    <div class="mega-menu-tab-subtitle">Unutulmaz tatil anılarınızı biriktirirken Puzzle Travel ailesi.</div>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="card-block">
                                <ul class="list-unstyled">
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/oteller/" class="hover-menu-font-24 new-top-bar-class">OTEL ANASAYFA</a>
                                    </li>
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/kibris-otelleri/" class="hover-menu-font-24 new-top-bar-class">KIBRIS OTELLERİ</a>
                                    </li>
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/balayi-otelleri/" class="hover-menu-font-24 new-top-bar-class">BALAYI OTELLERİ</a>
                                    </li>
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/sanatcili-oteller/" class="hover-menu-font-24 new-top-bar-class">SANATCILI OTELLER</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card background-transparent">
                        <div class="card-header background-transparent border-bottom-gray pl-0" role="tab" id="headingThree">
                            <h5 class="mb-0">
                                <a class="collapsed font-size-30 new-top-bar-class" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fa pz-icons-57" aria-hidden="true"></i> Bilet <span class="fa fa-angle-down poa-r-0" aria-hidden="true"></span>
                                    <div class="mega-menu-tab-subtitle">7/24 kesintisiz bilet hizmeti veren Puzzle Travel farkı.</div>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-block">
                                <ul class="list-unstyled">
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/ucak-bileti/" class="hover-menu-font-24 new-top-bar-class">REZERVASYON</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card background-transparent">
                        <div class="card-header background-transparent border-bottom-gray pl-0" role="tab" id="headingFour">
                            <h5 class="mb-0">
                                <a class="collapsed font-size-30 new-top-bar-class" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <i class="fa pz-icons-73" aria-hidden="true"></i> Turlar <span class="fa fa-angle-down poa-r-0" aria-hidden="true"></span>
                                    <div class="mega-menu-tab-subtitle mt-3">Unutulmaz tatil anılarınızı biriktirirken Puzzle Travel ailesi.</div>
                                </a>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="card-block">
                                <ul class="list-unstyled">
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/turlar/" class="hover-menu-font-24 new-top-bar-class">TUR ANASAYFA</a>
                                    </li>
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/yurtici-turlari/" class="hover-menu-font-24 new-top-bar-class">YURTİÇİ TURLAR</a>
                                    </li>
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/gemi-turlari/" class="hover-menu-font-24 new-top-bar-class">GEMİ TURLARI</a>
                                    </li>
                                    <li class="border-bottom-gray">
                                        <a href="https://www.puzzletravel.com/tr/yurtdisi-turlari/" class="hover-menu-font-24 new-top-bar-class">YURTDIŞI TURLARI</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 padding-left-right-navbar">
                <div class="col-sm-12 hider">
                    <div class="row">
                        <div class="font-size-18 color-orange">İLETİŞİME GEÇİN</div>
                        <div class="mega-menu-tab-subtitle">Puzzle Travel Kıbrıs`ta kolaylıkla ulaşabileceğiniz erişim numaraları ve adres bilgilerini aşağıda bulabilirsiniz.</div>
                        <div class="font-size-18 color-orange mt-0">
                            <i class="fa pz-icons-55" aria-hidden="true"></i> TELEFON
                        </div>
                        <div class="mega-menu-tab-subtitle col-sm-12 pl-0"><a href="tel:+903926306200" class="mega-menu-tab-subtitle p-0"><span class="mega-menu-tab-subtitle">+(90)392 630 62 00</span></a> +(90)392 630 62 29 (Fax) </div>
                        <div class="font-size-18 color-orange mt-0">
                            <i class="fa pz-icons-se-95" aria-hidden="true"></i> ADRES
                        </div>
                        <div class="mega-menu-tab-subtitle"> Gülseren Yolu Cahit Sıtkı Tarancı Sokak No:23 Karakol Bölgesi Gazimağusa / K.K.T.C </div>
                        <div class="font-size-18 color-orange mt-0"><i class="fa pz-icons-66" aria-hidden="true"></i> EMAIL</div>
                        <div class="mega-menu-tab-subtitle col-sm-12 pl-0">info@puzzletravel.com</div>
                        <div class="mt-2"> <a href="https://www.puzzletravel.com/tr/iletisim/" class="button-white font-weight-bold font-size-20 text-center">İLETİŞİM</a> </div>
                    </div>
                </div>
                <div class="col-sm-12 lets-begin">
                    <div class="row">

                        <div class="col-sm-4 col-4 pr-0 logo-box align-self-center text-center" data-placement="bottom" data-toggle="tooltip" title="Kıbrıs Otelleri"><a href="http://www.tatildukkani.com"><img class="img-fluid" src="https://cdn.puzzletravel.com/static/version1521201964/frontend/PuzzleTravel/Theme/tr_TR/img/tatildukkani.png" alt="Kıbrıs Otelleri"></a> </div>
                        <div class="col-sm-4 col-4 logo-box align-self-center" data-placement="bottom" data-toggle="tooltip" title="www.reservart.com"><a href="http://www.reservart.com"><img class="img-fluid pt-2" src="https://cdn.puzzletravel.com/static/version1521201964/frontend/PuzzleTravel/Theme/tr_TR/img/reservart.png" alt=""></a></div>
                        <div class="col-sm-4 col-4 pb-0 logo-box align-self-center text-center" data-placement="bottom" data-toggle="tooltip" title="www.puzzlebooking.com"><a href="http://www.puzzlebooking.com"><img class="img-fluid pt-2" src="https://cdn.puzzletravel.com/static/version1521201964/frontend/PuzzleTravel/Theme/tr_TR/img/pzlbooking.png" alt=""></a></div>

                    </div>
                </div>

            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>-->
          <div id="top-line" class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <a href="<?=$home?>" id="logo" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 " ><center> <img src="<?php bloginfo('template_url'); ?>/img/Puzzle-Logo3.png" ></center> </a>
                </div>
            </div>  
        </div>
        <div class="container-fluid">
            <div class="row">
                <div id="sub-page-parallax" style="background-image:url(<?php bloginfo('template_url'); ?>/img/Kyrenia-Cyprus.jpg)">
                    <div class="shadow pr-0 pl-0">
                        <div class="container pt-5">
                            <div class="text-center font-weight-bold text-white mt-1">
                                <div style="font-size: 35px !important;">Kıbrıs'ta<br>En çok nereyi merak ediyorsunuz?</div>
                                <div id="blog-search-bar" class="col-sm-12 pt-5">
                                    <div class="row">
                                        <form action="" class="col-xl-12 border-radius-10 p-1 tab-pane active">
                                            <strong>
                                            <center>
                                              <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
                                            </center>
                                            </strong>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row justify-content-center ">
                                <div class=" alt-menu-style" onclick="location.href='<?=$home?>/ulke/kuzey-kibris-turk-cumhuriyeti/'">    
                                    <i class="icon-sun-umbrella alt-menu-icon-style" aria-hidden="true"></i><br>
                                    <span class="mt-2 line-height-25">Kuzey Kıbrıs<br>Türk Cumhuriyeti</span>
                                </div>
                                <div class="alt-menu-style pt-5" onclick="location.href='<?=$home?>/ozellik/?cat=7&country=81' ">    
                                    <i class="fa pz-icons-85 alt-menu-icon-style mt-3" aria-hidden="true"></i><br>
                                    <span class="mt-2">Gezilecek Yerler</span>
                                </div>
                                <div class="alt-menu-style pt-5" onclick="location.href='<?=$home?>/ozellik/?cat=9&country=81' ">    
                                    <i class="icon-spotlights alt-menu-icon-style mt-3" aria-hidden="true"></i><br>
                                    <span class="mt-2">Eğlence Mekanları</span>
                                </div>
                                <div class="alt-menu-style pt-5" onclick="location.href='<?=$home?>/ozellik/?cat=8&country=81' ">    
                                    <i class="icon-bank alt-menu-icon-style mt-3" aria-hidden="true"></i><br>
                                    <span class="mt-5">Tarihi Mekanlar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--<div class="container-fluid bg-orange">
            <div class="row justify-content-center">
                <div class=" align-content-center">
                    <div class="container">
                        <div id="active" class="row justify-content-center">
                            <button onclick="location.href='<?=$home?>/ulke/kuzey-kibris-turk-cumhuriyeti/' " class="col-sm-3 second-nav-items text-center">Kuzey Kıbrıs</button>
                            <button onclick="location.href='<?=$home?>/ozellik/?cat=7&country=81' " class="col-sm-3 second-nav-items text-center">Gezilecek Yerler</button>
                            <button onclick="location.href='<?=$home?>/ozellik/?cat=9&country=81' " class="col-sm-3 second-nav-items text-center">Eğlence Mekanları</button>
                            <button onclick="location.href='<?=$home?>/ozellik/?cat=8&country=81' " class="col-sm-3 second-nav-items text-center">Tarihi Mekanlar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </header>
    <script type="text/javascript">

        // FULL PAGE MENU
        function openNav() {
            document.getElementById("top-navbar").style.width = "100%";
            document.getElementsByTagName('html')[0].style.overflow = 'hidden';
        }

        function closeNav() {
            document.getElementById("top-navbar").style.width = "0%";
            document.getElementsByTagName('html')[0].style.overflow = 'auto';
        }

        // END
    </script>
    
   