<?php
/**
 * @package Quran Translations by EDC
 * @version 1.0
 */
/*
 Plugin Name: Quran Translations by EDC
 Plugin URI: http://www.islam.com.kw/support
 Description: Quran Translations plugin is the first WordPress plugin that allows you to display a playlist for the translations of the meaning of the Quran.
 Version: 1.0
 Author: EDC Team (E-Da`wah Committee)
 Author URI: http://www.islam.com.kw
 License: It is Free -_-
*/
include('functions.php');
register_activation_hook(__FILE__,'quran_playlist_plugin_install'); 
//add_action('init','quran_playlist_plugin_init');

wp_enqueue_style( 'wp-mediaelement' );
wp_enqueue_script( 'wp-mediaelement' );
wp_enqueue_script( 'wp-playlist' );
do_action( 'wp_playlist_scripts', 'audio', 'light' );

function quran_playlist_plugin_install(){
	add_option( 'quran_playlist_form', '1', null );
	add_option( 'show_quran_playlist_rss', 'on', null );
	add_option( 'show_playlist_pdf', 'on', null );
	add_option( 'show_playlist_podcast', 'on', null );
	add_option( 'show_playlist_txt', 'on', null );
	add_option( 'show_playlist_MediaPlayer', 'on', null );
	add_option( 'show_playlist_QuickTime', 'on', null );
	add_option( 'show_playlist_realplayer', 'on', null );
	add_option( 'show_playlist_Winamp', 'on', null );
	add_option( 'show_playlist_tunein', 'on', null );
	add_option( 'playlist_title', 'Quran Translations', null );
}
//$language_id = get_option('quran_playlist_form');

