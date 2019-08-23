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

/*
 * Funktion zur Eingabepr�fung.
 */
function checkInput()
{
    $status = true;

    if (!CheckName($_REQUEST['name'])) {
        setCssClassInvalid('name');
        $status = false;
    }

    if (!CheckEmail($_REQUEST['email'])) {
        setCssClassInvalid('email');
        $status = false;
    }

    return $status;
}

/*
 * Beinhaltet die Anwendungslogik zur Verwaltung des Kontaktformulars
 */
function kontakt()
{
    // Der Schaltknopf "senden" wurde bet�tigt
    if (isset($_REQUEST['senden'])) {
        if (checkInput()) {
            db_insert_kontakt($_REQUEST);
            redirect(__FUNCTION__);
        } else {
            setValues($_REQUEST);
        }
        // Der Schaltknopf "abbrechen" wurde bet�tigt
    } elseif (isset($_REQUEST['abbrechen'])) {
        redirect(__FUNCTION__);
    }

    // Template abf�llen und Resultat zur�ckgeben
    setValue('phpmodule', $_SERVER['SCRIPT_NAME']."?id=".__FUNCTION__);
    return runTemplate("templates/kontakt.htm.php");
}

/*
 * Beinhaltet die Anwendungslogik zur Ausgabe der Kontaktliste
 */
function liste()
{
    // Ausfef�hrtes Skript und Funktion speichern
    setValue('phpmodule', $_SERVER['SCRIPT_NAME']."?id=".__FUNCTION__);
    // �ergebener Eintrag in DB l�schen
    if (isset($_REQUEST['kid'])) {
        db_delete_kontakt($_REQUEST['kid']);
    }
    // Alle Daten (Kontakte) aus der DB lesen und der Variablen "data" zuweisen
    setValue('data', db_select_kontakt());
    // Falls Daten vorhanden sind, Template ausf�hren und Resultat zur�ckgeben
    if (count(getValue('data'))) {
        return runTemplate("templates/liste.htm.php");
    } else {
        return "Liste ist leer...";
    }
}

function personen()
{
}

function ort()
{
    setValue('data', db_select_ort());
    return runTemplate("templates/ort.htm.php");
}

function create_ort()
{
    return runTemplate("templates/ort_edit.htm.php");
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
