<?php
// Component: components/head.php
// Data contract:
// $title: string
?>

<head>
    <meta charset="UTF-8">
    <title> PizzaHot | <?= $title ?? 'Login' ?> </title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font: Quicksand -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Use Quicksand for everything */
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        div {
            font-family: 'Quicksand', sans-serif;
        }

        /* Pizza background helper */
        .pizza-bg {
            position: absolute;
            font-size: 3rem;
            opacity: 0.12;
        }

        /* Background color */
        body {
            background-color: #F5F5F0;
        }
    </style>
</head>