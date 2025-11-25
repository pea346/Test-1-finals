<?= $this->extend('components/admin_layout') ?>
<?= $this->section('content') ?>

<h1 class="font-bold text-[#D22B2B] dark:text-black text-4xl heading-font">Dashboard</h1>

<div class="bg-[#DC2626] shadow-md mt-3 mb-6 p-4 rounded-xl text-white">
    <h2 class="font-bold text-2xl heading-font">🍕Manage all aspects of PizzaHot from here.!</h2>
</div>

<section class="gap-6 grid grid-cols-1 md:grid-cols-3 mt-6">

    <!-- Menu Items Card -->
    <a href="<?= site_url('admin/menu') ?>" class="flex flex-col items-center gap-4 bg-white dark:bg-[#FFB347] shadow hover:shadow-lg p-6 rounded-xl transition">
        <div class="text-[#DC2626] text-5xl">🍕</div>
        <h3 class="font-bold text-[#CA8A04] text-2xl heading-font">Menu Items</h3>
        <p class="text-[#374151] dark:text-[#78350F] text-center">Choose Delicious Foods in our Menu Items</p>
    </a>

    <!-- Accounts Card -->
    <a href="<?= site_url('admin/accounts') ?>" class="flex flex-col items-center gap-4 bg-white dark:bg-[#FFB347] shadow hover:shadow-lg p-6 rounded-xl transition">
        <div class="text-[#CA8A04] text-5xl">👤</div>
        <h3 class="font-bold text-[#CA8A04] text-2xl heading-font">Accounts</h3>
        <p class="text-[#374151] dark:text-[#78350F] text-center">View and manage users.</p>
    </a>

    <!-- Requests Card -->
    <a href="<?= site_url('admin/orders') ?>" class="flex flex-col items-center gap-4 bg-white dark:bg-[#FFB347] shadow hover:shadow-lg p-6 rounded-xl transition">
        <div class="text-[#EA580C] text-5xl">📬</div>
        <h3 class="font-bold text-[#CA8A04] text-2xl heading-font">Requests</h3>
        <p class="text-[#374151] dark:text-[#78350F] text-center">Customer Order requests.</p>
    </a>

</section>

<?= $this->endSection() ?>