<?php
/*
  --------------------------------------------------------------------------
  GAzie - Gestione Azienda
  Copyright (C) 2004-2022 - Antonio De Vincentiis Montesilvano (PE)
  (http://www.devincentiis.it)
  <http://gazie.sourceforge.net>
  --------------------------------------------------------------------------
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
  --------------------------------------------------------------------------
 */
require("../../library/include/datlib.inc.php");

$admin_aziend = checkAdmin();
$mas_staff = $admin_aziend['mas_staff'] . "000000";
$worker = $admin_aziend['mas_staff'];
$where = "codice BETWEEN " . $worker . "000000 AND " . $worker . "999999 and codice > $mas_staff";

if (isset($_GET['auxil'])) {
    $auxil = filter_input(INPUT_GET, 'auxil');
} else {
    $auxil = "";
}

if (isset($_GET['auxil1'])) {
    $auxil1 = filter_input(INPUT_GET, 'auxil1');
} else {
    $auxil1 = "";
}

if (isset($_GET['all'])) {
    $auxil = "&all=yes";
    $passo = 100000;
} else {
    if (isset($_GET['auxil']) and $auxil1 == "") {
        $where .= " AND ragso1 LIKE '" . addslashes($auxil) . "%'";
    } elseif (isset($_GET['auxil1'])) {
        $codicetemp = intval($auxil1);
        $where .= " AND id_contract = " . $codicetemp ;
    }
}

if (!isset($_GET['field'])||strlen($_GET['field'])<2) {
    $orderby = "id_contract ASC";
}

if (isset($_GET['ricerca_completa'])) {
    $ricerca_testo = filter_input(INPUT_GET, 'ricerca_completa');
    $where .= " and ( ragso1 like '%" . $ricerca_testo . "%' ";
    $where .= " or ragso2 like '%" . $ricerca_testo . "%' ";
    $where .= " or pariva like '%" . $ricerca_testo . "%' ";
    $where .= " or pariva like '%" . $ricerca_testo . "%' ";
    $where .= " or codfis like '%" . $ricerca_testo . "%' ";
    $where .= " or citspe like '%" . $ricerca_testo . "%' )";
}

