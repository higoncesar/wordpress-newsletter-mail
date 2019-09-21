<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: Newsletter Mail
Description: Enviar um email para a lista e emails cadastrados para ser notificado sempre que tiver alguma novidade no blog
Author: Davi
*/

class NMail{
    private $nmailOptions, $phpmailer_error;

    public function __construct() {
		$this->setup_vars();
		$this->hooks();
	}

	public function setup_vars(){
		$this->nmailOptions = get_option( 'nmail_options' );
    }
    
    public function hooks() {
		register_activation_hook( __FILE__ , array( $this,'nmail_install' ) );
		register_deactivation_hook( __FILE__, array( $this, 'nmail_uninstall' ) );

		add_action( 'phpmailer_init', array( $this,'nmail' ) );
		add_action( 'wp_mail_failed', array( $this, 'catch_phpmailer_error' ) );
		add_action( 'admin_menu', array( $this, 'nmail_admin' ) );
		add_action('transition_post_status', array($this, 'send_mail_notification_new_post'), 10, 3);
    }
    
    function nmail_install(){

		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();
		$table_name = $wpdb->prefix . 'nmail_subscribers';
	
		$sql = "CREATE TABLE $table_name (
			id int(11) NOT NULL AUTO_INCREMENT,
			name varchar(255) NULL,
			email varchar(255) NOT NULL,
			status varchar(100) NOT NULL,
			date timestamp NULL,
			PRIMARY KEY (id)
		) $charset_collate;";
	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

        $nmailOptions = array();
		$nmailOptions["from"] = "";
		$nmailOptions["fromname"] = "";
		$nmailOptions["host"] = "";
		$nmailOptions["smtpsecure"] = "";
		$nmailOptions["port"] = "";
		$nmailOptions["smtpauth"] = "yes";
		$nmailOptions["username"] = "";
		$nmailOptions["password"] = "";

		add_option( 'nmail_options', $nmailOptions );
	}
	
	function nmail_uninstall() {
		//delete_option( 'nmail_options' );
	}

    function nmail( $phpmailer ) {

		if( ! is_email($this->nmailOptions["from"] ) || empty( $this->nmailOptions["host"] ) ) {
			return;
		}
		$phpmailer->Mailer = "smtp";
		$phpmailer->From = $this->nmailOptions["from"];
		$phpmailer->FromName = $this->nmailOptions["fromname"];
		$phpmailer->Sender = $phpmailer->From; //Return-Path
		$phpmailer->AddReplyTo($phpmailer->From,$phpmailer->FromName); //Reply-To
		$phpmailer->Host = $this->nmailOptions["host"];
		$phpmailer->SMTPSecure = $this->nmailOptions["smtpsecure"];
		$phpmailer->Port = $this->nmailOptions["port"];
		$phpmailer->SMTPAuth = ($this->nmailOptions["smtpauth"]=="yes") ? TRUE : FALSE;

		if( $phpmailer->SMTPAuth ){
			$phpmailer->Username = $this->nmailOptions["username"];
			$phpmailer->Password = $this->nmailOptions["password"];
		}
	}

	function catch_phpmailer_error( $error ) {
		$this->phpmailer_error = $error;
	}

    function nmail_admin()
    {
        add_menu_page(
            'NewsLetter Mail', 
            'NewsLetter Mail', 
            'manage_options', 
            'newsletter-mail',
            array( $this, 'nmail_page')
        );
    }

    function nmail_page(){
        require_once 'nmail-menu-settings.php';
	}

	function send_mail_notification_new_post($new, $old, $post){
		if($old!='auto-draft')
			return;

		$message = "New: $new Old: $old";
		
		wp_mail( 'admin@example.com', $message, $post->post_content );
	}

}


new NMail();

