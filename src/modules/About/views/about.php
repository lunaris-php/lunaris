<?php
    use Lunaris\Framework\App\Facades\Crypt;
    use Lunaris\Framework\App\Facades\Password;
?>

<h1>This is about page</h1>

<?php

    inject("beta", [
        "module" => "About",
        "args" => [
            "okay" => 8547
        ]
    ]);

?>

<?php
    $str = "Hello World";
    $enc = Crypt::encrypt($str);
    $dec = Crypt::decrypt($enc);
?>

<p>String :: <?php echo $str; ?></p>
<p>Encrypted :: <?php echo $enc; ?></p>
<p>Decrypted :: <?php echo $dec; ?></p>

<?php
    $pass = "Admin@12345";
    $hash = Password::hash($pass);
?>

<p>Check :: <?php echo Password::check($pass) ? 'Okay' : 'Not okay'; ?></p>
<p>Hash :: <?php echo $hash; ?></p>
<p>Verify :: <?php echo Password::verify("Admin@12345", $hash) ? "Verified" : "Not verified"; ?></p>