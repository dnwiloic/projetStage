<nav class="grid grid-cols-5 judtify-end bg-white border-gray-200 px-2 sm:px-4 min-w-screen py-2.5 dark:bg-gray-800">        
    <div class="mr-3 bg-gray-800 md:mr-0" id="user-menu-button w-fit" aria-expanded="false" data-dropdown-toggle="dropdown">
        <img  src="<?= base_url();?>\assets\image\logos/logoSEED.png" alt="logo">
    </div>
    <div class="col-span-3">
        <div class="m-auto w-fit">
            <a href="<?= base_url("connexion/deconnexion");?>" class="block w-fit py-2 px-5 transition-all duration-500 hover:bg-violet-500 rouded rounded-full bg-blue-500 text-white">Déconnexion</a>            
        </div>
    </div>
    <div class="relative mr-3 bg-gray-800 md:mr-0" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
        <img class="absolute right-0" src="<?= base_url();?>\assets\image\logos/Slogan1.png" alt="logo">
    </div >
</nav>