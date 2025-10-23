<?php

use App\Layouts\DashboardLayout;

ob_start(); ?>
<div>
    <section class="grid grid-cols-2 gap-5">
        <div class="col-start-1 row-start-1 bg-neutral-50 shadow p-4 h-[300px] rounded">a</div>
        <div class="col-start-2 row-start-1 bg-neutral-50 shadow p-4 h-[300px] rounded">a</div>
        <div class="col-span-2 row-start-2 bg-neutral-50 shadow p-4 h-[300px] rounded">a</div>
    </section>
    <section class="bg-neutral-50 shadow p-4 mt-5">
        <h2 class="text-3xl font-bold p-4">Cara Penggunaan</h2>
    </section>
</div>
<?php echo DashboardLayout::render(ob_get_clean()); ?>