<?php
/*
 *  @autor Daniel Mosimann
 *  @version 2019
 *
 *  Dieses Modul definert dall Konfigurationsparameter und stellt die DB-Verbindung her.
 */

// Default-CSS-Klasse zur Formatierung der Eingabefelder
setValue('cfg_css_class_normal', "");
// Klasse zur Formatierung der Eingabefelder, falls die Eingabepr�fung negativ ausf�llt
setValue('cfg_css_class_error', "is-invalid");
// Akzeptierte Funktionen
setValue('cfg_func_list', ["personen", "ort",  "land", "create_ort", "edit_ort"]);
// Adding sub tabs to select proper nav
setValue('cfb_sub_tabs', ["create_ort" => "ort", "edit_ort" => "ort"]);
// Inhalt des Menus
setValue('cfg_menu_list', ["personen" => "Personenverwaltung", "ort" => "Ortsverwaltung","land" => "Landverwaltung"]);
// Template f�r Menu
setValue('cfg_menu', 'templates/menuBar.htm.php');

// Datenbankverbundung herstellen
$db = mysqli_connect("127.0.0.1", "root", "", "adressverwaltung");	// Zu Datenbankserver verbinden
setValue('cfg_db', $db);
