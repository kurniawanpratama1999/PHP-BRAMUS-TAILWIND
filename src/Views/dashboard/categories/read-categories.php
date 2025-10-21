<?php ob_start(); ?>
<div class="p-5">
    <div class="text-center mb-5">
        <h2 class="font-bold text-5xl">VIEW ALL CATEGORIES</h2>
    </div>
    <a class="py-2 px-5 fixed bottom-5 right-5 rounded bg-emerald-300 text-white shadow font-bold">Add User</a>
    <table class="border border-slate-400 w-full [&_th]:p-2 [&_th]:border [&_th]:border-slate-400 [&_td]:p-2 [&_td]:border [&_td]:border-slate-400">
        <tr class="text-left bg-amber-300 font-semibold">
            <th class="w-[70px]">ID</th>
            <th class="">Category Name</th>
            <th class="w-[100px]">Actions</th>
        </tr>
        <tr>
            <td>1</td>
            <td>2</td>
            <td class="flex items-center justify-center gap-3 border-none">
                <a href="" class="p-1 rounded bg-red-400 text-white">❌</a>
                <a href="" class="p-1 rounded bg-indigo-400 text-white">🖊</a>
            </td>
        </tr>
    </table>
</div>
<?php return ob_get_clean(); ?>