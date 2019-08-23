<?php
/*
 *  @autor Daniel Mosimann
 *  @version 2019
 *
 *  Dieses Modul beinhaltet Funktionen, welche die Anwendungslogik implementieren.
 *
 */

/*
 * Gibt die entsprechende CSS-Klasse aus einem assiziativen Array (key: Name Eingabefeld) zur�ck.
 * Wird im Template aufgerufen.
 *
 * @param   $name       Name des Eingabefeldes
 */
function getCssClass($name)
{
    global $css_classes;
    if (isset($css_classes[$name])) {
        return $css_classes[$name];
    } else {
        return getValue('cfg_css_class_normal');
    }
}

/*
 * Entsprechende CSS-Klasse auf "Invalid" (fehlerhafte Eingabe) setzen.
 *
 * @param   $name       Name des Eingabefeldes
 */
function setCssClassInvalid($name)
{
    global $css_classes;
    $css_classes[$name] = getValue('cfg_css_class_error');
}

function personen()
{
}

function ort()
{
    setValue('data', db_select_ort());
    return runTemplate("templates/ort.htm.php");
}

function edit_ort($origin='')
{
    $oid = getParameter('soid');
    if ($oid !== null) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            setValue('phpmodule', $_SERVER['SCRIPT_NAME']."?id=".__FUNCTION__. ($oid !== null ? "&soid=".$oid : ""));
            $search = db_select_ort($ort);
            if (count($search) === 0) {
                // TODO invalid id message
            }
            setValue('selected', $search[0]);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (getParameter('save') !== null) {
                $name = getParameter('ort');
                $plz = getParameter('plz');
                if (isNumber($plz)) {
                    db_update_ort($oid, $name, $plz);
                    redirect(ort);
                }
                // TODO invalid input
            } elseif (getParameter('delete') !== null) {
                db_delete_ort($oid);
                redirect(ort);
            }
        }
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = getParameter('ort');
            $plz = getParameter('plz');
            if (isNumber($plz)) {
                db_insert_ort($name, $plz);
                redirect(ort);
            }
            // TODO invalid message
        }
        setValue('phpmodule', $_SERVER['SCRIPT_NAME']."?id=".$origin. ($oid !== null ? "&soid=".$oid : ""));
    }
    return runTemplate("templates/ort_edit.htm.php");
}

function create_ort()
{
    return edit_ort(__FUNCTION__);
}

function land()
{
    $lid = getParameter('slid');
    setValue('phpmodule', $_SERVER['SCRIPT_NAME']."?id=".__FUNCTION__. ($lid !== null ? "&slid=".$lid : ""));
    if ((getParameter('search_input') != null ? preg_match('/^[a-zA-ZäöüÄÖÜ \-]{2,}$/', getParameter('search_input')) : true)) {
        if (getParameter('new')) {
            unset($_REQUEST['search_input']);
            unset($_REQUEST['slid']);
            unset($_REQUEST['lid']);
            redirect(__FUNCTION__);
        } elseif (getParameter('delete')) {
            if ($lid !== null) {
                db_delete_land($lid);
                unset($_REQUEST['slid']);
                redirect(__FUNCTION__);
            }
            // TODO invalid message
        } elseif (getParameter('save')) {
            if (strlen(stripslashes(getParameter('search_input'))) > 0) {
                if ($lid !== null) {
                    db_update_land($lid, stripslashes(getParameter('search_input')));
                    unset($_REQUEST['search_input']);
                    redirect(getValue('phpmodule'), false);
                } else {
                    db_insert_land(stripslashes(getParameter('search_input')));
                    unset($_REQUEST['search_input']);
                    unset($_REQUEST['slid']);
                    redirect(__FUNCTION__);
                }
            }
            // TODO invalid message
        }
        setValue('data', getParameter('search_input') !== null ? db_query_land(getParameter('search_input')) : db_select_land());
        if ($lid != null) {
            $selected;
            foreach (getValue('data') as $land) {
                if ($land['lid'] === $lid) {
                    $selected = $land;
                }
            }
            setValue('selected', $selected);
        }
        return runTemplate("templates/land.htm.php");
    } else {
        // TODO invalid search message
        redirect(__FUNCTION__);
    }
}
