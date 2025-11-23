<footer class="mt-10 py-10 text-white" style="background: linear-gradient(180deg, #FFB347 0%, #D97706 100%);">
    <div class="gap-8 grid md:grid-cols-3 mx-auto px-6 max-w-7xl md:text-left text-center">

        <!-- 🍕 Brand Section -->
        <div class="flex flex-col items-center md:items-start space-y-3">
            <div class="flex items-center space-x-3">
                <img src="/assets/img/logo.png"
                    alt="PizzaHot Logo"
                    class="shadow rounded-full w-14 h-14 object-cover">
                <h2 class="font-bold text-2xl heading-font" style="color:#D22B2B;">PizzaHot</h2>
            </div>

            <p class="max-w-xs text-sm" style="color:#78350F;">
                Bringing the hottest, freshest, and most delicious pizzas right to your doorstep — fast and flavorful, every time.
            </p>
        </div>

        <!-- 🧭 Quick Links -->
        <div>
            <h3 class="mb-5 font-semibold text-xl heading-font" style="color:#78350F;">Quick Links</h3>
            <nav class="flex flex-col space-y-2">
                <a href="/moodboard" class="hover:opacity-50 transition" style="color:#F5F5F0;">Mood Board</a>
                <a href="/roadmap" class="hover:opacity-50 transition" style="color:#F5F5F0;">Road Map</a>
            </nav>
        </div>

        <!-- 🌐 Social Links -->
        <div class="space-y-4">
            <h3 class="mb-5 font-semibold text-xl heading-font" style="color:#78350F;">Follow Us</h3>

            <div class="flex justify-center md:justify-start space-x-5">
                <a href="#" class="flex items-center space-x-2 hover:opacity-50 transition" style="color:#F5F5F0;">
                    <i class="fab fa-facebook-f"></i>
                    <span>Facebook</span>
                </a>

                <a href="#" class="flex items-center space-x-2 hover:opacity-50 transition" style="color:#F5F5F0;">
                    <i class="fab fa-instagram"></i>
                    <span>Instagram</span>
                </a>
            </div>

            <p class="mt-4 text-sm" style="color:#9CA3AF;">
                &copy; <?= date("Y") ?> PizzaHot. All rights reserved.
            </p>
        </div>

    </div>
</footer>