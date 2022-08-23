<?php
if ($controller) {
    $controller;
?>
    <form action="<?= base_url($controller . '/recherche') ?>" method="POST" class="mx-auto w-1/2">
        <span>
            <input type="text" id="search" name="search" required placeholder="Taper le motif de recherche ici" class="w-3/4 shadow appearance-none border rounded py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none">
            <button type="submit" class="">Rechercher</button>
        </span>
    </form>
<?php
}
