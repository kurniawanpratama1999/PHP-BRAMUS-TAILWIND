<?php ob_start(); ?>
<main class="h-dvh">
    <form method="post">
        <label for="username">
            <span>username</span>
            <input type="text" name="username">
        </label>
        <label for="password">
            <span>password *</span>
            <input type="password" name="password">
        </label>

        <button class="">Login</button>
    </form>
</main>
<?php return ob_get_clean(); ?>