<?= view('components/head', ['title' => 'Moodboard Page']) ?>
<?= view('components/header') ?>

<main class="space-y-12 mx-auto py-10 max-w-6xl">

    <!-- Title -->
    <h2 class="font-bold text-4xl heading-font">Mood Board</h2>

    <!-- Color Palette Section -->
    <section>
        <h3 class="mb-4 font-semibold text-2xl heading-font">Color Palette</h3>
        <div class="gap-6 grid grid-cols-2 sm:grid-cols-8"> <!-- 8 cols to fit new colors -->

            <div class="text-center">
                <div class="bg-black mx-auto rounded-lg w-24 h-24"></div>
                <p class="mt-2 text-sm">Black<br>#000000</p>
            </div>
            <div class="text-center">
                <div class="bg-gray-800 mx-auto rounded-lg w-24 h-24"></div>
                <p class="mt-2 text-sm">Dark Gray<br>#1F2937</p>
            </div>
            <div class="text-center">
                <div class="bg-red-700 mx-auto rounded-lg w-24 h-24"></div>
                <p class="mt-2 text-sm">Dark Red<br>#B91C1C</p>
            </div>
            <div class="text-center">
                <div class="bg-[#D22B2B] mx-auto rounded-lg w-24 h-24"></div>
                <p class="mt-2 text-sm">Medium Red<br>#D22B2B</p>
            </div>
            <div class="text-center">
                <div class="bg-red-500 mx-auto rounded-lg w-24 h-24"></div>
                <p class="mt-2 text-sm">Red<br>#EF4444</p>
            </div>
            <div class="text-center">
                <div class="bg-white mx-auto border rounded-lg w-24 h-24"></div>
                <p class="mt-2 text-sm">White<br>#FFFFFF</p>
            </div>

            <!-- New Colors -->
            <div class="text-center">
                <div class="bg-[#FFB347] mx-auto rounded-lg w-24 h-24"></div>
                <p class="mt-2 text-sm">Orange-Yellow<br>#FFB347</p>
            </div>
            <div class="text-center">
                <div class="bg-yellow-800 mx-auto rounded-lg w-24 h-24"></div>
                <p class="mt-2 text-sm">Brown<br>#78350F</p>
            </div>

            <!-- Slight Dirty White -->
            <div class="text-center">
                <div class="bg-[#F5F5F0] mx-auto border rounded-lg w-24 h-24"></div>
                <p class="mt-2 text-sm">Dirty White<br>#F5F5F0</p>
            </div>

        </div>
    </section>

    <!-- Typography Section -->
    <section>
        <h3 class="mb-4 font-semibold text-2xl heading-font">Typography</h3>

        <!-- Heading example -->
        <p class="font-bold text-3xl" style="font-family: 'Quicksand', sans-serif;">
            Quicksand — Heading Example
        </p>

        <!-- Body example -->
        <p class="mt-2 text-gray-700" style="font-family: 'Quicksand', sans-serif;">
            Quicksand — Body text example with readable copy.
        </p>
    </section>


    <!-- Buttons Section -->
    <section>
        <h3 class="mb-4 font-semibold text-2xl heading-font">Buttons</h3>

        <div class="gap-8 grid grid-cols-1 md:grid-cols-2">

            <!-- 🌞 Light Mode Column -->
            <div>
                <h4 class="mb-2 font-bold text-lg heading-font">Light Mode</h4>
                <div class="flex flex-wrap gap-3">
                    <?= view('components/buttons/primary') ?>
                    <?= view('components/buttons/secondary') ?>
                    <?= view('components/buttons/border') ?>
                    <?= view('components/buttons/disabled') ?>
                </div>
            </div>

            <!-- 🌚 Dark Mode Column -->
            <div class="bg-gray-900 p-4 rounded-lg">
                <h4 class="mb-2 font-bold text-white text-lg heading-font">Dark Mode</h4>
                <div class="flex flex-wrap gap-3">
                    <?= view('components/buttons/primary') ?>
                    <?= view('components/buttons/secondary') ?>
                    <?= view('components/buttons/border') ?>
                    <?= view('components/buttons/disabled') ?>
                </div>
            </div>

        </div>
    </section>



    <!-- Cards Section -->
    <section>
        <h3 class="mb-4 font-semibold text-2xl heading-font">Card Samples</h3>

        <div class="gap-6 grid grid-cols-1 md:grid-cols-3">
            <?= view('components/cards/card-style1') ?>
            <?= view('components/cards/card-style2') ?>
            <?= view('components/cards/card-style3') ?>
        </div>
    </section>


    <!-- Logo Section -->
    <section class="py-10 text-center">
        <h2 class="mb-6 font-bold text-4xl heading-font">Logo Variations</h2>

        <div class="flex justify-center gap-10">
            <!-- Square Logo -->
            <div class="text-center">
                <img src="/assets/img/logo.png" alt="Square Logo" class="shadow mx-auto border rounded-lg w-40 h-40 object-contain">
                <p class="mt-2 text-gray-700">Square Logo</p>
            </div>

            <!-- Circle Logo -->
            <div class="text-center">
                <img src="/assets/img/logo.png" alt="Circle Logo" class="shadow mx-auto rounded-full w-40 h-40 object-contain">
                <p class="mt-2 text-gray-700">Circle Logo</p>
            </div>
        </div>
    </section>

</main>

<?= view('components/footer') ?>