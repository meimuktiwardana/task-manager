<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Proyek</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        .container {
            text-align: center;
            padding: 100px 20px;
        }
        h1 {
            font-size: 3rem;
            color: #1f2937;
        }
        p {
            font-size: 1.25rem;
            color: #4b5563;
            margin-top: 20px;
            margin-bottom: 40px;
        }
        .button {
            background-color: #3b82f6;
            color: white;
            padding: 15px 30px;
            font-size: 1rem;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Manajemen Proyek</h1>
        <p>Kelola proyek dan tugas dengan lebih mudah dan terorganisir.</p>
        <a href="{{ url('/admin/login') }}" class="button">Login ke Admin Panel</a>
    </div>
</body>
</html>
