<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('components/head', ['title' => $title ?? 'Dashboard']) ?>
</head>

<body class="bg-gray-50">

    <!-- Header -->
    <header class="bg-gray-800 shadow-md py-4">
        <div class="flex justify-between items-center mx-auto px-6 max-w-7xl">
            <!-- Brand -->
            <a href="/" class="flex items-center space-x-3">
                <img src="/assets/img/logo.png" alt="PizzaHot Logo" class="shadow-md rounded-full w-10 h-10 object-cover">
                <span class="font-bold text-white hover:text-yellow-300 text-2xl transition-colors heading-font">
                    PizzaHot
                </span>
            </a>

            <!-- Navigation -->
            <nav class="flex items-center space-x-6">
                <a href="<?= site_url('/client/home') ?>" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">Dashboard</a>
                <a href="<?= site_url('/client/menu') ?>" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">Menu</a>
                <a href="<?= site_url('/client/orders') ?>" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">My Orders</a>
                <a href="<?= site_url('/client/profile') ?>" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">Profile</a>
                <a href="<?= site_url('/logout') ?>" class="text-gray-200 hover:text-yellow-300 hover:underline transition-colors">Logout</a>
            </nav>

        </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto px-6 py-6 max-w-7xl">
        <?= $this->renderSection('content') ?>
    </main>

</body>

</html>