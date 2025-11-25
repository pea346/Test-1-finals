<?php
// Default variant if not provided
$variant = $variant ?? 'red';

// Define border and text colors for cozy vibe
$variants = [
    'red'    => 'border-red-500 text-red-600 dark:text-red-400',
    'orange' => 'border-[#FFB347] text-[#FFB347] dark:text-[#FFB347]/80',
    'brown'  => 'border-[#A0522D] text-[#A0522D] dark:text-[#A0522D]/80',
    'yellow' => 'border-[#FFD580] text-[#FFD580] dark:text-[#FFD580]/80',
];

// Pick the variant or fallback to red
$color = $variants[$variant] ?? $variants['red'];
?>

<div class="bg-gray-100 dark:bg-gray-800 shadow-md p-6 border-l-4 rounded-lg <?= $color ?>">
    <blockquote class="italic">
        "<?= esc($quote ?? 'Your testimonial here…') ?>"
    </blockquote>
    <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm text-right">
        — <?= esc($author ?? 'Anonymous') ?>
    </p>
</div>