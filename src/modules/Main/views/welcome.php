<?php
    use Lunaris\Framework\Facades\Flash;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome Lunaris</title>
    </head>
    <body>
        <h1>Welcome to Lunaris from router</h1>
        <h3>Hello <?php echo $series; ?></h3>
        <p>Message :: <?php echo $message; ?></p>
        <p>Boolean :: <?php echo $isit; ?></p>
        <p>Number :: <?php echo $number; ?></p>
        <?php inject('nest', ["args" => [
            "message" => "Args not displaying"
        ]]); ?>

        <?= base_path('app/config/providers.php') ?>

        <div>
            <p>App Name :: <?= env('APP_NAME') ?></p>
        </div>

        <div>
            <?php
                Flash::render("success", "<p>@message</p>");
            ?>
        </div>
    </body>
</html>