function QuranTranslations_sounds_loop($language_id=0){
global $sora_names;

$id = QuranTranslations_get_languages($language_id,"id");
$QuranTranslationsgetsounds = QuranTranslations_get_sounds($id);
$arrayname = QuranTranslations_get_sounds($id);
$QuranTranslationscountsounds = count($QuranTranslationsgetsounds);
$countsounds = count($QuranTranslationsgetsounds);

$nl = "\n";
$code = '';

if(get_option('show_playlist_pdf') == 'on'){ $show_playlist_pdf = '<a target="_blank" href="'.QuranTranslations_get_languages($language_id,"pdf").'"><img src="'.trailingslashit(plugins_url(null,__FILE__)).'images/pdf.png" alt="'.QuranTranslations_get_languages($language_id,"title").' PDF" title="'.QuranTranslations_get_languages($language_id,"title").' PDF" /></a>'; }else{ $show_playlist_pdf = ''; }
if(get_option('show_quran_playlist_rss') == 'on'){ $show_playlist_rss = '<a target="_blank" href="'.QuranTranslations_get_languages($language_id,"rss").'"><img src="'.trailingslashit(plugins_url(null,__FILE__)).'images/rss.png" alt="'.QuranTranslations_get_languages($language_id,"title").' RSS" title="'.QuranTranslations_get_languages($language_id,"title").' RSS" /></a>'; }else{ $show_playlist_rss = ''; }
if(get_option('show_playlist_podcast') == 'on'){ $show_playlist_podcast = '<a target="_blank" href="'.QuranTranslations_get_languages($language_id,"podcast").'"><img src="'.trailingslashit(plugins_url(null,__FILE__)).'images/podcast.png" alt="'.QuranTranslations_get_languages($language_id,"title").' Podcast" title="'.QuranTranslations_get_languages($language_id,"title").' Podcast" /></a>'; }else{ $show_playlist_podcast = ''; }
if(get_option('show_playlist_txt') == 'on'){ $show_playlist_txt = '<a target="_blank" href="'.QuranTranslations_get_languages($language_id,"txt").'"><img src="'.trailingslashit(plugins_url(null,__FILE__)).'images/Download.png" alt="'.QuranTranslations_get_languages($language_id,"title").' Download" title="'.QuranTranslations_get_languages($language_id,"title").' Download" /></a>'; }else{ $show_playlist_txt = ''; }
if(get_option('show_playlist_MediaPlayer') == 'on'){ $show_playlist_MediaPlayer = '<a target="_blank" href="'.QuranTranslations_get_languages($language_id,"mediaplayer").'"><img src="'.trailingslashit(plugins_url(null,__FILE__)).'images/MediaPlayer.png" alt="'.QuranTranslations_get_languages($language_id,"title").' Mediaplayer" title="'.QuranTranslations_get_languages($language_id,"title").' Mediaplayer" /></a>'; }else{ $show_playlist_MediaPlayer = ''; }
if(get_option('show_playlist_QuickTime') == 'on'){ $show_playlist_QuickTime = '<a target="_blank" href="'.QuranTranslations_get_languages($language_id,"quicktime").'"><img src="'.trailingslashit(plugins_url(null,__FILE__)).'images/QuickTime.png" alt="'.QuranTranslations_get_languages($language_id,"title").' Quicktime" title="'.QuranTranslations_get_languages($language_id,"title").' Quicktime" /></a>'; }else{ $show_playlist_QuickTime = ''; }
if(get_option('show_playlist_realplayer') == 'on'){ $show_playlist_realplayer = '<a target="_blank" href="'.QuranTranslations_get_languages($language_id,"realplayer").'"><img src="'.trailingslashit(plugins_url(null,__FILE__)).'images/Realplayer.png" alt="'.QuranTranslations_get_languages($language_id,"title").' Realplayer" title="'.QuranTranslations_get_languages($language_id,"title").' Realplayer" /></a>'; }else{ $show_playlist_realplayer = ''; }
if(get_option('show_playlist_Winamp') == 'on'){ $show_playlist_Winamp = '<a target="_blank" href="'.QuranTranslations_get_languages($language_id,"winamp").'"><img src="'.trailingslashit(plugins_url(null,__FILE__)).'images/Winamp.png" alt="'.QuranTranslations_get_languages($language_id,"title").' Winamp" title="'.QuranTranslations_get_languages($language_id,"title").' Winamp" /></a>'; }else{ $show_playlist_Winamp = ''; }
if(get_option('show_playlist_tunein') == 'on'){ $show_playlist_tunein = '<a target="_blank" href="'.QuranTranslations_get_languages($language_id,"tunein").'"><img src="'.trailingslashit(plugins_url(null,__FILE__)).'images/Tunein.png" alt="'.QuranTranslations_get_languages($language_id,"title").' Tunein" title="'.QuranTranslations_get_languages($language_id,"title").' Tunein" /></a>'; }else{ $show_playlist_tunein = ''; }

if(QuranTranslations_get_languages($language_id,"pdf") == ""){ $pdf = ""; }else{ $pdf = $show_playlist_pdf; }
if(QuranTranslations_get_languages($language_id,"rss") == ""){ $rss = ""; }else{ $rss = $show_playlist_rss; }
if(QuranTranslations_get_languages($language_id,"podcast") == ""){ $podcast = ""; }else{ $podcast = $show_playlist_podcast; }
if(QuranTranslations_get_languages($language_id,"txt") == ""){ $txt = ""; }else{ $txt = $show_playlist_txt; }
if(QuranTranslations_get_languages($language_id,"mediaplayer") == ""){ $mediaplayer = ""; }else{ $mediaplayer = $show_playlist_MediaPlayer; }
if(QuranTranslations_get_languages($language_id,"quicktime") == ""){ $quicktime = ""; }else{ $quicktime = $show_playlist_QuickTime; }
if(QuranTranslations_get_languages($language_id,"realplayer") == ""){ $realplayer = ""; }else{ $realplayer = $show_playlist_realplayer; }
if(QuranTranslations_get_languages($language_id,"winamp") == ""){ $winamp = ""; }else{ $winamp = $show_playlist_Winamp; }
if(QuranTranslations_get_languages($language_id,"tunein") == ""){ $tunein = ""; }else{ $tunein = $show_playlist_tunein; }

$code .= '<div class="wp-playlist wp-audio-playlist wp-playlist-light">'.$nl;
$code .= '<div class="wp-playlist-current-item"></div>'.$nl;

$code .= '<div style="text-align:center;">'.$show_playlist_pdf.' '.$rss.' '.$podcast.' '.$txt.' '.$mediaplayer.' '.$quicktime.' '.$realplayer.' '.$winamp.' '.$tunein.'</div>'.$nl;

$code .= '<p><audio class="wp-audio-shortcode" id="audio-'.$id.'" preload="none" style="width: 100%;" controls="controls"><source type="audio/mpeg" src="'.$arrayname[0][1].'?_=1" /><a href="'.$arrayname[0][1].'">'.$arrayname[0][1].'</a></audio></p>'.$nl;
$code .= '<div class="wp-playlist-next"></div>'.$nl;
$code .= '<div class="wp-playlist-prev"></div>'.$nl;
$code .= '<p>'.$nl;
$code .= '<script type="application/json">{'.$nl;
$code .= '"type":"audio",'.$nl;
$code .= '"tracklist":true,'.$nl;
$code .= '"tracknumbers":true,'.$nl;
$code .= '"images":true,'.$nl;
$code .= '"artists":false,'.$nl;
$code .= '"tracks":['.$nl;
for ($i=0; $i<$countsounds; $i++) {
if($countsounds == $i+1){ $addcomma = ''; }else{ $addcomma = ','; }

$code .= '{'.$nl;
$code .= '"src":"'.$arrayname[$i][1].'",'.$nl;
$code .= '"type":"audio\/mpeg",'.$nl;
if (is_numeric($arrayname[$i][0])) {
$code .= '"title":"'.$sora_names[$arrayname[$i][0]].'",'.$nl;
}else{
$code .= '"title":"'.$arrayname[$i][0].'",'.$nl;
}
$code .= '"caption":"",'.$nl;
$code .= '"description":"",'.$nl;
$code .= '"meta":{'.$nl;
$code .= '"artist":"'.QuranTranslations_get_languages($language_id,"title").'",'.$nl;
$code .= '"album":"'.QuranTranslations_get_languages($language_id,"language").'",'.$nl;
$code .= '"genre":"Quran"'.$nl;
//$code .= ',"length_formatted":"3:21"'.$nl;
$code .= '},'.$nl;
$code .= '"image":{"src":"'.trailingslashit(plugins_url(null,__FILE__)).'/images/logo.png","width":250,"height":250},'.$nl;
$code .= '"thumb":{"src":"'.trailingslashit(plugins_url(null,__FILE__)).'/images/logo.png","width":250,"height":250}'.$nl;
$code .= '}'.$addcomma.$nl.$nl;
}
$code .= ']'.$nl;
$code .= '}</script>'.$nl;
$code .= '</div>'.$nl;
return $code;
}

