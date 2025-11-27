<?= view('components/head', ['title' => 'Landing Page']) ?>
<?= view('components/header') ?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-[#B91C1C] to-[#EF4444] py-20 text-white">
    <div class="relative flex md:flex-row flex-col justify-center items-center gap-10 mx-auto px-6 max-w-6xl md:text-left text-center">

        <!-- Text Side -->
        <div class="z-10 md:w-1/2">
            <h2 class="mb-4 font-bold text-5xl heading-font">
                Welcome to <span class="text-[#FFB347]">PizzaHot</span>
            </h2>
            <p class="mb-6 text-[#78350F] text-lg">
                The hottest pizzas in town — baked fresh and delivered fast to your door.
            </p>
            <a href="login/" class="bg-[#D22B2B] hover:bg-[#B91C1C] shadow-md px-6 py-3 rounded-lg font-bold text-white transition">
                Order Now
            </a>
        </div>

        <!-- Image Side with Decorative Circles -->
        <div class="relative flex justify-center md:w-1/2">
            <!-- Brown circle behind pizza -->
            <div class="-top-10 -left-10 absolute bg-[#A0522D] opacity-40 rounded-full w-32 h-32"></div>
            <!-- Orange circle -->
            <div class="top-16 -right-12 absolute bg-[#FF8C00] opacity-30 rounded-full w-24 h-24"></div>
            <!-- Dirty white circle -->
            <div class="bottom-0 left-20 absolute bg-[#F5F5DC] opacity-25 rounded-full w-20 h-20"></div>

            <!-- Pizza Image -->
            <img src="/assets/img/NewPizza.jpg" alt="Hot Pizza" class="z-10 relative shadow-lg rounded-2xl w-80 md:w-[500px] hover:scale-105 transition-transform">
        </div>

    </div>
</section>


<!-- Features / Cards Section -->
<section class="mx-auto px-6 py-16 max-w-7xl">
    <h3 class="mb-12 text-[#1F2937] text-3xl text-center heading-font">Why Choose PizzaHot?</h3>
    <div class="gap-8 grid md:grid-cols-3">
        <?= view('components/cards/card-style2', [
            'title' => ' Quick & Hot',
            'description' => 'From oven to doorstep in minutes — piping hot and ready to devour.',
            'image' => '/img/fresh.png',
            'bgColor' => '#FFB347', // optional if your card supports bgColor
            'textColor' => '#1F2937'
        ]) ?>

        <?= view('components/cards/card-style2', [
            'title' => 'Fresh Ingredients',
            'description' => 'Every pizza is crafted with hand-picked vegetables, fresh meats, and the finest cheeses.',
            'link' => '#',
            'linkText' => 'Learn More'
        ]) ?>


        <?= view('components/cards/card-style2', [
            'title' => 'Pizza Made Easy',
            'description' => 'Order, pay, and enjoy — hassle-free pizza happiness delivered.',
            'link' => '#',
            'linkText' => 'Learn More'
        ]) ?>

    </div>
</section>

<!-- CTA Section -->
<?= view('components/cta') ?>

<!-- Footer -->
<?= view('components/footer') ?>