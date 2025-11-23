<?php
// app/Views/components/login-card.php
// Reusable login/signup card

// Expected variables from caller:
// $title      => string, card title
// $action     => string, form action URL
// $inputs     => string, HTML for form fields
// $button     => string, the submit button HTML
// $linkText   => optional string, link text
// $linkHref   => optional string, link href
// $signupLink => optional string, link for signup page (alternative)
?>

<div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg w-full max-w-md space-y-6">
    <!-- Title -->
    <h2 class="text-2xl heading-font font-bold text-gray-800 dark:text-white text-center">
        <?= $title ?>
    </h2>

    <!-- Form -->
    <form action="<?= $action ?>" method="POST" class="space-y-4">
        <?= $inputs ?>
        <div>
            <?= $button ?>
        </div>
    </form>

    <!-- Optional Link -->
    <?php if(isset($linkText) && isset($linkHref)): ?>
        <p class="text-center text-gray-600 dark:text-gray-300 mt-4">
            <a href="<?= $linkHref ?>" class="text-red-600 hover:text-red-700 font-semibold">
                <?= $linkText ?>
            </a>
        </p>
    <?php elseif(isset($signupLink)): ?>
        <p class="text-center text-gray-600 dark:text-gray-300 mt-4">
            Don't have an account? 
            <a href="<?= $signupLink ?>" class="text-red-600 hover:text-red-700 font-semibold">Sign Up</a>
        </p>
    <?php endif; ?>
</div>
