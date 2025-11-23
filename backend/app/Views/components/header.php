<!DOCTYPE html>
<html lang="en">

<?= view('components/head', ['title' => $title ?? 'Header']) ?>

<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-gray-800 shadow-md py-4">
        <div class="flex justify-between items-center mx-auto px-6 max-w-7xl">

            <!-- Brand -->
            <a href="/" class="flex items-center space-x-3">

                <!-- Logo Image -->
                <img src="/assets/img/logo.png"
                    alt="PizzaHot Logo"
                    class="shadow-md rounded-full w-10 h-10 object-cover">

                <!-- Brand Text -->
                <span class="font-bold text-white hover:text-yellow-300 text-2xl transition-colors heading-font">
                    PizzaHot
                </span>
            </a>

            <!-- Navigation -->
            <nav class="flex space-x-6">
                <a href="/" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">Home</a>
                <a href="/signup" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">Sign Up</a>
                <a href="/login" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">Login</a>
            </nav>

        </div>
    </header>

</body>

</html>