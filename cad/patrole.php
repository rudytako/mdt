<?php
include('header.php');
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
include('navbar.php');
?>
<section id='patrole'>
            <h1>Lista patroli</h1>
            <table class='text-center table-patrole'>
                <tr class='table-head'>
                    <td class='td-1'>Jednostka</td>
                    <td class='td-2'>Skład</td>
                    <td class='td-2'>Pojazd</td>
                    <td class='td-3'>Obszar</td>
                    <td class='td-4'>Wyposażenie</td>
                    <td class='td-4'>Status</td>
                </tr>
                <?php foreach ($data->getDataArray('SELECT * FROM patrole') as $item) { ?>
                <tr class='table-row'>
                    <td class='td-1'><?php echo $item['jednostka'] ?></td>
                    <td class='td-2'><?php echo $item['sklad'] ?></td>
                    <td class='td-2'><?php echo $item['pojazd'] ?></td>
                    <td class='td-3'><?php echo $item['obszar'] ?></td>
                    <td class='td-4'><?php echo $item['wyposazenie'] ?></td>
                    <td class='td-4'><?php echo $item['status'] ?></td>
                </tr>
                <?php } ?>
            </table>
        </section>

<?php
include('footer.php');
?>