<?php
/*
 *  @autor Daniel Mosimann
 *  @version 2.0
 *
 *  Dieses Modul beinhaltet s�mtliche Datenbankfunktionen.
 *  Die Funktionen formulieren die SQL-Anweisungen und rufen dann die Funktionen
 *  sqlQuery() und sqlSelect() aus dem Modul basic_functions.php auf.
 *
 */

function db_insert_kontakt($params)
{
    $sql = "insert into kontakte (name, vorname, strasse, plz, ort, email, tpriv, tgesch)
            values ('".addslashes($params['name'])."','".addslashes($params['vorname'])."','".addslashes($params['strasse'])."','".
                       $params['plz']."','".addslashes($params['ort'])."','".
                       addslashes($params['email'])."','".addslashes($params['tpriv'])."','".addslashes($params['tgesch'])."')";
    sqlQuery($sql);
}

function db_insert_person($name, $vorname, $strasse, $ort, $mail, $telPriv, $telComp, $land)
{
    $sql = "INSERT INTO personen (name, vorname, strasse, oid, email, tel_priv, tel_gesch, lid) VALUES (".escapeStringOrNull($name).", ".escapeStringOrNull($vorname).",".escapeStringOrNull($strasse)."," .intOrNull($ort).", ".escapeStringOrNull($mail).", ".escapeStringOrNull($telPriv).", ".escapeStringOrNull($telComp).", ".intOrNull($land).")";
    sqlQuery($sql);
    return getValue('cfg_db')->insert_id;
}

function db_update_person($pid, $name, $vorname, $strasse, $ort, $mail, $telPriv, $telComp, $land)
{
    $sql = "UPDATE personen SET name = ".escapeStringOrNull($name).", vorname=".escapeStringOrNull($vorname).", strasse=".escapeStringOrNull($strasse).", oid =".intOrNull($ort).", email=".escapeStringOrNull($mail).", tel_priv = ".escapeStringOrNull($telPriv).", tel_gesch = ".escapeStringOrNull($telComp).", lid = ".intOrNull($land)." WHERE pid =".intOrNull($pid);
    sqlQuery($sql);
}

function db_first_person($person = null)
{
    return sqlSelect("SELECT pid FROM personen ".(addPersonFilterWhereStatement($person) != null ? " WHERE ".addPersonFilterWhereStatement($person) : "")." LIMIT 1")[0]['pid'];
}

function addPersonFilterWhereStatement($person)
{
    $items = array(($person->name ? " name = '".$person->name."'" : null),
    ($person->vorname ? " vorname = '".$person->vorname."'" : null),
    ($person->strasse ? " strasse = '".$person->strasse."'" : null),
    ($person->telComp ? " tel_gesch = '".$person->telComp."'" : null),
    ($person->telPriv ? " tel_priv = '".$person->telPriv."'" : null),
    ($person->mail ? " email = '".$person->mail."'" : null),
    ($person->land ? " lid = ".$person->land : null),
    ($person->ort ? " oid = ".$person->ort : null));

    $searchItems = array_filter($items, "filterNull");
    $whereStatement = join(" AND ", $searchItems);
    return $whereStatement;
}

function db_insert_land($name)
{
    $sql = "INSERT INTO land (land) VALUES ('$name')";
    sqlQuery($sql);
}

function db_insert_ort($name, $plz)
{
    $sql = "INSERT INTO ort (ort, plz) VALUES ('$name', $plz)";
    sqlQuery($sql);
}

function db_update_land($lid, $name)
{
    $sql = "UPDATE land SET land = '$name' WHERE lid = ".$lid;
    sqlQuery($sql);
}

function db_update_ort($oid, $name, $plz)
{
    $sql = "UPDATE ort SET ort = '$name', plz = $plz WHERE oid = ".$oid;
    sqlQuery($sql);
}

function db_select_person($pid)
{
    return sqlSelect("SELECT * FROM personen WHERE pid = ".$pid)[0];
}

function db_count_person()
{
    return sqlSelect("SELECT count(*) as count FROM personen")[0]['count'];
}

function db_previous_person($pid, $person)
{
    $result = sqlSelect("SELECT * from personen WHERE pid < ".$pid .(addPersonFilterWhereStatement($person) != null ? " AND ".addPersonFilterWhereStatement($person) : "")." ORDER BY pid DESC LIMIT 1");
    return $result[0] !== null ? $result[0] : null;
}

function db_next_person($pid, $person)
{
    $result = sqlSelect("SELECT * FROM personen WHERE pid >".$pid .(addPersonFilterWhereStatement($person) != null ? " AND ".addPersonFilterWhereStatement($person) : "")." ORDER BY pid ASC LIMIT 1");
    return $result[0] !== null ? $result[0] : null;
}

function db_delete_person($pid)
{
    if ($pid && isNumber($pid)) {
        sqlQuery("DELETE FROM personen WHERE pid = $pid");
    }
}

function db_select_land()
{
    return sqlSelect("select * from land");
}

function db_select_ort($oid = null)
{
    return sqlSelect("select * from ort" . (isset($oid) ? " WHERE oid = $oid" : ''));
}

function db_query_land($query)
{
    return sqlSelect("SELECT * FROM land WHERE land LIKE '%".$query."%'");
}

function db_delete_kontakt($kid)
{
    if (isCleanNumber($kid)) {
        sqlQuery("delete from kontakte where kid='$kid'");
    }
}

function db_delete_ort($oid)
{
    if (isCleanNumber($oid)) {
        sqlQuery("delete from ort where oid='$oid'");
    }
}

function db_delete_land($lid)
{
    if (isCleanNumber($lid)) {
        sqlQuery("delete from land where lid='$lid'");
    }
}
