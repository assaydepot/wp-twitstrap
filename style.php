<?php
header("Content-type: text/css");
$twitstrap_options = twitstrap_get_global_options();
?>

body {
    padding: 30px 0 0;
    background-color: <?php echo $twitstrap_options['twitstrap_background_color']; ?> !important;
    color: <?php echo $twitstrap_options['twitstrap_font_color']; ?> !important;
}

.navbar-inner {
    background-image: -moz-linear-gradient(center top , <?php echo $twitstrap_options['twitstrap_menu_color_1']; ?>, <?php echo $twitstrap_options['twitstrap_menu_color_2']; ?>) !important;
}

.twitstrap_footer {
    text-align: center;
    background-color: <?php echo $twitstrap_options['twitstrap_footer_background_color']; ?>;
}

.twitstrap_footer_section_1 {
    padding: 5px;
    text-align: <?php echo $twitstrap_options['twitstrap_footer_1_align']; ?> !important;
}

.twitstrap_footer_section_2 {
    padding: 5px;
    text-align: <?php echo $twitstrap_options['twitstrap_footer_2_align']; ?>;
}

.twitstrap_footer_section_3 {
    padding: 5px;
    text-align: <?php echo $twitstrap_options['twitstrap_footer_3_align']; ?>;
}

.widget-area {
    font-size: 14px;
    line-height: 16px;
}

.widget-area li {
    margin-bottom: 5px;
    list-style-type: none;
}

.widget-area li h2 {
    font-size: 16px;
    line-height: 18px;
}

.widget-area li ul li{
    margin-bottom: 0px;
    list-style-type: disc;
}