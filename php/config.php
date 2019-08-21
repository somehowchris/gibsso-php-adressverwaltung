<?php
/*
 *  @autor Daniel Mosimann
 *  @version 2019
 *
 *  Dieses Modul definert dall Konfigurationsparameter und stellt die DB-Verbindung her.
 */

// Default-CSS-Klasse zur Formatierung der Eingabefelder
setValue('cfg_css_class_normal',"");
// Klasse zur Formatierung der Eingabefelder, falls die Eingabepr�fung negativ ausf�llt
setValue('cfg_css_class_error',"is-invalid");
// Akzeptierte Funktionen
setValue('cfg_func_list', ["kontakt","liste", "ort", "personen", "land"]);
// Inhalt des Menus
setValue( 'cfg_menu_list', ["kontakt"=>"Kontaktformular","liste"=>"Erfasste Kontakte", "land" => "Landverwaltung","personen" => "Personenverwaltung", "ort" => "Ortsverwaltung"] );
// Template f�r Menu
setValue('cfg_menu', 'templates/menuBar.htm.php');

// Datenbankverbundung herstellen
$db = mysqli_connect("127.0.0.1", "root", "", "adressverwaltung");	// Zu Datenbankserver verbinden
setValue('cfg_db', $db);
?>
