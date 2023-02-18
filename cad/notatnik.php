<?php
include('header.php');
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
include('navbar.php');
$dane = $_SESSION['me'];

if (isset($_POST['tresc'])) {
    $tresc = $_POST['tresc'];
    $data->doQuery("UPDATE funkcjonariusze SET notatki='$tresc'");
}

$notes = $data->getData("SELECT notatki FROM funkcjonariusze WHERE dane='$dane'");
?>

<section>
    <div class="container text-center">
        <h1>Moje notatki</h1>
        <form action='notatnik.php' method='post'>
            <textarea class='notes-area' name='tresc'><?php echo $notes['notatki'] ?></textarea></br>
            <input class='mt-3 search-button' type='submit' value='Zapisz'>
        </form>
    </div>
</section>

<?php
    include('footer.php');
?>