<?php

namespace App\Layouts;

class DefaultLayout
{
    public static function render($content, $title = 'PPKD245')
    {
        ob_start(); ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $title ?></title>
            <link rel="stylesheet" href="/src/assets/css/output.css">
        </head>

        <body>
            <?= $content ?>
        </body>

        </html>

<?php return ob_get_clean();
    }
}
?>