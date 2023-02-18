<?php
include('header.php');
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
include('navbar.php');

if (isset($_GET['dane'])) {
    $dane = $_GET['dane'];
    $fivemData->doQuery("DELETE FROM cad_wezwania WHERE caller='$dane'");
}
if (isset($_GET['add'])) {
    $dane = $_GET['add'];
    $nazwa = $_SESSION['nazwa'];
    $fivemData->doQuery("UPDATE cad_wezwania SET jednostki = CONCAT_WS('  ', jednostki, '$nazwa' ) WHERE caller = '$dane'");
    header('Location: wezwania.php');
}
?>
<section id='wezwania'>
    <h1>Lista aktywnych zgłoszeń</h1>
    <div class='refresh'><img src="assets/images/refresh.png" width="20" height="20"><div id='text'>Odśwież</div></div>
    <table class='text-center table-patrole'>
        <tr class='table-head'>
            <td class='td-1'>Zgłaszający</td>
            <td class='td-2'>Treść</td>
            <td class='td-2'>Adres</td>
            <td class='td-3'>Numer telefonu</td>
            <td class='td-3'>Aktywne jednostki</td>
            <td class='td-3'>Dołącz</td>
            <td class='td-3'>Usuń</td>
        </tr>
        <?php foreach ($fivemData->getDataArray('SELECT * FROM cad_wezwania') as $item) { ?>
        <tr class='table-row'>
            <td class='td-1 caller'><?php echo $item['caller'] ?></td>
            <td class='td-2'><?php echo $item['description'] ?></td>
            <td class='td-2'><?php echo $item['adres'] ?></td>
            <td class='td-3'><?php echo $item['phone'] ?></td>
            <td class='td-3'><?php 
                $jednostki = $item['jednostki'];
                if ($jednostki == '') echo 'Brak jednostek';
                else echo $jednostki;
            ?></td>
            <td class='td-3'><img id='add-dispatch' src="assets/images/plus.png" width="30" height="30"></td>
            <td class='td-4'><img id='delete-dispatch' src="assets/images/remove.png" width="30" height="30"></td>
        </tr>
        <?php } ?>
    </table>
</section>

<?php
include('footer.php');
?>