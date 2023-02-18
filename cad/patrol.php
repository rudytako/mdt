<?php
include('header.php');
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
include('navbar.php');
?>
<?php
    if (isset($_POST['pojazd'])) {
        $_SESSION['nazwa'] = $_POST['nazwa'];
        $_SESSION['sklad'] = $_POST['sklad'];
        $_SESSION['obszar'] = $_POST['obszar'];
        $_SESSION['wyposazenie'] = $_POST['wyposazenie'];
        $_SESSION['pojazd'] = $_POST['pojazd'];
        $_SESSION['status'] = $_POST['status'];

        $dane = $_SESSION['me'];
        $nazwa = $_POST['nazwa'];
        $sklad = $_POST['sklad'];
        $obszar = $_POST['obszar'];
        $wyposazenie = $_POST['wyposazenie'];
        $pojazd = $_POST['pojazd'];
        $status = $_POST['status'];
        if ($status == '--Status--') $status = 'brak';
        if ($wyposazenie == '--Wyposażenie--') $wyposazenie = 'brak';
        if ($pojazd == '--Pojazd--') $pojazd = 'brak';
        $already = $data->doQuery("SELECT * FROM patrole WHERE dane='$dane'");
        if ($already->num_rows > 0) {
            $dupa = $data->doQuery("UPDATE patrole SET jednostka='$nazwa', sklad='$sklad', pojazd='$pojazd', obszar='$obszar', wyposazenie='$wyposazenie', status='$status' WHERE dane='$dane'");
            ?>
            <div class="alert">
                <span class="fas fa-exclamation-circle"></span>
                <span class="msg">Patrol zaktualizowany</span>
                <div class="close-btn">
                    <span class="fas fa-times"></span>
                </div>
            </div>
        <?php 
        } else {
            $data->doQuery("INSERT INTO patrole (dane, jednostka, sklad, pojazd, obszar, wyposazenie, status) VALUES 
            ('$dane', '$nazwa', '$sklad', '$pojazd', '$obszar', '$wyposazenie', '$status')");?>
            <div class="alert">
                <span class="fas fa-exclamation-circle"></span>
                <span class="msg">Patrol utworzony</span>
                <div class="close-btn">
                    <span class="fas fa-times"></span>
                </div>
            </div>
        <?php
        }
    }
    if (isset($_POST['usun'])) {
        $dane = $_SESSION['me'];
        $data->doQuery("DELETE FROM patrole WHERE dane='$dane'");
        unset($_SESSION['nazwa']);
        unset($_SESSION['sklad']);
        unset($_SESSION['obszar']);
        unset($_SESSION['wyposazenie']);
        unset($_SESSION['pojazd']);
        unset($_SESSION['status']);
    }
?>
<section id='patrole'>
    <div class='container'>
        <h1>Zarządzaj patrolem</h1>
        <div class='container text-center'>
            <form action='patrol.php' method='post' class='mt-5'>
                <input type='text' name='nazwa' <?php if (isset($_SESSION['nazwa'])) echo "value='".$_SESSION['nazwa']."'"; else echo "placeholder='Nazwa jednostki'"; ?>><br>
                <input class='mt-4' name='sklad' type='text' <?php if (isset($_SESSION['sklad'])) echo "value='".$_SESSION['sklad']."'"; else echo "placeholder='Skład'"; ?>><br>
                <input class='mt-4' type='text' name='obszar' <?php if (isset($_SESSION['obszar'])) echo "value='".$_SESSION['obszar']."'"; else echo "placeholder='Obszar'"; ?>"><br>
                <div class='row my-5'>
                    <div class='col-md-4'>
                        <div class="custom-select" style="width:200px;">
                            <select name='wyposazenie' id="mounth">
                                <option><?php echo $_SESSION['wyposazenie'] ?? "--Wyposażenie--" ?></option>
                                <option value="pompa">pompa</option>
                                <option value="AR-15">AR-15</option>
                            </select></br>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div style='width: 300px' class="custom-select" style="width:200px;">
                            <select name='pojazd' id="mounth">
                                <option><?php echo $_SESSION['pojazd'] ?? "--Pojazd--" ?></option>
                                <option value="Vapid Stanier QSC209">Vapid Stanier QSC209</option>
                                <option value="Vapid Stanier HRV587">Vapid Stanier HRV589</option>
                                <option value="Vapid Stanier MHE894">Vapid Stanier MHE894</option>
                                <option value="Vapid Valor TEO627">Vapid Valor TEO627</option>
                                <option value="Vapid Valor ZIA253">Vapid Valor ZIA253</option>
                                <option value="Vapid Slicktop WNO266">Vapid Slicktop WNO266</option>
                                <option value="Vapid Stanier UM CCN160">Vapid Stanier UM CCN160</option>

                                <option value="Vapid Scout MBA867">Vapid Scout MBA867</option>
                                <option value="Vapid Scout EPJ622">Vapid Scout EPJ622</option>
                                <option value="Vapid Scout Valor JTG684">Vapid Valor JTG684</option>
                                <option value="Vapid Scout Valor JZI745">Vapid Valor JZI745</option>

                                <option value="Vapid Torrence Valor FGK022">Vapid Valor FGK022</option>
                                <option value="Vapid Torrence Sclicktop HUN497">Vapid Valor HUN497</option>

                                <option value="Decleasse Alamo ANU107">Decleasse Alamo ANU107</option>
                                <option value="Vapid Caracara Valor AHI922">Vapid Caracara Valor AHI922</option>
                                <option value="Wintergreen EDE828">Wintergreen EDE828</option>
                                <option value="Vapid Speedo Transport JGE280">Vapid Speedo Transport JGE280</option>
                                <option value="Bravado Buffalo S UM EEO577">Bravado Buffalo S UM EEO677</option>
                            </select></br>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class="custom-select" style="width:200px;">
                            <select name='status' id="mounth">
                                <option><?php echo $_SESSION['status'] ?? "--Status--" ?></option>
                                <option value="10-6">10-6</option>
                                <option value="10-30">10-30</option>
                                <option value="10-40">10-40</option>
                                <option value="10-50">10-50</option>
                                <option value="status 10">status 10</option>
                                <option value="status 11">status 11</option>
                                <option value="CODE 6">CODE 6</option>
                            </select></br>
                        </div>
                    </div>
                </div>
                <input class='mt-5 search-button' type='submit' value='Zapisz'><br>
            </form>
            <form action='patrol.php' method='post'>
                <input type='hidden' name='usun'>
                <input type='submit' class='mt-3 search-button' value='Usuń'>
            </form>
        </div>
    </div>
</section>
<?php
include('footer.php');
?>