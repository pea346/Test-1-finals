<?= $this->extend('components/client_layout') ?>
<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-100 mb-4 p-4 rounded text-green-800">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="bg-red-100 mb-4 p-4 rounded text-red-800">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<h1 class="mb-4 font-bold text-3xl heading-font">Welcome, <?= esc($user['first_name']) ?>!</h1>
<p class="mb-6 text-gray-700 dark:text-gray-300">
    Here’s what’s happening today at PizzaHub 🍕
</p>

<!-- Quick Action Buttons -->
<div class="flex gap-4 mb-6">
    <a href="/client/menu" class="bg-yellow-400 hover:bg-yellow-500 shadow px-6 py-3 rounded-lg font-semibold text-gray-900">
        Order Now
    </a>
    <a href="/client/menu" class="bg-gray-300 hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 shadow px-6 py-3 rounded-lg font-semibold text-gray-900 dark:text-white">
        View Menu
    </a>
</div>

<!-- Promotions Section -->
<h2 class="mb-4 font-semibold text-xl">🔥 Promotions</h2>
<div class="gap-4 grid grid-cols-1 md:grid-cols-3 mb-6">
    <div class="bg-red-100 dark:bg-red-700 shadow p-5 rounded-xl hover:scale-105 transition">
        <h3 class="mb-2 font-bold text-lg">Buy 1 Get 1 Free</h3>
        <p class="text-gray-700 dark:text-gray-200">Order any medium pizza and get another one free!</p>
    </div>
    <div class="bg-yellow-100 dark:bg-yellow-700 shadow p-5 rounded-xl hover:scale-105 transition">
        <h3 class="mb-2 font-bold text-lg">20% Off First Order</h3>
        <p class="text-gray-700 dark:text-gray-200">Get 20% off your first online order!</p>
    </div>
    <div class="bg-green-100 dark:bg-green-700 shadow p-5 rounded-xl hover:scale-105 transition">
        <h3 class="mb-2 font-bold text-lg">Free Drink</h3>
        <p class="text-gray-700 dark:text-gray-200">Free soda with any large pizza order.</p>
    </div>
</div>



<?= $this->endSection() ?>