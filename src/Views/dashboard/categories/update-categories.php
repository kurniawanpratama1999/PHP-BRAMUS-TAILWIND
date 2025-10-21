<?php function updateCategories($cmd)
{
    ob_start(); ?>
    <div>
        <div class="text-center mb-5">
            <h2 class="font-bold text-5xl">VIEW ALL CATEGORIES</h2>
            <?= $cmd ?>
        </div>
    </div>
<?php return ob_get_clean();
} ?>