require("../../library/include/header.php");
$script_transl = HeadMain();
?>
<script>
$(function() {
	// $("#dialog_delete").dialog({ autoOpen: false });
	$('.dialog_delete').click(function() {
		// $("p#idcodice").html($(this).attr("ref"));
		// $("p#iddescri").html($(this).attr("staffdes"));
		var id = $(this).attr('ref');
        console.log(id);
        $.ajax({
            data: {'type':'staff',ref:id},
            type: 'POST',
            url: '../humres/delete.php',
            success: function(output){
                //alert(output);
                window.location.replace("./staff_report.php");
            }
        });
		// $( "#dialog_delete" ).dialog({
		// 	minHeight: 1,
		// 	width: "auto",
		// 	modal: "true",
		// 	show: "blind",
		// 	hide: "explode",
		// 	buttons: {
		// 		delete:{ 
		// 			text:'Elimina', 
		// 			'class':'btn btn-danger delete-button',
		// 			click:function (event, ui) {
		// 			$.ajax({
		// 				data: {'type':'staff',ref:id},
		// 				type: 'POST',
		// 				url: '../humres/delete.php',
		// 				success: function(output){
		//                     //alert(output);
		// 					window.location.replace("./staff_report.php");
		// 				}
		// 			});
		// 		}},
		// 		"Non eliminare": function() {
		// 			$(this).dialog("close");
		// 		}
		// 	}
		// });
		// $("#dialog_delete" ).dialog( "open" );  
	});
});
</script>
<div align="center" class="FacetFormHeaderFont">
    <?php
    echo $script_transl['title'] . '</div>';
    if ($admin_aziend['mas_staff'] <= 199) {
        echo '<div class="alert alert-danger text-center" role="alert">' . $script_transl['errors'] . '</div>';
    }
    ?>
    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!-- <div style="display:none" id="dialog_delete" title="Conferma eliminazione">
            <p><b>lavoratore:</b></p>
            <p>codice:</p>
            <p class="ui-state-highlight" id="idcodice"></p>
            <p>Descrizione</p>
            <p class="ui-state-highlight" id="iddescri"></p>
        </div> -->
        <div class="" style="border:0">
            <div class="bg-light p-3" style="height:70px">
            <input id="search" type="text" class="form-control"  placeholder="Search..." style="border: 0px;">
            </div>
            <table class="table table-responsive">
                <tr>        
                    <?php
                    $groupby= "codice";
                    $result = gaz_dbi_dyn_query('*', $gTables['clfoco'] . ' LEFT JOIN ' . $gTables['anagra'] . ' ON ' . $gTables['clfoco'] . '.id_anagra = ' . $gTables['anagra'] . '.id'
                            . ' LEFT JOIN ' . $gTables['rigmoc'] . ' ON ' . $gTables['rigmoc'] . '.codcon = ' . $gTables['clfoco'] . '.codice'
                            . ' LEFT JOIN ' . $gTables['staff'] . ' ON ' . $gTables['staff'] . '.id_clfoco = ' . $gTables['clfoco'] . '.codice', $where. ' AND SUBSTRING(' . $gTables['staff'] . '.id_clfoco,4,6) > 0', $orderby, $limit, $passo, $groupby);
                    $recordnav = new recordnav($gTables['clfoco'] . ' LEFT JOIN ' . $gTables['anagra'] . ' ON ' . $gTables['clfoco'] . '.id_anagra = ' . $gTables['anagra'] . '.id LEFT JOIN ' . $gTables['staff'] . ' ON ' . $gTables['clfoco'] . '.codice = ' . $gTables['staff'] . '.id_clfoco', $where, $limit, $passo);
                    $recordnav->output();
                    ?>
                </tr>
                <tr>
                    <?php
                    $linkHeaders = new linkHeaders($script_transl['header']);
                    $linkHeaders->setAlign(array('left', 'left', 'left', 'center', 'left', 'center', 'center', 'center', 'center', 'center','center'));
                    $linkHeaders->output();
                    ?>
                </tr>
                <?php
                echo "<tbody id='table' >";
                while ($r = gaz_dbi_fetch_array($result)) {
                    echo "<tr>";
                    // Colonna codice staffe
                    echo "<td align=\"center\">" . $r["id_contract"] . "</td>";
                    // Colonna cognome
                    echo "<td>" . $r["ragso1"] . " &nbsp;</td>";
                    // Colonna nome
                    echo "<td>" . $r["ragso2"] . " &nbsp;</td>";
                    // colonna sesso
                    echo "<td align=\"center\">" . $r["sexper"] . "</td>";
                    // Colonna mansione
                    echo "<td>" . $r["job_title"] . " &nbsp;</td>";
                    // colonna indirizzo
                    $google_string = str_replace(" ", "+", $r["indspe"]) . "," . str_replace(" ", "+", $r["capspe"]) . "," . str_replace(" ", "+", $r["citspe"]) . "," . str_replace(" ", "+", $r["prospe"]);
                    echo "<td title=\"" . $r["capspe"] . " " . $r["indspe"] . "\">";
                    echo "<a class=\"btn btn-xs btn-default w-100\" target=\"_blank\" href=\"https://www.google.it/maps/place/" . $google_string . "\">" . $r["citspe"] . " (" . $r["prospe"] . ")&nbsp;<i class=\"glyphicon glyphicon-map-marker\"></i></a>";
                    echo "</td>";
                    // composizione telefono
                    $title = "";
                    $telefono = "";
                    if (!empty($r["telefo"])) {
                        $telefono = $r["telefo"];
                        if (!empty($r["cell"])) {
                            $title .= "cell:" . $r["cell"];
                        }
                        if (!empty($r["fax"])) {
                            $title .= " fax:" . $r["fax"];
                        }
                    } elseif (!empty($r["cell"])) {
                        $telefono = $r["cell"];
                        if (!empty($r["fax"])) {
                            $title .= " fax:" . $r["fax"];
                        }
                    } else {
                        $telefono = "_";
                        $title = " nessun contatto telefonico memorizzato ";
                    }
                    // colonna iban
                    echo "<td align=\"center\">" . $r["iban"] . " &nbsp;</td>";
                    // colonna telefono
                    echo "<td title=\"$title\" align=\"center\">" . gaz_html_call_tel($telefono) . " &nbsp;</td>";
                    // colonna fiscali
                    echo "<td align=\"center\">" . $r['codfis'] . "</td>";
                    // colonna contabilità
                    echo '<td align="center">
                    <div class="dropdown">
                    <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="bx bx-menu"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <a href=\'admin_staff.php?codice=' . substr($r["id_clfoco"], 3) . '&Update\' class="dropdown-item">Modifica</a>
                    <a href="../contab/select_partit.php?id=' . $r["id_clfoco"] . '" class="dropdown-item">Stampa</a>
                    <a class="dropdown-item dialog_delete" ref="'.$r["id_clfoco"].'" staffdes="<?php echo $r[\'ragso1\']; ?>" >Elimina</a></div>
                    </div>
                    </td>';
                    // colonna stampa privacy
                    // echo "<td align=\"center\">";
                    // if (intval($r['codcon']) > 0){					
                        ?>
                        <!-- <button title="Collaboratore non cancellabile perch� ha movimenti contabili" class="btn btn-xs btn-default btn-elimina disabled"><i class="glyphicon glyphicon-remove"></i></button> -->
                        <?php
                    // } else {
                ?>
                 <!-- <a class="btn btn-xs btn-default btn-elimina dialog_delete" ref="<?php echo $r['id_clfoco'];?>" staffdes="<?php echo $r['ragso1']; ?>">
                    <i class="glyphicon glyphicon-remove"></i>
                </a>  -->
                <?php
                    // }
                    echo "</tr>\n";				
                }
                echo "</tbody>";
                ?>  
                <script>
                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#table tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });       
                </script>
            </table>
        </div>
    </form>
</div>

<?php
require("../../library/include/footer.php");
?>