<?php
  
  
  wp_enqueue_style('nmail_styles_css', plugin_dir_url(__FILE__) . 'css/styles.css');
  wp_enqueue_script('nmail_script_js', plugin_dir_url(__FILE__) . 'js/script.js');

  if (isset($_POST['nmail_smtp_update'])) {
    $this->nmailOptions["from"] = sanitize_email( trim( $_POST['nmail_from'] ) );
    $this->nmailOptions["fromname"] = sanitize_text_field( trim( $_POST['nmail_fromname'] ) );
    $this->nmailOptions["host"] = sanitize_text_field( trim( $_POST['nmail_host'] ) );
    $this->nmailOptions["smtpsecure"] = sanitize_text_field( trim( $_POST['nmail_smtpsecure'] ) );
    $this->nmailOptions["port"] = is_numeric( trim( $_POST['nmail_port'] ) ) ? trim( $_POST['nmail_port'] ) : '';
    $this->nmailOptions["smtpauth"] = sanitize_text_field( trim( $_POST['nmail_smtpauth'] ) );
    $this->nmailOptions["username"] = defined( 'WP_SMTP_USER' ) ? WP_SMTP_USER : sanitize_text_field( trim( $_POST['nmail_username'] ) );
    $this->nmailOptions["password"] = defined( 'WP_SMTP_PASS' ) ? WP_SMTP_PASS : sanitize_text_field( trim( $_POST['nmail_password'] ) );
    
    update_option("nmail_options", $this->nmailOptions);
  }

  if (isset($_POST['nmail_test'])) {
    $to = sanitize_text_field( trim( $_POST['nmail_to'] ) );
    $subject = sanitize_text_field( trim( $_POST['nmail_subject'] ) );
    $message = sanitize_textarea_field(trim( $_POST['nmail_message'] ) );
    $status = false;
    $class = 'error';

    try {
      $result = wp_mail( $to, $subject, $message );
    } catch (Exception $e) {
      $status = $e->getMessage();
    }

    if ( ! $status ) {
      if ( $result === true ) {
          $status = 'Mensagem enviada!';
          $class = 'success';
      } else {
          $status = $this->phpmailer_error->get_error_message();
      }
    }
    echo '<div id="message" class="notice notice-' . $class . ' is-dismissible"><p><strong>' . $status . '</strong></p></div>';
  }
?>

<div class="wrap">
  <h1>Newsletter Mail</h1>

  <div class="nav-tab-wrapper">
    <a href="#subscriptions" data-tab-name="subscriptions" class="nav-tab">Lista Inscritos</a>
    <a href="#smtp" data-tab-name="smtp" class="nav-tab">Configurações SMTP</a>
    <a href="#test-email" data-tab-name="test-email" class="nav-tab">Teste de E-mail</a>
  </div>

  <div class="nmail-tab-container" data-tab-name="subscriptions">
    <h3 class="hndle"><label for="title">Lista Inscritos</label></h3>
    <?php require_once 'includes/admin/subscriptions-screen.php';?>
  </div>
  
  <div class="nmail-tab-container" data-tab-name="smtp">
    <div class="postbox">
      <div class="inside">
        <h3 class="hndle"><label for="title">Configurações SMTP</label></h3>

        <?php require_once 'includes/admin/smtp-screen.php';?>
        
      </div>
    </div>
  </div>

  <div class="nmail-tab-container" data-tab-name="test-email">
    <div class="postbox">
      <div class="inside">
        <h3 class="hndle"><label for="title">Teste Email</label></h3>

        <p>
        Você pode testar as configurações do seu servidor SMTP, 
        preenchendo os dados abaixo e verificar se o email chegou na destinatario informado.
        </p>

        <?php require_once 'includes/admin/test-email-screen.php';?>
        
      </div>
    </div>
  </div>
  
</div>