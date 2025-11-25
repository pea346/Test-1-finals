<!DOCTYPE html>
<html lang="en">

<?= view('components/head', ['title' => 'Roadmap Page']) ?>

<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <?= view('components/header') ?>

    <!-- Content -->
    <main class="space-y-12 mx-auto py-10 max-w-6xl">
        <h2 class="mb-4 font-bold text-4xl heading-font">Project Road Map</h2>

        <!-- Roadmap List -->
        <section class="space-y-6">

            <!-- ✅ Item 1 – User Authentication -->
            <div class="bg-white shadow p-6 border-green-600 border-l-4 rounded-lg">
                <h3 class="font-bold text-2xl heading-font">User Authentication (Login + Signup)</h3>
                <p class="text-gray-700">Implement login and signup with secure password handling.</p>

                <!-- Status -->
                <span class="inline-block bg-green-100 mt-3 px-3 py-1 rounded-full font-semibold text-green-700 text-sm">
                    ✅ Completed
                </span>

                <!-- Priority -->
                <span class="inline-block bg-red-100 mt-2 px-3 py-1 rounded-full font-semibold text-red-700 text-sm">
                    High Priority
                </span>
            </div>

            <!-- 🟡 Item 2 – Pizza Catalog -->
            <div class="bg-white shadow p-6 border-gray-800 border-l-4 rounded-lg">
                <h3 class="font-bold text-2xl heading-font">Pizza Catalog</h3>
                <p class="text-gray-700">Display pizzas with images, descriptions, and prices.</p>

                <span class="inline-block bg-gray-200 mt-3 px-3 py-1 rounded-full font-semibold text-gray-800 text-sm">
                    Planned
                </span>
                <span class="inline-block bg-red-100 mt-2 px-3 py-1 rounded-full font-semibold text-red-700 text-sm">
                    High Priority
                </span>
            </div>

            <!-- 🟥 Item 3 – Ordering System -->
            <div class="bg-white shadow p-6 border-gray-800 border-l-4 rounded-lg">
                <h3 class="font-bold text-2xl heading-font">Ordering System</h3>
                <p class="text-gray-700">Allow users to place and track pizza orders.</p>

                <span class="inline-block bg-gray-200 mt-3 px-3 py-1 rounded-full font-semibold text-gray-800 text-sm">
                    Planned
                </span>
                <span class="inline-block bg-red-100 mt-2 px-3 py-1 rounded-full font-semibold text-red-700 text-sm">
                    High Priority
                </span>
            </div>

            <!-- 🟡 Item 4 – Admin Dashboard -->
            <div class="bg-white shadow p-6 border-orange-600 border-l-4 rounded-lg">
                <h3 class="font-bold text-2xl heading-font">Admin Dashboard</h3>
                <p class="text-gray-700">Manage menu items, orders, and users with analytics.</p>

                <span class="inline-block bg-orange-100 mt-3 px-3 py-1 rounded-full font-semibold text-orange-700 text-sm">
                    In Progress
                </span>
                <span class="inline-block bg-yellow-100 mt-2 px-3 py-1 rounded-full font-semibold text-yellow-700 text-sm">
                    Medium Priority
                </span>
            </div>

            <!-- 🟡 Item 5 – Moodboard -->
            <div class="bg-white shadow p-6 border-orange-600 border-l-4 rounded-lg">
                <h3 class="font-bold text-2xl heading-font">Moodboard</h3>
                <p class="text-gray-700">Design inspiration and theme references for PizzaHot.</p>

                <span class="inline-block bg-orange-100 mt-3 px-3 py-1 rounded-full font-semibold text-orange-700 text-sm">
                    In Progress
                </span>
                <span class="inline-block bg-yellow-100 mt-2 px-3 py-1 rounded-full font-semibold text-yellow-700 text-sm">
                    Medium Priority
                </span>
            </div>

        </section>
    </main>

    <!-- Footer -->
    <?= view('components/footer') ?>

</body>

</html>