function quran_playlist_content_replace ($text){
$text = preg_replace('/quran_playlist\[([0-9]*?)\]/e','QuranTranslations_sounds_loop(\\1)',$text);
return $text;
}
 
add_filter('the_content','quran_playlist_content_replace');

add_action( 'admin_menu', 'quran_playlist_menu' );

function quran_playlist_menu() {
	add_menu_page( 'Quran Translations', 'Quran Translations', 'manage_options', 'quran-playlist-edit', 'quran_playlist_options', ''.trailingslashit(plugins_url(null,__FILE__)).'/images/quran.png' );
}

function quran_playlist_options() {
	global $languages;
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

if(isset($_POST['submitted']) && $_POST['submitted'] == 1){

	if(isset($_POST['show_quran_playlist_rss'])){ $show_playlist_rss = 'on'; }else{ $show_playlist_rss = 'off'; }
	if(isset($_POST['show_playlist_pdf'])){ $show_playlist_pdf = 'on'; }else{ $show_playlist_pdf = 'off'; }
	if(isset($_POST['show_playlist_podcast'])){ $show_playlist_podcast = 'on'; }else{ $show_playlist_podcast = 'off'; }
	if(isset($_POST['show_playlist_txt'])){ $show_playlist_txt = 'on'; }else{ $show_playlist_txt = 'off'; }
	if(isset($_POST['show_playlist_MediaPlayer'])){ $show_playlist_MediaPlayer = 'on'; }else{ $show_playlist_MediaPlayer = 'off'; }
	if(isset($_POST['show_playlist_QuickTime'])){ $show_playlist_QuickTime = 'on'; }else{ $show_playlist_QuickTime = 'off'; }
	if(isset($_POST['show_playlist_realplayer'])){ $show_playlist_realplayer = 'on'; }else{ $show_playlist_realplayer = 'off'; }
	if(isset($_POST['show_playlist_Winamp'])){ $show_playlist_Winamp = 'on'; }else{ $show_playlist_Winamp = 'off'; }
	if(isset($_POST['show_playlist_tunein'])){ $show_playlist_tunein = 'on'; }else{ $show_playlist_tunein = 'off'; }

	update_option( 'quran_playlist_id', 0 );
	update_option( 'show_quran_playlist_rss', $show_playlist_rss );
	update_option( 'show_playlist_pdf', $show_playlist_pdf );
	update_option( 'show_playlist_podcast', $show_playlist_podcast );
	update_option( 'show_playlist_txt', $show_playlist_txt );
	update_option( 'show_playlist_MediaPlayer', $show_playlist_MediaPlayer );
	update_option( 'show_playlist_QuickTime', $show_playlist_QuickTime );
	update_option( 'show_playlist_realplayer', $show_playlist_realplayer );
	update_option( 'show_playlist_Winamp', $show_playlist_Winamp );
	update_option( 'show_playlist_tunein', $show_playlist_tunein );
	update_option( 'playlist_title', addslashes($_POST['playlist_title']) );
}

if(isset($_POST['playlist_code']) && $_POST['playlist_code'] == 1){
update_option( 'quran_playlist_form', $_POST['quran_playlist_form'] );
}

if(get_option('show_playlist_pdf') == 'on'){ $check_show_playlist_pdf = 'checked="checked"'; }else{ $check_show_playlist_pdf = ''; }
if(get_option('show_quran_playlist_rss') == 'on'){ $check_show_playlist_rss = 'checked="checked"'; }else{ $check_show_playlist_rss = ''; }
if(get_option('show_playlist_podcast') == 'on'){ $check_show_playlist_podcast = 'checked="checked"'; }else{ $check_show_playlist_podcast = ''; }
if(get_option('show_playlist_txt') == 'on'){ $check_show_playlist_txt = 'checked="checked"'; }else{ $check_show_playlist_txt = ''; }
if(get_option('show_playlist_MediaPlayer') == 'on'){ $check_show_playlist_MediaPlayer = 'checked="checked"'; }else{ $check_show_playlist_MediaPlayer = ''; }
if(get_option('show_playlist_QuickTime') == 'on'){ $check_show_playlist_QuickTime = 'checked="checked"'; }else{ $check_show_playlist_QuickTime = ''; }
if(get_option('show_playlist_realplayer') == 'on'){ $check_show_playlist_realplayer = 'checked="checked"'; }else{ $check_show_playlist_realplayer = ''; }
if(get_option('show_playlist_Winamp') == 'on'){ $check_show_playlist_Winamp = 'checked="checked"'; }else{ $check_show_playlist_Winamp = ''; }
if(get_option('show_playlist_tunein') == 'on'){ $check_show_playlist_tunein = 'checked="checked"'; }else{ $check_show_playlist_tunein = ''; }
$playlist_title = strip_tags(get_option('playlist_title'));
?>
	<div id="mainblock" class="submit">
			<div class="dbx-content" style="background-color:#ffffff; border:1px solid #cccccc; padding:5px; text-align:center;">				
				<h2>Quran Translations</h2>
				<br />
				<form name="sytform" action="" method="post">
					<input type="hidden" name="playlist_code" value="1" />
					<h3>Create Shortcode:</h3>
					<div>
							<label for="quran_playlist_form">Select Language:</label>
						<select name="quran_playlist_form" id="quran_playlist_form">
							<?php for($i = 1; $i <= count(QuranTranslations_get_languages(0, "", 1)); $i++): ?>
	<option value="<?php echo $i; ?>" <?php echo ( get_option('quran_playlist_form') == $i ) ? 'selected="yes"' : ''; ?>><?php echo QuranTranslations_get_languages($i, "language", 0).' - '.QuranTranslations_get_languages($i, "title", 0); ?></option>
							<?php endfor; ?>
						</select>
	<?php  ?>
					</div>
					<div style="padding: 1.5em 0;margin: 5px 0;">
						<input type="submit" name="Create" value="<?php echo 'Create Shortcode'; ?>" />
					</div>
				</form>
	
	<?php
	if(isset($_POST['playlist_code']) && $_POST['playlist_code'] == 1){ 
		echo '<div style="background-color:#333333; border:1px solid #cccccc; color:#ffffff; padding:5px; margin:10px 0 10px 0;">Copy shortcode <span style="color:yellow;">quran_playlist['.intval($_POST['quran_playlist_form']).']</span> and paste in post/page.</div>'; 
	}else{ 
		echo ''; 
	}
	
	?>
			</div>   
		</div>
	
	<div id="mainblock" class="submit">
			<div class="dbx-content">				
				<form name="sytform" action="" method="post">
					<input type="hidden" name="submitted" value="1" />
	<!--
					<h3>playlist Title:</h3>
					<div>
						<input id="playlist_title" type="text" name="playlist_title" value="<?php echo htmlentities($playlist_title); ?>" />
						<label for="playlist_title">if empty will write language title.</label>
					</div>
					-->
					<h3>Options:</h3>
					<div>
						<input id="show_playlist_pdf" type="checkbox" name="show_playlist_pdf" <?php echo $check_show_playlist_pdf; ?> />
						<label for="show_playlist_pdf">PDF Book</label>
					</div>
					<div>
						<input id="show_playlist_rss" type="checkbox" name="show_quran_playlist_rss" <?php echo $check_show_playlist_rss; ?> />
						<label for="show_playlist_rss">RSS</label>
					</div>
					<div>
						<input id="show_playlist_podcast" type="checkbox" name="show_playlist_podcast" <?php echo $check_show_playlist_podcast; ?> />
						<label for="show_playlist_podcast">Podcast</label>
					</div>
					<div>
						<input id="show_playlist_txt" type="checkbox" name="show_playlist_txt" <?php echo $check_show_playlist_txt; ?> />
						<label for="show_playlist_txt">Download Links</label>
					</div>
					<div>
						<input id="show_playlist_MediaPlayer" type="checkbox" name="show_playlist_MediaPlayer" <?php echo $check_show_playlist_MediaPlayer; ?> />
						<label for="show_playlist_MediaPlayer">MediaPlayer</label>
					</div>
					<div>
						<input id="show_playlist_QuickTime" type="checkbox" name="show_playlist_QuickTime" <?php echo $check_show_playlist_QuickTime; ?> />
						<label for="show_playlist_QuickTime">QuickTime</label>
					</div>
					<div>
						<input id="show_playlist_realplayer" type="checkbox" name="show_playlist_realplayer" <?php echo $check_show_playlist_realplayer; ?> />
						<label for="show_playlist_realplayer">Realplayer</label>
					</div>
					<div>
						<input id="show_playlist_Winamp" type="checkbox" name="show_playlist_Winamp" <?php echo $check_show_playlist_Winamp; ?> />
						<label for="show_playlist_Winamp">Winamp</label>
					</div>
					<div>
						<input id="show_playlist_tunein" type="checkbox" name="show_playlist_tunein" <?php echo $check_show_playlist_tunein; ?> />
						<label for="show_playlist_tunein">Tunein</label>
					</div>
					
					<div style="padding: 1.5em 0;margin: 5px 0;">
						<input type="submit" name="Submit" value="<?php echo 'Update options'; ?>" />
					</div>
				</form>
			</div>   
		</div>
						
<?php
}
?>