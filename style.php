<?php
header( "Content-type: text/css" );
$current_url = dirname( __FILE__ );
$wp_content_pos = strpos( $current_url, 'wp-content' );
$wp_content = substr( $current_url, 0, $wp_content_pos );
require_once( $wp_content . 'wp-load.php' );

$twitstrap_options = twitstrap_get_global_options();
?>

body {
padding: 30px 0 0;
<?php
if ( ! empty( $twitstrap_options['twitstrap_background_color'] ) ) {
    echo 'background-color: ' . $twitstrap_options['twitstrap_background_color'] . ' !important;';
}
if ( ! empty( $twitstrap_options['twitstrap_font_color'] ) ) {
    echo 'color: ' . $twitstrap_options['twitstrap_font_color'] . ' !important;';
}
?>
}

h6 {
display: inline;
}

<?php if ( ! empty( $twitstrap_options['twitstrap_menu_color_1'] ) && ! empty( $twitstrap_options['twitstrap_menu_color_2'] ) ) { ?>
    .navbar-inner {
    <?php echo 'background-image: -moz-linear-gradient(center top, ' . $twitstrap_options['twitstrap_menu_color_1'] . ', ' . $twitstrap_options['twitstrap_menu_color_2'] . ') !important;'; ?>
    }
<?php } ?>

footer {
text-align: center;
<?php
if ( ! empty( $twitstrap_options['twitstrap_footer_background_color'] ) ) {
    echo 'background-color: ' . $twitstrap_options['twitstrap_footer_background_color'] . ';';
}
?>
}

.twitstrap_footer h2 {
border-bottom: 1px solid #EEEEEE;
font-size: 16px;
line-height: 18px;
}

.twitstrap_footer_section_1 {
padding: 5px;
<?php
if ( ! empty( $twitstrap_options['twitstrap_footer_1_align'] ) ) {
    echo 'text-align: ' . $twitstrap_options['twitstrap_footer_1_align'] . ' !important;';
}
?>
}

.twitstrap_footer_section_2 {
padding: 5px;
<?php
if ( ! empty( $twitstrap_options['twitstrap_footer_1_align'] ) ) {
    echo 'text-align: ' . $twitstrap_options['twitstrap_footer_2_align'] . ' !important;';
}
?>
}

.twitstrap_footer_section_3 {
padding: 5px;
<?php
if ( ! empty( $twitstrap_options['twitstrap_footer_1_align'] ) ) {
    echo 'text-align: ' . $twitstrap_options['twitstrap_footer_3_align'] . ' !important;';
}
?>
}

li.widget {
margin-bottom: 20px;
list-style-type: none;
}

.widget ul li{
margin-bottom: 0px;
list-style-type: disc;
}

.widgettitle {
font-size: 16px;
line-height: 18px;
border-bottom: 1px solid #EEEEEE;
}

.widget-area {
font-size: 14px;
line-height: 16px;
}

#twitstrap-calendar {
margin: 0 auto;
width: 85%;
}

#twitstrap-calendar th,
#twitstrap-calendar td {
text-align: center;
}

#next {
text-align: right !important;
}

#prev {
text-align: left !important;
}

#comments {
margin-top: 15px;
}

.badge a, .btn a {
color: #FFFFFF;
}

.children {
list-style-type: none;
}

.pingback {
margin-bottom: 10px;
padding: 5px 10px !important;
line-height: 16px !important;
}

.thumbnail img {
border: 1px solid #DDDDDD;
}

ul.media-list li {
border-bottom: 1px dotted #DDDDDD;
}

ul.children li {
margin-left: 20px;
border-bottom: 0px;
border-top: 1px dotted #DDDDDD;
}