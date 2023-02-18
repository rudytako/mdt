<?php
include('header.php');
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
include('navbar.php');

if (isset($_GET['dane'])) {
    $dane = $_GET['dane'];
    $data->doQuery("DELETE FROM bolo WHERE dane='$dane'");
}

?>
<section id='bolo'>
    <h1>Lista Poszukiwanych</h1>
    <table class='table-bolo'>
        <tr class='table-head'>
            <td class='td-1'>Imię i nazwisko</td>
            <td class='td-2'>Powód</td>
            <td class='td-3'>Data wpisu</td>
            <td class='td-4'>Wpisujący</td>
            <td class='td-4'>Usuń</td>
        </tr>
        <?php foreach ($data->getDataArray('SELECT * FROM bolo') as $item) { ?>
            <tr class='table-row'>
                <td class='td-1 dane'><?php echo $item['dane'] ?></td>
                <td class='td-2'><?php echo $item['powod'] ?></td>
                <td class='td-3'><?php echo $item['data'] ?></td>
                <td class='td-4'><?php echo $item['wpisujacy'] ?></td>
                <td class='td-4'><img id='delete-bolo' src="assets/images/remove.png" width="30" height="30"></td>
            </tr>
            <?php } ?>
    </table>
</section>

<?php
include('footer.php');
?>