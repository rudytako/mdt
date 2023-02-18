<?php
    if (isset($_FILES['image'])) {
        include('header.php');
        $img_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $explode = explode('.', $img_name);
        $img_ext = end($explode);

        $extensions = ['png', 'jpg', 'jpeg'];
        if (in_array($img_ext, $extensions) === true) {
            $new_img_name = $_POST['file_name'].'.'.$img_ext;
            $dir = 'assets/images/users/'.$new_img_name;
            move_uploaded_file($temp_name, $dir);
            $data->doQuery("UPDATE users SET kartoteka_avatar='$dir'");
        }
    }
?>