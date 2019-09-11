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
    include('php/models/Person.php');
    setValue('data_ort', db_select_ort());
    setValue('data_land', db_select_land());

    setValue('phpmodule', $_SERVER['SCRIPT_NAME']."?id=".__FUNCTION__);

    $count = db_count_person();

    $pid = getParameter('pid');


    $person = new Person();
    $person->name = getParameter('name');
    $person->vorname = getParameter('vorname');
    $person->strasse = getParameter('strasse');
    $person->ort = getParameter('ort');
    $person->mail = getParameter('mail');
    $person->telPriv = getParameter('tel-priv');
    $person->telComp = getParameter('tel-comp');
    $person->land = getParameter('land');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (getParameter('save')) {
            setValue('errors', validate_person($person));
            if (getValue('errors') === true) {
                if ($pid != null) {
                    db_update_person($pid, $person->name, $person->vorname, $person->strasse, $person->ort, $person->mail, $person->telPriv, $person->telComp, $person->land);
                } else {
                    $pid = db_insert_person($person->name, $person->vorname, $person->strasse, $person->ort, $person->mail, $person->telPriv, $person->telComp, $person->land);

                    redirect($_SERVER['SCRIPT_NAME']."?id=".__FUNCTION__."&pid=".$pid, false);
                }
            }
        } elseif (getParameter('new')) {
            $_SESSION['new'] = true;
            unset($_SESSION['json_search'], $_REQUEST['name'], $_REQUEST['vorname'], $_REQUEST['strasse'], $_REQUEST['ort'], $_REQUEST['tel-priv'], $_REQUEST['tel-comp'], $_REQUEST['land'], $_REQUEST['pid'], $_REQUEST['mail']);
            redirect(__FUNCTION__);
        } elseif (getParameter('delete') && $pid) {
            db_delete_person($pid);
            unset($_REQUEST['name'], $_REQUEST['vorname'], $_REQUEST['strasse'], $_REQUEST['ort'], $_REQUEST['tel-priv'], $_REQUEST['tel-comp'], $_REQUEST['land'], $_REQUEST['pid'], $_REQUEST['mail']);
            redirect(__FUNCTION__);
        } elseif (getParameter('search')) {
            $_SESSION['json_search'] = json_encode($person);
            unset($_REQUEST['name'], $_REQUEST['vorname'], $_REQUEST['strasse'], $_REQUEST['ort'], $_REQUEST['tel-priv'], $_REQUEST['tel-comp'], $_REQUEST['land'], $_REQUEST['pid'], $_REQUEST['mail']);
            redirect(__FUNCTION__);
        }
    }
    if ($pid ===  null && $count > 0 && $_SERVER['REQUEST_METHOD'] === 'GET' && $_SESSION['new'] !== true) {
        $pid = db_first_person(json_decode($_SESSION['json_search']));
        if ($pid == null) {
            unset($_SESSION['json_search']);
            redirect(__FUNCTION__);
        }
        $_REQUEST['pid'] = $pid;
        redirect($_SERVER['SCRIPT_NAME']."?id=".__FUNCTION__."&pid=".$pid, false);
    }
    if ($pid !== null && $count > 0) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $selected = db_select_person($pid);
            if ($selected == null) {
                $pid = db_first_person(json_decode($_SESSION['json_search']));
                $selected = db_select_person($pid);
            }
            setValue('selected', $selected);
        }


        setValue('previous', db_previous_person($pid, json_decode($_SESSION['json_search'])));
        setValue('next', db_next_person($pid, json_decode($_SESSION['json_search'])));
    }

    $_SESSION['new'] = false;

    return runTemplate('templates/person.htm.php');
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
            $search = db_select_ort($oid);
            if (count($search) === 0) {
                redirect(__FUNCTION__);
            }
            setValue('selected', $search[0]);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (getParameter('save') !== null) {
                $search = db_select_ort($oid);
                if (count($search) === 0) {
                    redirect(__FUNCTION__);
                }
                setValue('selected', $search[0]);
                $name = getParameter('ort');
                $plz = getParameter('plz');
                $errors = array();
                if (!is_string($name) || preg_match('/^[a-zA-ZäöüÄÖÜ \-]{2,}$/', $name) == null) {
                    $errors['name'] = "Invalid input";
                }

                if (!(is_string($plz) || is_numeric($plz))) {
                    $errors['plz'] = "Invalid input";
                }

                if (count($errors) == 0 && isNumber($oid)) {
                    db_update_ort($oid, $name, $plz);
                    redirect(ort);
                }

                setValue('errors', $errors);
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
    if (getParameter('new')) {
        unset($_REQUEST['search_input']);
        unset($_REQUEST['slid']);
        unset($_REQUEST['lid']);
        redirect(__FUNCTION__);
    } elseif ((getParameter('search_input') != null ? preg_match('/^[a-zA-ZäöüÄÖÜ \-]{2,}$/', getParameter('search_input'))  == true : true)) {
        if (getParameter('delete')) {
            if ($lid !== null) {
                db_delete_land($lid);
                unset($_REQUEST['slid']);
                redirect(__FUNCTION__);
            }
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
            setValue('errors', array("name" => "Invalid input"));
            return runTemplate("templates/land.htm.php");
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
        $_SESSION['search'] = getParameter('search_input');
        return runTemplate("templates/land.htm.php");
    } else {
        setValue('data', $_SESSION['search'] !== null ? db_query_land($_SESSION['search']) : db_select_land());
        setValue('errors', array("name" => "Invalid input"));
        return runTemplate("templates/land.htm.php");
    }
}
