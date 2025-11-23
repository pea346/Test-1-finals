<?php
// Default variant if not provided
$variant = $variant ?? 'red';

// Define accent color styles for cozy vibe
$variants = [
    'red'    => 'border-t-4 border-[#EF4444] text-[#EF4444] hover:shadow-[#EF4444]/40',
    'orange' => 'border-t-4 border-[#FFB347] text-[#FFB347] hover:shadow-[#FFB347]/40',
    'brown'  => 'border-t-4 border-[#A0522D] text-[#A0522D] hover:shadow-[#A0522D]/40',
    'yellow' => 'border-t-4 border-[#FFD580] text-[#FFD580] hover:shadow-[#FFD580]/40',
];

// Pick color style or fallback to red
$color = $variants[$variant] ?? $variants['red'];
?>

<div class="bg-white dark:bg-gray-800 shadow hover:shadow-lg p-6 border border-gray-200 dark:border-gray-700 rounded-2xl transition <?= $color ?>">
    <h4 class="mb-2 font-bold text-2xl heading-font"><?= esc($title ?? 'Default Title') ?></h4>
    <p class="mb-4 text-gray-700 dark:text-gray-300"><?= esc($description ?? 'Default description text.') ?></p>
    <a href="#" class="font-semibold hover:underline 
        <?= $variant === 'red' ? 'text-[#EF4444]' : ($variant === 'orange' ? 'text-[#FFB347]' : ($variant === 'brown' ? 'text-[#A0522D]' : 'text-[#FFD580]')) ?>
    ">
        Read more
    </a>
</div>