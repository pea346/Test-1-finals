<!DOCTYPE html>
<html lang="en" class="bg-gray-100 dark:bg-gray-900">

<?= view('components/head', ['title' => $title ?? 'Login Page']) ?>

<body class="relative flex flex-col justify-center items-center bg-gradient-to-br from-yellow-100 dark:from-gray-800 via-red-100 dark:via-gray-900 to-orange-200 dark:to-black min-h-screen overflow-hidden">

    <!-- 🍕 Background Pizza Emojis -->
    <div class="pizza-bg" style="top: 10%; left: 15%;">🍕</div>
    <div class="pizza-bg" style="top: 70%; left: 10%;">🍕</div>
    <div class="pizza-bg" style="top: 30%; right: 15%;">🍕</div>
    <div class="pizza-bg" style="bottom: 10%; right: 20%;">🍕</div>

    <!-- 🍕 Back Button -->
    <div class="top-8 left-8 absolute">
        <a href="/" class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 hover:from-red-700 to-red-500 hover:to-red-600 shadow-md px-5 py-2.5 rounded-lg font-semibold text-white transition-all">
            ← Back
        </a>
    </div>

    <!-- 🍕 Login Card -->
    <?= view('components/cards/login-card', [
        'title' => ' Login to PizzaHot ',
        'action' => '/login',
        'inputs' => '
            <div>
                <label for="email" class="block mb-1 text-gray-700 dark:text-gray-300"> Email</label>
                <input id="email" name="email" type="email" required
                    class="dark:bg-gray-700 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 w-full dark:text-white"
                    value="' . esc($old['email'] ?? '') . '"
                    aria-invalid="' . (isset($errors['email']) ? 'true' : 'false') . '"
                    aria-describedby="email-error">
                ' . (!empty($errors['email']) ? '<p id="email-error" class="mt-2 text-red-600 text-sm">' . esc($errors['email']) . '</p>' : '') . '
            </div>

            <div>
                <label for="password" class="block mb-1 text-gray-700 dark:text-gray-300"> Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="dark:bg-gray-700 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 w-full dark:text-white"
                    aria-invalid="' . (isset($errors['password']) ? 'true' : 'false') . '"
                    aria-describedby="password-error">
                ' . (!empty($errors['password']) ? '<p id="password-error" class="mt-2 text-red-600 text-sm">' . esc($errors['password']) . '</p>' : '') . '
            </div>
        ',
        'button' => view('components/buttons/form-button', ['label' => ' Login ']),
        'signupLink' => '/signup'

    ]) ?>

</body>

</html>