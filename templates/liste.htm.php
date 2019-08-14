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
                <td data-label="Löschen"><a href="<?php echo getValue('phpmodule')?>&kid=<?php echo $kontakt['kid']?>"><i class="fas fa-trash"></i></a>
                <td data-label="Name"><?php echo $kontakt['name']?></td>
                <td data-label="Vorname"><?php echo $kontakt['vorname']?></td>
                <td data-label="Strasse"><?php echo $kontakt['strasse']?></td>
                <td data-label="PLZ"><?php if(empty($kontakt['plz'])) echo ""; else echo $kontakt['plz']?></td>
                <td data-label="Ort"><?php echo $kontakt['ort']?></td>
                <td data-label="Email"><?php echo $kontakt['email']?></td>
                <td data-label="Telefon privat"><?php echo $kontakt['tpriv']?></td>
                <td data-label="Telefon gesch."><?php echo $kontakt['tgesch']?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>