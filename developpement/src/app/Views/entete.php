<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url();?>/assets/style/dist/style.css">
    <title >Document</title>
</head>

<body>
    <div class="fixed top-0 left-0 w-full h-full z-99 transition-all duration-500" id="alert">
        <?php
            if(session()->Has('success'))
            {
        ?>
                <div class="bg-teal-200 py-2 transition-all duration-500 px-3 text-center rounded rounded-sl w-fit mx-auto my-8">
                    <?php echo session()->getFlashdata("success");?>
                </div>
        <?php
            }
        ?>

        <?php
            if(session()->Has('fail'))
            {
        ?>
                <div class="bg-red-200 py-2 px-3 text-center transition-all duration-500 rounded rounded-xl w-fit m-auto mt-8">
                    <?php echo session()->getFlashdata("fail");?>
                </div>
        <?php
            }
        ?>

        <?php
            if(session()->Has('notify'))
            {
        ?>
                <div class="bg-yellow-200 py-2 px-3 text-center transition-all duration-500 rounded rounded-xl w-fit m-auto my-8">
                    <?php echo session()->getFlashdata("notify");?>
                </div>
        <?php
            }
        ?>
    </div>
    <script>
        let alerts=document.querySelector("#alert");
            setTimeout(function(){
                alerts.classList.add("hidden");
            },2200)
    </script>