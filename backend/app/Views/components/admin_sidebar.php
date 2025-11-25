<?php $active = $active ?? ''; ?>
<aside class="flex flex-col bg-[#F5F5F0] dark:bg-[#000000] shadow-md w-64">
    <div class="p-6">

        <!-- PizzaHot Admin Title -->
        <h2 class="font-bold text-[#D22B2B] text-2xl heading-font">🍕 PizzaHot Admin</h2>

        <!-- ✅ Welcome Bar -->
        <div class="bg-[#D22B2B] shadow mt-3 px-3 py-1 rounded-lg text-[#FFFFFF] text-sm">
            Welcome, Admin
        </div>

    </div>

    <nav class="flex-1 space-y-3 px-4 py-6">
        <a href="<?= site_url('admin/dashboard') ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#EAEAEA] dark:hover:bg-[#2C2C2C] <?= $active === 'dashboard' ? 'bg-[#EAEAEA] dark:bg-[#2C2C2C] font-semibold' : 'text-[#333333] dark:text-[#F5F5F0]' ?>">🏠 Dashboard</a>
        <a href="<?= site_url('admin/menu') ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#EAEAEA] dark:hover:bg-[#2C2C2C] <?= $active === 'menu' ? 'bg-[#EAEAEA] dark:bg-[#2C2C2C] font-semibold' : 'text-[#333333] dark:text-[#F5F5F0]' ?>">🍕 Menu Items</a>
        <a href="<?= site_url('admin/accounts') ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#EAEAEA] dark:hover:bg-[#2C2C2C] <?= $active === 'accounts' ? 'bg-[#EAEAEA] dark:bg-[#2C2C2C] font-semibold' : 'text-[#333333] dark:text-[#F5F5F0]' ?>">👤 Accounts</a>
        <a href="<?= site_url('admin/orders') ?>" class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#EAEAEA] dark:hover:bg-[#2C2C2C] <?= $active === 'orders' ? 'bg-[#EAEAEA] dark:bg-[#2C2C2C] font-semibold' : 'text-[#333333] dark:text-[#F5F5F0]' ?>">📬 Order Requests</a>
    </nav>
</aside>