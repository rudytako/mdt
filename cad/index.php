<?php
    include('header.php');
	
	if ((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
	{
		header('Location: home.php');
		exit();
	}
?>
    <section id='login'>
        <div class='container'>
            <div class='login'>
                <div id='circle'>
                    <img src='assets/images/logo.png' width="100" height="100">
                </div>
                <h1 class='mt-5'>Zaloguj się </h1>
                <form action='login.php' method='post' class='font-rubik'>
                    <input class='mt-3' name='login' type='text' placeholder='login'>
                    <input class='mt-3' name='password' type='password' placeholder='hasło'>
                    <input class='mt-4 search-button' type='submit' value='Zaloguj'>
                    <?php 
                        if (isset($_SESSION['error'])) {
                            echo "<br> <span style='color: red'>".$_SESSION['error']."</span>";
                            unset($_SESSION['error']);
                        }
                    ?>
                </form>
            </div>
        </div>
    </section>
<?php
    include('footer.php');
?>