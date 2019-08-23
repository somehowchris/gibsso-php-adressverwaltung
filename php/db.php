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

function db_select_kontakt()
{
    return sqlSelect("select * from kontakte");
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
