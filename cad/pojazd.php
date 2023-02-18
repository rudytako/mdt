<?php
include('header.php');
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
include('navbar.php');

?>
<section id='obywatel'>
    <div class="container">
        <div class="text-center">
            <h1>Wyszukaj pojazd</h1>
            <form action='pojazd.php' method='get' class='mt-3'>
                <input class='search' name='nrrej' type='text' placeholder="Numer Rejestracyjny">
                <input class='search-button' type='submit' value='Wyszukaj'>
            </form>
        </div>

        <?php if (isset($_GET['nrrej'])) {
            $input = $_GET['nrrej'];
            if (strpos($input, " ")) {
                $input = str_replace(' ', '', $input);
            }
            $hex = $fivemData->getData("SELECT owner FROM owned_vehicles WHERE plate='$input'");
            if ($hex == null) {
                $owner = array(
                    'firstname' => 'Jack',
                    'lastname' => "Palik",
                );
                $dane = $owner['firstname']." ".$owner['lastname'];
            } else {
                $hex = $hex['owner'];
                $owner = $fivemData->getData("SELECT firstname, lastname FROM users WHERE identifier='$hex'");
                $dane = $owner['firstname']." ".$owner['lastname'];
            }
        ?>
        <div class='result'>
            <div class="row">
                <div class="user-info">
                    <p>Właściciel: <a class='link' href='<?php echo "obywatel.php?person=".$owner['firstname']."+".$owner['lastname']; ?>'><?php echo $dane ?></a></p>
                    <p>Rejestracja: <?php echo $input?></p>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</section>
<?php include('footer.php'); ?>