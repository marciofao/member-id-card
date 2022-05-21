<?php
$usr = get_user_by('id', $_GET['card-view']);
?>
<style>
    html {
        font-size: 1vw;
        font-family: Arial, Helvetica, sans-serif;
    }

    h1 {
        font-size: 2em;
    }

    .card {
        border: 1px solid black;
        width: 50em;
        height: 28.9em;
        position: relative;
    }

    .qrcode {
        width: 10em;
    }

    .picture {}

    .tac {
        text-align: center;
    }
    .prel{
        position: relative;
    }
    .W100{
        width: 100%;
    }
    .activity{
        
        position: absolute;
        bottom: 0;
        text-transform: uppercase;
        font-size: 3em;
       
    }

   <?php 
    do_action('mic_card_page_custom_css');
  ?>
    
</style>



<div class="card card-front">
<?php 
    do_action('mic_card_page_html_before_front');
?>
    <h2><span class="display-name"><?php echo $usr->display_name ?> </span></h2>


    <img src="<?php echo get_site_url() ?>?card-generate=<?php echo $_GET['card-view'] ?>" alt="QR Code" class="qrcode">

    <div class="tac ">
        <div class="activity w100"><?php _e("Usuário Ativo", "mic") ?></div>
    </div>

<?php 
  do_action('mic_card_page_html_after_front');
?>
</div>
<div class="card card-back">
<?php 
    do_action('mic_card_page_html_before_back');
?>

<?php 
    do_action('mic_card_page_html_after_back');
?>

</div>