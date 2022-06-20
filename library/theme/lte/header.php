<?php
/*
  -------------------------------------------------------------------
  GAzie - Gestione Azienda
  Copyright (C) 2004-2022 Antonio De Vincentiis Montesilvano (PE)
  (http://www.devincentiis.it)
  <http://gazie.sourceforge.net>
  -------------------------------------------------------------------
  Questo programma e` free software;   e` lecito redistribuirlo  e/o
  modificarlo secondo i  termini della Licenza Pubblica Generica GNU
  come e` pubblicata dalla Free Software Foundation; o la versione 2
  della licenza o (a propria scelta) una versione successiva.

  Questo programma  e` distribuito nella speranza  che sia utile, ma
  SENZA   ALCUNA GARANZIA; senza  neppure  la  garanzia implicita di
  NEGOZIABILITA` o di  APPLICABILITA` PER UN  PARTICOLARE SCOPO.  Si
  veda la Licenza Pubblica Generica GNU per avere maggiori dettagli.

  Ognuno dovrebbe avere   ricevuto una copia  della Licenza Pubblica
  Generica GNU insieme a   questo programma; in caso  contrario,  si
  scriva   alla   Free  Software Foundation, 51 Franklin Street,
  Fifth Floor Boston, MA 02110-1335 USA Stati Uniti.
  -------------------------------------------------------------------
 */
$config = new UserConfig;

$pdb=gaz_dbi_get_row($gTables['company_config'], 'var', 'menu_alerts_check')['val'];
$period=($pdb==0)?60:$pdb;
if ( isset( $maintenance ) && $maintenance != FALSE ) header("Location: ../../modules/root/maintenance.php");

require("../../library/theme/lte/function.php");

if (!strstr($_SERVER["REQUEST_URI"], "login_admin") == "login_admin.php") {
    $_SESSION['lastpage'] = $_SERVER["REQUEST_URI"];
}
global $module;
$prev_script = '';
$menuclass = ' class="FacetMainMenu" ';
$style = 'default.css';
$skin = 'default.css';
if (isset($_POST['logout'])) {
    header("Location: logout.php");
    exit;
}

