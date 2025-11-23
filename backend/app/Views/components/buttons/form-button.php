<?php
// app/Views/components/form-button.php
// Reusable submit button for forms
// Expected variable: $label (string) => text on the button
?>

<button type="submit" class="bg-red-600 hover:bg-red-700 shadow px-4 py-2 rounded-lg w-full font-semibold text-white transition">
    <?= $label ?>
</button>