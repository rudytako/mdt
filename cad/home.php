<?php
include('header.php');
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
include('navbar.php');
$active = $data->doQuery('SELECT * FROM aktywni');
$patrols = $data->doQuery('SELECT * FROM patrole');
$bolo = $data->doQuery('SELECT * FROM bolo');
?>
<section id='login'>
    <div class='container'>
        <div class="row">
            <div class='tile col-md-4'>
                <h5>Aktywni funkcjonariusze</h5>
                <h1> <?php echo $active->num_rows; ?> </h1>
            </div>
            <div class='tile col-md-4'>
                <h5>Aktywne patrole</h5>
                <h1> <?php echo $patrols->num_rows; ?> </h1>
            </div>
            <div class='tile col-md-4'>
                <h5>Ilość osób na BOLO</h5>
                <h1> <?php echo $bolo->num_rows; ?> </h1>
            </div>
        </div>
    </div>
</section>

<?php
include('footer.php');
?>