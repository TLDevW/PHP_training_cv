<?

setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

include_once "infos_cv.php";

function calculerAge($date)
{
    //On déclare les dates à comparer
    $dateNais = new DateTime($date);
    $dateJour = new DateTime();

    //On calcule la différence
    $difference = $dateNais->diff($dateJour);

    //On retourne la différence en années
    return $difference->format('%Y');
}

$reverse = array_reverse($cv['diplomes']);
$reverse2 = array_reverse($cv['experiences']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_cv.css">
    <title>CV</title>
</head>

<body>


    <h1><?= $cv['nom'] ?> - <?= $cv['metier'] ?></h1>
    <img id="profil" src='photo_cv.jpg'>
    <p><?= calculerAge($cv['date_naissance']) ?> ans</p>
    <p><?= $cv['adresse'] ?></p>
    <p>Téléphone : <?= wordwrap($cv['tel'], 2, '-', true); ?></p>

    <h1>Diplômes</h1>

    <? foreach ($reverse as $diplome => $annee) { ?>
        <li><?= $annee ?> : <?= $diplome ?> </li>
    <? } ?>

    <h1>Expériences</h1>

    <? foreach ($reverse2 as $key => $experience) { ?>


        <li><?= strftime('%d %B %Y', strtotime($experience['debut'])) ?>
            <? if ($experience['fin'] === 'now') {
                echo "à " ?><b>maintenant :</b>
            <? } else {
                echo "au " . strftime('%d %B %Y', strtotime($experience['fin'])). " : " ;
            } ?>
             <I><?= $experience['libelle'] ?></I>
        </li>

    <? } ?>

    <br>

    <h1>Expériences</h1>

    <table>
        <? foreach ($cv['competences'] as $competence => $niveau) { ?>
            <tr>
                <td><?= $competence ?></td>

                <? for ($i = 1; $i < 6; $i++) { ?>
                    <td id="td2">
                        <? if ($i <= $niveau) {
                        ?> <img src='etoile_pleine.png'>

                        <? } else {
                        ?> <img src='etoile_vide.png'>
                        <? } ?>
                    </td>
                <? } ?>

            <? } ?>
            </tr>
    </table>

</body>

</html>