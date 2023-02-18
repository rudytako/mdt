<?php
include('header.php');
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
include('navbar.php');
?>
<?php
if (isset($_POST['dane']) && $_POST['dane'] != '') {
    $dane = $_POST['dane'];
    $msg = 'Dodano wpis dla '.$dane;
    $wpisujacy = $_SESSION['me'];

    if (isset($_POST['mandat'])) {
        $powod = htmlentities($_POST['powod']);
        $kara = htmlentities($_POST['kara']);
        $data->doQuery("INSERT INTO mandaty (dane, powod, kara, data, wpisujacy) VALUES ('$dane', '$powod', '$kara', CURRENT_TIMESTAMP(), '$wpisujacy')");
    } else if (isset($_POST['kart'])) {
        $powod = htmlentities($_POST['powod']);
        $kara = htmlentities($_POST['kara']);
        $data->doQuery("INSERT INTO kartoteka (dane, powod, kara, data, wpisujacy) VALUES ('$dane', '$powod', '$kara', CURRENT_TIMESTAMP(), '$wpisujacy')");
    } else if (isset($_POST['bolo'])) {
        $already = $data->doQuery("SELECT * FROM bolo WHERE dane='$dane'");
        if ($already->num_rows == 0) {
            $powod = htmlentities($_POST['powod']);
            $data->doQuery("INSERT INTO bolo (dane, powod, data, wpisujacy) VALUES ('$dane', '$powod', CURRENT_TIMESTAMP(), '$wpisujacy')");
        } else {
            $msg = 'Podana osoba jest już na bolo!';
        } 
    } else if (isset($_POST['notatka'])) {
        $tresc = htmlentities($_POST['tresc']);
        $data->doQuery("INSERT INTO notatki (dane, tresc, wpisujacy) VALUES ('$dane', '$tresc', '$wpisujacy')");
    } else if (isset($_POST['licencja'])) {
        $licencja = htmlentities($_POST['license']);
        $data->doQuery("INSERT INTO licencje (dane, licencja) VALUES ('$dane', '$licencja')");
    }
?>
    <div class="alert">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg"><?php echo $msg ?></span>
        <div class="close-btn">
            <span class="fas fa-times"></span>
        </div>
    </div>
<?php }
?>

<section id='wpis'>
    <div class='container'>
        <div id='bolo' class='title'>Utwórz wpis na bolo</div>
        <div id='id-bolo' class='container text-center unactive'>
            <form action='wpis.php' method='post' class='mt-5'>
                <input type='text' name='dane' placeholder="Imię i nazwisko"><br>
                <input type='hidden' name='bolo' value='bolo'>
                <textarea class='mt-4' name='powod' placeholder="Powód"></textarea><br>
                <input type='submit' class='mt-3 search-button' value='Potwierdź'>
            </form>
        </div>
        <div id='mandat' class='title'>Utwórz mandat</div>
        <div id='id-mandat' class='container text-center unactive'>
            <form action='wpis.php' method='post' class='mt-5'>
                <input type='text' name='dane' placeholder="Imię i nazwisko"><br>
                <input class='mt-3' name='kara' type='text' placeholder="Kara"><br>
                <input type='hidden' name='mandat' value='mandat'>
                <textarea class='mt-4' name='powod' placeholder="Powód"></textarea><br>
                <input type='submit' class='mt-3 search-button' value='Potwierdź'>
            </form>
        </div>
        <div id='kart' class='title'>Utwórz kartotekę</div>
        <div id='id-kart' class='container text-center unactive'>
            <form action='wpis.php' method='post' class='mt-5'>
                <input type='text' name='dane' placeholder="Imię i nazwisko"><br>
                <input class='mt-3' name='kara' type='text' placeholder="Kara"><br>
                <input type='hidden' name='kart' value='kart'>
                <textarea class='mt-4' name='powod' placeholder="Powód"></textarea><br>
                <input type='submit' class='mt-3 search-button' value='Potwierdź'>
            </form>
        </div>
        <div id='notatka' class='title'>Utwórz notatkę</div>
        <div id='id-notatka' class='container text-center unactive'>
            <form action='wpis.php' method='post' class='mt-5'>
                <input type='text' name='dane' placeholder="Imię i nazwisko"><br>
                <input type='hidden' name='notatka' value='notatka'>
                <textarea class='mt-4' name='tresc' placeholder="Treść"></textarea><br>
                <input type='submit' class='mt-3 search-button' value='Potwierdź'>
            </form>
        </div>
        <div id='licencja' class='title'>Utwórz licencję</div>
        <div id='id-licencja' class='container text-center unactive'>
            <form action='wpis.php' method='post' class='mt-5'>
                <input type='text' name='dane' placeholder="Imię i nazwisko"><br>
                <div class="custom-select" style="width:250px;">
                    <select name='license' id="mounth">
                        <option value="Prawo jazdy">Prawo jazdy</option>
                        <option value="Licencja na broń Kl I">Licencja na broń Kl I</option>
                        <option value="Licencja na broń Kl II">Licencja na broń Kl II</option>
                        <option value="Licencja na broń Kl III">Licencja na broń Kl III</option>
                        <option value="Licencja ochroniarska">Licencja ochroniarska</option>
                        <option value="Licencja konwojenta">Licencja konwojenta</option>
                        <option value="Licencja myśliwska">Licencja myśliwska</option>
                    </select></br>
                </div>
                <input type='hidden' name='licencja' value='licencja'>
                <input type='submit' class='mt-3 search-button' value='Potwierdź'>
            </form>
        </div>
    </div>
</section>

<?php
include('footer.php');
?>