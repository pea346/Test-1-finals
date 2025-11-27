<!DOCTYPE html>
<html lang="en">

<?= view('components/head', ['title' => $title ?? 'Header']) ?>

<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-gray-800 shadow-md py-4">
        <div class="flex justify-between items-center mx-auto px-6 max-w-7xl">

            <!-- Brand -->
            <a href="/" class="flex items-center space-x-3">
                <img src="/assets/img/logo.png"
                    alt="PizzaHot Logo"
                    class="shadow-md rounded-full w-10 h-10 object-cover">

                <span class="font-bold text-white hover:text-yellow-300 text-2xl transition-colors heading-font">
                    PizzaHot
                </span>
            </a>

            <!-- Navigation -->
            <nav class="flex items-center space-x-6">

                <a href="/" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">Home</a>
                <a href="/signup" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">Sign Up</a>
                <a href="/login" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">Login</a>

                <!-- Order Button -->
                <a href="/login" class="bg-yellow-400 hover:bg-yellow-500 shadow px-4 py-2 rounded-lg font-semibold text-gray-900">
                    Order Now
                </a>

            </nav>
        </div>
    </header>

</body>

</html>