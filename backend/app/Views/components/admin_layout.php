<!DOCTYPE html>
<html lang="en">

<?= view('components/head', ['title' => $title ?? 'Admin Layout']) ?>

<body class="flex flex-col bg-[#F5F5F0] dark:bg-[#F5F5F0] min-h-screen">

    <!-- ✅ TOP HEADER -->
    <header class="flex justify-between items-center bg-[#F5F5F0] dark:bg-[#B91C1C] shadow px-6 py-4 w-full">

        <!-- Left side: Logo + Admin Title -->
        <div class="flex items-center gap-3">
            <img src="/assets/img/logo.png"
                alt="PizzaHot Logo"
                class="rounded-full w-10 h-10 object-cover">
            <h1 class="font-bold text-[#EF4444] dark:text-[#FFFFFF] text-xl heading-font">
                PizzaHot
            </h1>
        </div>


        <!-- Right side: Logout -->
        <nav class="flex items-center gap-4">
            <a href="<?= site_url('logout') ?>"
                class="bg-[#D22B2B] hover:bg-[#B91C1C] shadow px-4 py-2 rounded-lg text-white">
                Logout
            </a>
        </nav>
    </header>

    <!-- MAIN SECTION: Sidebar + Content -->
    <div class="flex flex-1">

        <!-- Sidebar -->
        <?= $this->include('components/admin_sidebar') ?>

        <!-- Page Content -->
        <main class="flex-1 space-y-8 p-10">
            <?= $this->renderSection('content') ?>
        </main>

    </div>

</body>

</html>