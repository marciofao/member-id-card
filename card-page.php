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

    
</style>

<div class="card">
    <h2> <?php echo $usr->display_name ?> </h2>


    <img src="<?php echo get_site_url() ?>?card-generate=<?php echo $_GET['card-view'] ?>" alt="QR Code" class="qrcode">

    <div class="tac ">
        <div class="activity w100"><?php _e("Usuário Ativo", "mic") ?></div>
    </div>
</div>
<div class="card"></div>