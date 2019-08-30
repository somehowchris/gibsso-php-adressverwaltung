<!--
 * @author Daniel Mosimann
 * @version 2019
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
    <table class="tstacked">
        <thead>
            <tr>
                <th></th><th>Name</th><th>Vorname</th><th>Strasse</th><th>PLZ</th><th>Ort</th><th>Email</th><th>Telefon privat</th><th>Telefon gesch.</th>
            </tr>
        </thead>
        <tbody
<?php foreach ( getValue('data') as $kontakt ): ?>
            <tr>
                <td data-label="L�schen"><a href<?=ho getValue('phpmodule')?>&ki<?=ho $kontakt['kid']?>"><i class="fas fa-trash"></i></a>
                <td data-label="Name"><?= $kontakt['name']?></td>
                <td data-label="Vorname"><?= $kontakt['vorname']?></td>
                <td data-label="Strasse"><?= $kontakt['strasse']?></td>
                <td data-label="PLZ"><?php if(empty($kontakt['plz'])) echo ""; else echo $kontakt['plz']?></td>
                <td data-label="Ort"><?= $kontakt['ort']?></td>
                <td data-label="Email"><?= $kontakt['email']?></td>
                <td data-label="Telefon privat"><?= $kontakt['tpriv']?></td>
                <td data-label="Telefon gesch."><?= $kontakt['tgesch']?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>