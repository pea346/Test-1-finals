<?php
$errors = session('errors') ?? [];
$old = session('old') ?? [];
?>
<!DOCTYPE html>
<html lang="en" class="bg-gray-100 dark:bg-gray-900">
<?= view('components/head', ['title' => 'Signup Page']) ?>


<body class="flex flex-col justify-center items-center bg-gradient-to-br from-yellow-100 dark:from-gray-800 via-red-100 dark:via-gray-900 to-orange-200 dark:to-black min-h-screen">


    <div class="pizza-bg" style="top: 10%; left: 15%;">🍕</div>
    <div class="pizza-bg" style="top: 70%; left: 10%;">🍕</div>
    <div class="pizza-bg" style="top: 30%; right: 15%;">🍕</div>
    <div class="pizza-bg" style="bottom: 10%; right: 20%;">🍕</div>

    <div class="top-8 left-8 absolute">
        <a href="/" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 px-5 py-2.5 rounded-lg text-white">
            ← Back
        </a>
    </div>

    <?= view('components/cards/login-card', [
        'title' => 'Create Your Account',
        'action' => '/signup',
        'inputs' => '
            <div class="gap-4 grid grid-cols-2">
                <div>
                    <label for="first_name" class="block mb-1 text-gray-700 dark:text-gray-300">First Name</label>
                    <input id="first_name" name="first_name" type="text" required
                        value="' . esc($old['first_name'] ?? '') . '"
                        class="dark:bg-gray-700 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 w-full dark:text-white">
                    ' . (!empty($errors['first_name']) ? '<p class="mt-2 text-red-600 text-sm">' . esc($errors['first_name']) . '</p>' : '') . '
                </div>

                <div>
                    <label for="last_name" class="block mb-1 text-gray-700 dark:text-gray-300">Last Name</label>
                    <input id="last_name" name="last_name" type="text" required
                        value="' . esc($old['last_name'] ?? '') . '"
                        class="dark:bg-gray-700 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 w-full dark:text-white">
                    ' . (!empty($errors['last_name']) ? '<p class="mt-2 text-red-600 text-sm">' . esc($errors['last_name']) . '</p>' : '') . '
                </div>
            </div>

            <div>
                <label for="email" class="block mb-1 text-gray-700 dark:text-gray-300">Email</label>
                <input id="email" name="email" type="email" required
                    value="' . esc($old['email'] ?? '') . '"
                    class="dark:bg-gray-700 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 w-full dark:text-white">
                ' . (!empty($errors['email']) ? '<p class="mt-2 text-red-600 text-sm">' . esc($errors['email']) . '</p>' : '') . '
            </div>

            <div>
                <label for="password" class="block mb-1 text-gray-700 dark:text-gray-300">Password</label>
                <input id="password" name="password" type="password" required
                    class="dark:bg-gray-700 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 w-full dark:text-white">
                ' . (!empty($errors['password']) ? '<p class="mt-2 text-red-600 text-sm">' . esc($errors['password']) . '</p>' : '') . '
            </div>
        ',
        'button' => view('components/buttons/form-button', ['label' => 'Sign Up']),
        'extraLink' => 'Already have an account? <a href="/login" class="text-red-600 hover:underline">Login</a>'
    ]) ?>
</body>

</html>