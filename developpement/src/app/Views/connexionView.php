<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../dist/style.css"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="min-h-screen bg-gray-200">
    <!-- <form action="" class="center-form " >
        <div class="form-header">
            <h2> SEED RECEPTION</h2>
            <br>
            <h3>Connexion</h3>
        </div>
        <label for="login">Log in</label>
        <div >
            <input type="text" class="textfield" required placeholder="mon_login">
        </div>
        <label for="mp">Mot de passe</label>
        <div >
            <input type="textpassword"  class="textfield" placeholder="un_mot_de_passe" required>
        </div>

        <div class="form-footer" >
            <a href="#">Mot de passe oublie ?</a>
            <input type="submit" value="Valider">
        </div>
    </form> -->
    <div class="flex flex-col justify-center items-center w-screen basis-full min-h-screen">
        <form action="<?= base_url(); ?>/Connexion/connexion" method="POST"
            class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="mb-2 text-center text-blue-500 font-bold  text-xl"> SEED RECEPTION</h1>
            <h3 class="text-center text-lg">Connexion</h3>

            <?php
            if (isset($error)) {
                echo "<div class='text-right text-red-500 text-xs'>
                     $error 
                </div>
                ";
            }
            ?>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="login" name="login" type="text" placeholder="Username">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input
                    class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="password" name="password" type="password" placeholder="">
                <p class="text-red-500 text-xs italic">Please choose a password.</p>
            </div>
            <div class="flex items-center justify-between mb-4">
                <!-- <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                    Forgot Password?
                </a> -->
                <button
                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Sign In
                </button>

            </div>
            <small class="">
                &copy;2022 SEED Digital school. All rights reserved.
            </small>
        </form>

    </div>
</body>

</html>