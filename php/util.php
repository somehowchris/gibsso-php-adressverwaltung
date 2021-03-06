<?php
/**
 *  @autor Daniel Mosimann
 *  @version 2.0
 *
 *  Dieses Modul stellt grundlegende Funktionen zur Verf�gung und ist damit
 *  Bestandteil des MVC-GIBS.
 *
 */

/*
 * Assoziativer, globaler Array f�r den Transport von Werten zwischen Anwendung und Templates
 */
$params = array();

/**
 * F�hrt ein HTML-Template aus und gibt das Produkt zur�ck.
 *
 * @param     $template     Filename des Templates
 * @param     $params       Assoziativer Array mit Werten, welche im Template eingef�gt werden.
 *                          key: Name der Variable, value: Wert
 */
function runTemplate($template)
{
    ob_start();
    include($template);
    $inhalt=ob_get_contents();
    ob_end_clean();
    return $inhalt;
}

/*
 * Einen Wert im globalen Array $params speichern.
 *
 * @param       $key        Schl�ssel des Wertes (Index im globalen Array
 * @param       $value      Wert des Wertes
 *
 */
function setValue($key, $value)
{
    global $params;
    $params[$key] = $value;
}

/*
 * Mehrere Werte im globalen Array $params speichern.
 *
 * @param       $list      Assoziativer Array mit den zu speichernden Werten
 *
 */
function setValues($list)
{
    global $params;
    if (count($list)) {
        foreach ($list as $k => $v) {
            $params[$k] = $v;
        }
    }
}

/*
 * Wert aus dem globalen Array lesen
 *
 * @param       $field      Index des gew�nschten Wetes
 *
 */
function getValue($key)
{
    global $params;
    return $params[$key];
}

/*
 * Wert aus dem globalen Array lesen und in HTML-Syntax umwandeln
 *
 * @param       $field      Index des gew�nschten Wetes
 *
 */
function getHtmlValue($key)
{
    global $params;
    return htmlentities($params[$key]);
}

/**
 * Menu erstellen und ausgeben (Bootstrap-Stil)
 *
 * @param $template HTML-Template
 */
function menu($mlist, $template)
{
    $printmenu = "";
    $active_link = array_key_exists(getValue('func'), getValue('cfg_menu_list'))  == true ? getValue('func') : (array_key_exists(getValue('func'), getValue('cfb_sub_tabs')) ? getValue('cfb_sub_tabs')[getValue('func')] : null);
    foreach ($mlist as $element => $option) {
        if (!empty($option)) {
            $active = "";
            if ($element == $active_link) {
                $active = "active";
            }
            $printmenu .= "<li class=\"nav-item\"><a class=\"nav-link $active\" href=\"".$_SERVER['PHP_SELF']."?id=".$element."\">".$option."</a></li>";
        }
    }
    include($template);
}

/**
 * �bergebene SQL-Anweisung auf der DB ausf�hren und Resultat zur�ckgeben.
 *
 * @param   $sql       Select-Befehl, welcher ausgef�hrt werden soll
 */
function sqlSelect($sql)
{
    $result = mysqli_query(getValue('cfg_db'), $sql);
    if (!$result) {
        die("Fehler: ".mysqli_error(getValue(cfg_db)));
    }
    $data = array();
    while ($row=mysqli_fetch_assoc($result)) {
        $data[]=$row;
    }
    return $data;
}

/**
 * F�hrt einen SQL-Befehl aus.
 *
 * @param   $sql    SQL-Befehl, welcher ausgef�hrt werden soll
 */
function sqlQuery($sql)
{
    $result = mysqli_query(getValue('cfg_db'), $sql);
    if (!$result) {
        die(mysqli_error(getValue(cfg_db))."<pre>".$sql."</pre>");
    }
}

/**
 * Aktives php-Modul noch einmal aufrufen.
 *
 * @param   $id     ID der Funktion, welche aufgerufen werden soll
 */
function redirect($id="", $func = true)
{
    if ($func === true) {
        if (!empty($id)) {
            $id="?id=$id";
        }
        header("Location: ".$_SERVER['PHP_SELF'].$id);
    } else {
        header("Location: ".$id);
    }
    exit();
}

/**
 * Pr�ft ob ein Eingabewert leer ist oder nicht.
 *
 * @param   $value      Eingabewert
 * @param   $maxlength  Minimale L�nge der Eingabe
 */
function CheckEmpty($value, $minlength=null)
{
    if (empty($value)) {
        return false;
    }
    if ($minlength != null && strlen($value) < $minlength) {
        return false;
    } else {
        return true;
    }
}

/**
 * Pr�ft ob eine Emailadresse korrekt ist oder nicht.
 *
 * @param   $value      Eingabewert
 * @param   $empty      Die Email-Adresse kann leer sein ('Y') oder nicht ('N')
 */