if (isset( $scriptname) && $scriptname != $prev_script && $scriptname != 'admin.php' ) { // aggiorno le statistiche solo in caso di cambio script
    $result = gaz_dbi_dyn_query("*", $gTables['menu_usage'], ' adminid="' . $admin_aziend["user_name"] . '" AND company_id="' . $admin_aziend['company_id'] . '" AND link="' . $mod_uri . '" ', ' adminid', 0, 1);
    $value = array();
    if (gaz_dbi_num_rows($result) == 0) {
        $value['transl_ref'] = get_transl_referer($mod_uri);
        $value['adminid'] = $admin_aziend["user_name"];
        $value['company_id'] = $admin_aziend['company_id'];
        $value['link'] = $mod_uri;
        $value['click'] = 1;
        $value['color'] = pastelColors();
        $value['last_use'] = date('Y-m-d H:i:s');
        gaz_dbi_table_insert('menu_usage', $value);
    } else {
        $usage = gaz_dbi_fetch_array($result);
        gaz_dbi_put_query($gTables['menu_usage'], ' adminid="' . $admin_aziend["user_name"] . '" AND company_id="' . $admin_aziend['company_id'] . '" AND link="' . $mod_uri . '"', 'click', $usage['click'] + 1);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-title" content="<?php echo $admin_aziend['ragso1'];?>">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title id='title_from_menu'></title>
		<?php
        if (substr($admin_aziend['ragso1'],0,16)=='AZIENDA DI PROVA'){ // l'azienda di default prende il maialino
			$ico=base64_encode(file_get_contents( '../../library/images/favicon.ico' ));
            $ico114=base64_encode(file_get_contents( '../../library/images/logo_114x114.png' ));
        } else { // altrimenti prendo le icone create in fase di scelta del logo in configurazione azienda
            $ico=base64_encode(@file_get_contents( DATA_DIR . 'files/' . $admin_aziend['codice'] . '/favicon.ico' ));
            $ico114=base64_encode(@file_get_contents( DATA_DIR . 'files/' . $admin_aziend['codice'] . '/logo_114x114.png' ));
        }
		?>
        <link rel="icon" href="data:image/x-icon;base64,<?php echo $ico?>"  type="image/x-icon" />
		<link rel="icon" sizes="114x114" href="data:image/x-icon;base64,<?php echo $ico114?>"  type="image/x-icon" />
		<link rel="apple-touch-icon" href="data:image/x-icon;base64,<?php echo $ico114?>"  type="image/x-icon">
		<link rel="apple-touch-startup-image" href="data:image/x-icon;base64,<?php echo $ico114?>"  type="image/x-icon">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="data:image/x-icon;base64,<?php echo $ico114?>"  type="image/x-icon" />
    <link href="../../library/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../library/theme/lte/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../library/theme/lte/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../../library/theme/lte/adminlte/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="../../library/theme/lte/adminlte/dist/css/skins/skin-gazie.css"> <!-- _all-skins.min.css">-->
    <link href="../../js/jquery.ui/jquery-ui.css" rel="stylesheet">
    <style>
        .content-wrapper{
            position:relative;
            overflow:auto;
        }
        form{
            background:white;
        }
    </style>
		<script src="../../js/jquery/jquery.js"></script>


        <?php
        if (!empty($admin_aziend['style']) && file_exists("../../library/theme/lte/scheletons/" . $admin_aziend['style'])) {
            $style = $admin_aziend['style'];
        }
        if (!empty($admin_aziend['skin']) && file_exists("../../library/theme/lte/skins/" . $admin_aziend['skin'])) {
            $skin = $admin_aziend['skin'];
        }
        ?>
        <link href="../../library/theme/lte/scheletons/<?php echo $style; ?>" rel="stylesheet" type="text/css" />
        <link href="../../library/theme/lte/skins/<?php echo $skin; ?>" rel="stylesheet" type="text/css" />
        <style>
            .company-color, .company-color-bright, li.user-header {
              background-color: #<?php echo $admin_aziend['colore']; ?>;
              filter: brightness(120%);
              color: black;
            }
            .company-color-logo {
              background-color: #<?php echo $admin_aziend['colore']; ?>;
              color: black;
            }
            .company-color-logo:hover {
              filter: brightness(80%);
            }
            .dropdown-menu > li > a:hover {
                background-color: #<?php echo $admin_aziend['colore']; ?>;
            }
            .navbar-default .navbar-nav > li > a:hover {
                background-color: #<?php echo $admin_aziend['colore']; ?>;
            }
			li.blink{
			  animation:blink 700ms infinite alternate;
			  padding-top:10px;
			}
			li.blink>a.btn{
			  padding:5px;
			}
			@keyframes blink {
				from { opacity:1; } to { opacity:0; }
			}
            .ui-dialog-buttonset>button.btn.btn-confirm:first-child {
                background-color: #f9b54d;
            }
        </style>
<script>
$(function() {
	$("#dialog_menu_alerts").dialog({ autoOpen: false });
});
function menu_alerts_check(mod,title,button,label,link,style){
	// questa funzione attiva l'alert sulla barra del menù e viene richiamata sia dalla funzione menu_check_from_modules() dal browser tramite setInterval che alla fine della pagina (lato server) quando il controllo fatto dal php tramite $_SESSION['menu_alerts_lastcheck'] è scaduto
    // faccio append solo se già non esiste
    if (style.length >= 2) { // solo se style è valorizzato faccio l'alert sul menu
        $("li.blink").html( '<a mod="'+mod+'" class="btn btn-'+style+' dialog_menu_alerts" title="'+title.replace(/(<([^>]+)>)/ig,"")+'" >'+button+'</a>').click(function() {
			$("p#diatitle").html(title);
			$( "#dialog_menu_alerts" ).dialog({
                title: button ,
				minHeight: 210,
				width: "auto",
				modal: "true",
				show: "blind",
				hide: "explode",
				buttons: {
					'confirm':{
						text: label,
						'class':'btn btn-confirm',
						click:function (event, ui) {
						$.ajax({
							data: {'mod':mod },
							type: 'POST',
							url: '../root/delete_menu_alert.php',
							success: function(data){
								window.location.href=link;
							}
						});
					}},
					delete:{
						text:'Posponi',
						'class':'btn btn-danger delete-button',
						click:function (event, ui) {
						$.ajax({
							data: {'mod':mod },
							type: 'POST',
							url: '../root/delete_menu_alert.php',
							success: function(data){
								//alert(data);
								window.location.reload(true);
							}
						});
					}},
					"Lascia": function() {
						$(this).dialog('destroy');
					}
				}
			});
			$("#dialog_menu_alerts" ).dialog( "open" );
		});
    }
}

function menu_check_from_modules() {
    // chiamata al server per aggiornare il tempo dell'ultimo controllo
	$.ajax({
		type: 'GET',
		url: "../root/session_menu_alert_lastcheck.php",
		success: function(){
		  var j=0;
          // nome modulo
          var title = '';
          var button = '';
          var label = '';
          var style = '';
          var link = '';
          var mod = '';
          // controllo la presenza di nuove notifiche
          $.ajax({
            type: 'GET',
            url: '../root/get_sync_status_ajax.php',
            data: {},
            dataType: 'json',
            success: function (data) {
              $.each(data, function(i, v) {
                // nome modulo
                title = v['title'];
                button = v['button'];
                label = v['label'];
                link = v['link'];
                style = v['style'];
                mod = i;
                //console.log(mod);
				j++;
                menu_alerts_check(mod,title,button,label,link,style);
              });
            }
          });
        }
	});
}
// setto comunque dei check intervallati dei minuti inseriti in configurazione avanzata azienda 15*60*1000ms perché non è detto che si facciano i refresh, ad es. se il browser rimane fermo sulla stessa pagina per un lungo periodo > $period
setInterval(menu_check_from_modules,<?php echo intval((int)$period*60000);?>);

    $(function () {
        //twitter bootstrap script
        $("#docmodal").click(function () {
		var module = $(this).attr('module');
            $.ajax({
                type: "POST",
                url: "../../modules/"+module+"/docume_"+module+".php",
                data: 'mode=modal',// da lasciare perché alcuni moduli usano mode
                success: function (msg) {
					$("#doc_modal .modal-sm").css('width', '80%');
                    $("#doc_modal .modal-body").html(msg);
                },
                error: function () {
                    alert("Errore apertura documentazione");
                }
            });
        });
    });

</script>
    </head>
    <?php
    // imposto le opzioni del tema caricando le opzioni del database

    $val = $config->getValue('LTE_Fixed');
    if (!isset($val)) {
        $config->setDefaultValue();
        header("Location: ../../modules/root/admin.php");
    } else {
        $val = "";
    }

    if ($config->getValue('LTE_Fixed') == "true")
        $val = " fixed";
    if ($config->getValue('LTE_Boxed') == "true")
        $val = " layout-boxed";
    if ($config->getValue('LTE_Collapsed') == "true")
        $val .= " sidebar-collapse";
    if ($config->getValue('LTE_Onhover') == "true")
        $val .= " wysihtml5-supported sidebar-collapse";
    if ($config->getValue('LTE_SidebarOpen') == "true")
        $val .= " control-sidebar-open";

    echo "<body class=\"hold-transition skin-blue sidebar-mini " . $val . "\">";
    ?>

    <form method="POST" name="head_form" action="../../modules/root/admin.php">
		<div style="display:none" id="dialog_menu_alerts" title="">
			<p class="ui-state-highlight" id="diatitle"></p>
		</div>
		<div id="doc_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header active">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel"><?php echo "Documentazione"; ?></h4>
					</div>
					<div class="modal-body edit-content small"></div>
				</div>
			</div>
		</div>
        <div class="wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="z-index: 3000;">
                <a class="navbar-brand" href="../../modules/root/admin.php">
                    <span class="logo-mini">
                        <img src="../../modules/root/view.php?table=aziend&amp;value=1" height="30" alt="Logo" border="0" title="AZIENDA DI PROVA">
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" onclick="toggle_sidebar()">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown user user-menu">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo '../root/view.php?table=admin&field=user_name&value=' . $admin_aziend["user_name"]; ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $admin_aziend['user_firstname'] . ' ' . $admin_aziend['user_lastname']; ?></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="http://localhost:8002/modules/config/admin_utente.php?user_name=amministratore&Update">Profilo</a>
                                <a class="dropdown-item" href="http://localhost:8002/modules/root/login_user.php?tp=gaz">Logout</a>
                            </div>
                        </li>
                    </ul>
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                </div>
            </nav>

            <script>
                
                function toggle_sidebar(){

                    var check_sidebar_mob=$(".sidebar-mini").hasClass("sidebar-open");

                    if (check_sidebar_mob) {

                        $(".sidebar-mini").removeClass("sidebar-open");

                    } else {

                        $(".sidebar-mini").addClass("sidebar-open");

                    }

                }
                
            </script>

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <!--<div class="user-panel">
                      <div class="pull-left image">
                        <img src="<?php //echo '../root/view.php?table=admin&field=user_name&value=' . $admin_aziend["user_name"];  ?>" class="img-circle" alt="User Image">
                      </div>
                      <div class="pull-left info">
                        <p><?php //echo $admin_aziend['Nome'].' '.$admin_aziend['Cognome'];  ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                      </div>
                    </div>
                    <!-- search form-->
                    <ul class="sidebar-menu">
                        <!--<li class="header">MENU' PRINCIPALE</li>-->
