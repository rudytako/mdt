<?php
include('header.php');
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
include('navbar.php');

if (isset($_GET['license'])) {
    $license = $_GET['license'];
    $dane = $_SESSION['dane'];
    $data->doQuery("DELETE FROM licencje WHERE dane='$dane' AND licencja='$license'");
}

if (isset($_FILES['image'])) {
    $img_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $explode = explode('.', $img_name);
    $img_ext = end($explode);

    $extensions = ['png', 'jpg', 'jpeg'];
    if (in_array($img_ext, $extensions) === true) {
        $new_img_name = time().'.'.$img_ext;
        $dir = 'assets/images/users/'.$new_img_name;
        move_uploaded_file($temp_name, $dir);
        $identifier = $_POST['hex'];
        $fivemdData->doQuery("UPDATE users SET kartoteka_avatar='$dir' WHERE identifier='$identifier'");
    }
}

?>
<section id='obywatel'>
    <?php if (isset($_GET['person']) ) {
            $input = htmlentities($_GET['person']);
            $result = $data->doQuery("SELECT * FROM bolo WHERE dane='$input'");
            if ($result->num_rows > 0) { ?>
                <div class="alert">
                    <span class="fas fa-exclamation-circle"></span>
                    <span class="msg">Ten obywatel jest poszukiwany!</span>
                    <div class="close-btn">
                        <span class="fas fa-times"></span>
                    </div>
                </div>
            <?php } } ?>

    <div class="container">
        <div class="text-center">
            <h1>Wyszukaj obywatela</h1>
            <form action='obywatel.php' method="get" class='mt-3'>
                <input type='text' name='person' placeholder="Imię i nazwisko">
                <input class='search-button' type='submit' value='Wyszukaj'>
            </form>
        </div>

        <?php if (isset($_GET['person']) ) {
            $input = $_GET['person'];
            $_SESSION['dane'] = $input;
            $dane = explode(" ", $input);
            $name = htmlentities($dane[0]);
            $surname = htmlentities($dane[1]);
            $info = $fivemData->getData("SELECT * FROM users WHERE firstname='$name' AND lastname='$surname'");
            $bolo = $data->doQuery("SELECT * FROM bolo WHERE dane='$input'");
            
            if ($info == null) {
                $info = array(
                    'firstname' => $name,
                    'lastname' => $surname,
                    'dateofbirth' => '18.05.1986',
                    'sex' => 'M',
                    'kartoteka_avatar' => 'assets/images/unkown.png'
                );
                $licenses = array(
                    '0' => array(
                        'licencja' => 'Prawo jazdy',
                    ),
                );
                $citations = array(
                    '0' => array(
                        'data' => '12.02.2021',
                        'powod' => 'Przejazd na czerwonym świetle, przekroczenie prędkości o 10mph',
                        'kara' => '$250',
                        'wpisujacy' => 'Christofer Rood'
                    ),
                );
                $kartoteka = array();
                $vehicles = array(
                    '0' => array(
                        'plate' => 'WGR 420',
                    ),
                );
                $notes = array();
            } else {
                $hex = $info['identifier'];        
                $vehicles = $fivemData->getDataArray("SELECT plate FROM owned_vehicles WHERE owner='$hex'");
                $licenses = $data->getDataArray("SELECT * FROM licencje WHERE dane='$input'");
                $citations = $data->getDataArray("SELECT * FROM mandaty WHERE dane='$input'");
                $kartoteka = $data->getDataArray("SELECT * FROM kartoteka WHERE dane='$input'");
                $notes = $data->getDataArray("SELECT * FROM notatki WHERE dane='$input'");
            }
        ?>
        <div class='result elo'>
            <div class="row">
                <div class="col-md-6 user-image">
                    <img src='<?php if ($info['kartoteka_avatar'] == null) echo "assets/images/unkown.png"; else echo $info['kartoteka_avatar']; ?>'>
                    <form method='post' enctype="multipart/form-data" action='obywatel.php'>
                        <input type='hidden' name='file_name' value='<?php echo $input ?>'>
                        <input type='hidden' name='hex' value='<?php echo $hex ?>'>
                        <input name='image' type='file' onchange="this.form.submit()";>
                    </form>
                </div>
                <div class="col-md-6 user-info">
                    <p>Imię: <span id='firstname'><?php echo $info['firstname']; ?></span></p>
                    <p>Nazwisko: <span id='lastname'><?php echo $info['lastname']; ?></span></p>
                    <p>Data urodzenia: <?php echo $info['dateofbirth']; ?></p>
                    <p>Płeć: <?php echo $info['sex']; ?></p>
                </div>
            </div>

            <div id='license' class='title'>Licencje</div>
            <table id='id-license' class='unactive'>
                <tr class='table-head'>
                    <td class='td-1'>Licencja</td>
                    <td class='td-2'>Status</td>
                    <td class='td-4'>Usuń</td>
                </tr>
                <?php foreach ($licenses as $license) { ?>
                <tr class='table-row'>
                    <td class='td-1 name'><?php echo $license['licencja'] ?></td>
                    <td class='td-2'>Aktywna</td>
                    <td class='td-4'><img id='delete-license' src="assets/images/remove.png" width="30" height="30"></td>
                </tr>
                <?php }?>
            </table>

            <div id='citations' class='title'>Mandaty</div>
            <table id='id-citations' class='unactive'>
                <tr class='table-head'>
                    <td class='td-1'>Data</td>
                    <td class='td-2'>Powód</td>
                    <td class='td-3'>Kara</td>
                    <td class='td-4'>Wpisujący</td>
                </tr>
                <?php foreach ($citations as $citation) { ?>
                <tr class='table-row'>
                    <td class='td-1'><?php echo $citation['data'] ?></td>
                    <td class='td-2'><?php echo $citation['powod'] ?></td>
                    <td class='td-3'><?php echo $citation['kara'] ?></td>
                    <td class='td-4'><?php echo $citation['wpisujacy'] ?></td>
                </tr>
                <?php }?>
            </table>

            <div id='kartoteka' class='title'>Kartoteka</div>
            <table id='id-kartoteka' class='unactive'>
                <tr class='table-head'>
                    <td class='td-1'>Data</td>
                    <td class='td-2'>Powód</td>
                    <td class='td-3'>Kara</td>
                    <td class='td-4'>Wpisujący</td>
                </tr>
                <?php foreach ($kartoteka as $kart) { ?>
                <tr class='table-row'>
                    <td class='td-1'><?php echo $kart['data'] ?></td>
                    <td class='td-2'><?php echo $kart['powod'] ?></td>
                    <td class='td-3'><?php echo $kart['kara'] ?></td>
                    <td class='td-4'><?php echo $kart['wpisujacy'] ?></td>
                </tr>
                <?php } ?>
            </table>

            <div id='vehicles' class='title'>Zarejestrowane pojazdy</div>
            <table id='id-vehicles' class='unactive'>
                <tr class='table-head'>
                    <td class='td-1'>Rejestracja</td>
                </tr>
                <?php foreach ($vehicles as $vehicle) { ?>
                <tr class='table-row'>
                    <td class='td-1'><?php echo $vehicle['plate'] ?></td>
                </tr>
                <?php } ?>
            </table>

            <div id='notatki' class='title'>Notatki</div>
            <table id='id-notatki' class='unactive'>
                <tr class='table-head'>
                    <td class='td-1'>Treść</td>
                    <td class='td-2'>Wpisujący</td>
                </tr>
                <?php foreach ($notes as $note) { ?>
                <tr class='table-row'>
                    <td class='td-1'><?php echo $note['tresc'] ?></td>
                    <td class='td-2'><?php echo $note['wpisujacy'] ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</section>
<?php
    }
    include('footer.php');
?>