function CheckEmail($value, $empty='N')
{
    $pattern_email = '/^[^@\s<&>]+@([-a-z0-9]+\.)+[a-z]{2,}$/i';
    if ($empty=='Y' && empty($value)) {
        return true;
    }
    if (preg_match($pattern_email, $value)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Pr�ft ob eine Name (Nachname, Vorname) korrekt ist oder nicht.
 * Erlaubt sind die Zeichen in den eckigen Klammern, mit einer L�nge
 * von mindestens 2 Zeichen.
 *
 * @param   $value      Eingabewert
 * @param   $empty      Der Name kann leer sein ('Y') oder nicht ('N')
 */
function CheckName($value, $empty='N')
{
    $pattern_name = '/^[a-zA-Z������ \-]{2,}$/';
    if ($empty=='Y' && empty($value)) {
        return true;
    }
    if (preg_match($pattern_name, $value)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Pr�ft ob eine Ort korrekt ist oder nicht.
 *
 * @param   $value      Eingabewert
 * @param   $empty      Der Ort kann leer sein ('Y') oder nicht ('N')
 */
function CheckOrt($value, $empty='N')
{
    $pattern_ort = '/^[a-zA-Z������ \-]{2,}$/';
    if ($empty=='Y' && empty($value)) {
        return true;
    }
    if (empty($value)) {
        return false;
    }
    if (preg_match($pattern_ort, $value)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Pr�ft ob es sich beim �bergebenen Wert um eine Zahl handelt.
 *
 * @param   $value      �bergebender Wert
 */
function isNumber($value)
{
    if (!is_numeric($value)) {
        return false;
    }
    return true;
}

/**
 * Pr�ft ob ein Eingabewert eine Zahl ist.
 *
 * @param   $value         Eingabewert
 * @param   $minlength     Minimale L�nge der Zahl
 */
function CheckNumber($value)
{
    if (!isNumber($value)) {
        return false;
    } else {
        return true;
    }
}

/**
 * Pr�ft ob es sich beim �bergebenen Wert um eine positive Ganzzahl handelt (ohne e,+,-).
 *
 * @param   $value      �bergebender Wert
 */
function isCleanNumber($value)
{
    if (!is_numeric($value)) {
        return false;
    }
    $pattern_number = '/^[0-9]*$/';
    if (preg_match($pattern_number, $value)) {
        return true;
    } else {
        return false;
    }
    return true;
}

/**
 * Pr�ft ob ein Eingabewert eine Zahl ist. Eine Leereingabe ist erlaubt.
 *
 * @param   $value         Eingabewert
 * @param   $minlength     Minimale L�nge der Zahl
 */
function CheckCleanNumberEmpty($value, $minlength=0)
{
    if (empty($value)) {
        return true;
    }
    if (!isCleanNumber($value) || strlen($value) < $minlength) {
        return false;
    } else {
        return true;
    }
}

function checkPhoneNumber($number)
{
    return preg_match('/^(((^\+|^0{2})[1-9]{2})|(^0[1-9]{2})) ?[1-9]{1}[\d ]*$/i', $number) == null;
}

function getParameter(String $name)
{
    if (isset($_REQUEST[$name])) {
        return htmlspecialchars($_REQUEST[$name]);
    }
    return null;
}

function escapeStringOrNull($param)
{
    if ($param === null) {
        return 'NULL';
    }
    return "'".htmlspecialchars($param)."'";
}

function intOrNull($param)
{
    if ($param === null || !isNumber($param)) {
        return 'NULL';
    }
    return $param;
}

function filterNull($input)
{
    return $input != null;
}

function validate_person($person)
{
    $errors = array();
    if (!CheckEmail($person->mail)) {
        $errors['mail'] = 'Invalid email address';
    }
    if ($person->telPriv != null && checkPhoneNumber($person->telPriv)) {
        $errors['telPriv'] = 'Invalid phone number';
    }
    if ($person->telComp != null && checkPhoneNumber($person->telComp)) {
        $errors['telComp'] = 'Invalid phone number';
    }
    if ($person->name == null || strlen($person->name) === 0) {
        $errors['name'] = 'Invalid name';
    }

    return count($errors) === 0 ? true : $errors;
}

function valide_ort($ort)
{
    $errors = array();
    if (!is_string($ort->name) || preg_match('/^[a-zA-ZäöüÄÖÜ \-]{2,}$/', $ort->name) == null || strlen($ort->name) == 0) {
        $errors['name'] = "Invalid input";
    }

    if (!(is_string($ort->plz) || is_numeric($ort->plz))) {
        $errors['plz'] = "Invalid input";
    }
    return count($errors) === 0 ? true : $errors;
}
