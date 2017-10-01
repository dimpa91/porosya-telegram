<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://web-porosya.com/home/
 * @since             1.0
 * @package           porosya-telegram
 *
 * @wordpress-plugin
 * Plugin Name:       Porosya Telegram Integration
 * Plugin URI:        http://web-porosya.com/home/
 * Description:       Create and manage custom admin notices with ajax, have functions to do it with hooks.
 * Version:           1.0
 * Author:            Kisenko Dmitro
 * Author URI:        http://web-porosya.com/home/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       porosya-telegram
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'POROSYA_TELEGRAM_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'POROSYA_TELEGRAM_PLUGIN_URL', plugin_dir_url(__FILE__) );

// add options page

add_action('admin_menu', 'add_plugin_page');
function add_plugin_page(){
	add_options_page( 'Настройки Telegram', 'Telegram', 'manage_options', 'telegram_opt', 'telegram_options_page_output' );
}

function telegram_options_page_output(){
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>		
		<form action="options.php" method="POST">
			<?php
				settings_fields( 'option_group' );     // скрытые защитные поля
				do_settings_sections( 'telegram_page' ); 
				submit_button();
			?>
		</form>
		
		<div class="telegram-window">
			<p>Ответ от сервера, логи истории.</p>
			<div class="telegram-field"></div>
			<button id="refreshTelegram" class="button button-primary">Обновить текст</button>
		</div>
		
		<br><br><br>
		<h4>Инструкции</h4>
		<p>В верхнее поле нужно ввести токен. Чтобы получить токен нужно написать в телеграме контакту <a href="https://telegram.me/@BotFather">@BotFather</a> и читать инструкции</p>
		<p>Чтобы узнать id чата - напишите своему боту и обновите логи. Там будет строка наподобие {"id":000000000,"first_name":"dmitry","username":"dimpa91"} - id это то, что нужно. Вставьте сколько нужно, каждый с новой строки </p>
		<p>В коде темы где нужно выводить оповещение воспользуйтесь функцией sendTelegramMessage($text, $chat_id) <br>
		Пример: sendTelegramMessage('Привет'); отправит всем чатам фразу привет, функция вернет результат отправки. <br>
		sendTelegramMessage('Привет', 0000000); отправит привет только в чат с id 0000000.
		</p>
		<p>Детальная инструкция: <a href="http://web-porosya.com/porosya-telegram-plagin/">Porosya Telegram плагин</a></p>
	</div>
	<?php
}

add_action('admin_init', 'plugin_settings');
function plugin_settings(){
	// параметры: $option_group, $telegram_options, $sanitize_callback
	register_setting( 'option_group', 'telegram_options', 'sanitize_callback' );

	// параметры: $id, $title, $callback, $page
	add_settings_section( 'section_id', 'Основные настройки', '', 'telegram_page' ); 

	// параметры: $id, $title, $callback, $page, $section, $args
	add_settings_field('api_field', 'API ключ', 'fill_api_field', 'telegram_page', 'section_id' );
	add_settings_field('chat', 'Список чатов', 'fill_chat', 'telegram_page', 'section_id' );
}

function fill_api_field(){
	$val = get_option('telegram_options');
	$val = $val['telegram_api_key'];
	?>
	<input type="text" class="regular-text code" name="telegram_options[telegram_api_key]" value="<?php echo esc_attr( $val ) ?>" id="telKey" />
	<?php
}

function fill_chat(){
	$val = get_option('telegram_options');
	$val = $val['telegram_chat'];
	?>
	<p>Каждая строка - новый chat_id или логин канала</p>
	<textarea name="telegram_options[telegram_chat]" class="regular-text code pt-textarea"><?php echo esc_attr( $val ) ?></textarea>
	<?php
}

function sanitize_callback( $options ){ 
	// очищаем
	foreach( $options as $name => & $val ){
		if( $name == 'input' )
			$val = strip_tags( $val );

		if( $name == 'checkbox' )
			$val = intval( $val );
	}

	return $options;
}

// add scripts and styles 

	function porosya_scripts() {	
		wp_enqueue_script( "po_te_scr", POROSYA_TELEGRAM_PLUGIN_URL . "js/script.js", array( 'jquery' ));
		wp_enqueue_style( "po_te_stl", POROSYA_TELEGRAM_PLUGIN_URL . "css/style.css" );
	}
	
	add_action( "admin_enqueue_scripts", "porosya_scripts" );

// send function 

function send_notice($text, $chat) {
	
}

// если нет chat_id то отправит автоматически.

function sendTelegramMessage($text = '', $chat_id = 0)
	{
		// get token 
		
		$options = get_option('telegram_options');
		$token = $options['telegram_api_key'];
		if (!$chat_id) {
			// get chats 		
			$chats = explode("\n",$options['telegram_chat']);
		} else {
			$chats[0] = $chat_id;
		}
		
		if (!$token) return 'No token';
		if (!$chats) return 'No chats';
		
		$resultat = array();
		
		foreach ($chats as $chat) {
			
			$result_ =  @file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat&text=".urlencode($text));
			
			if($result = json_decode($result_)) {
				$resultat[$chat] = $result;
			} else {
				$resultat[$chat] = 'error';
			}
		}
		
		return $resultat;
	}
	
	