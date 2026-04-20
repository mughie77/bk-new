<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-xl">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-slate-800">Aplikasi BK</h2>
            <p class="mt-2 text-slate-600">Silakan login untuk melanjutkan</p>
        </div>

        <?php if(isset($_SESSION['flash'])) : ?>
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <?= $_SESSION['flash']['pesan']; ?>
                <?php unset($_SESSION['flash']); ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASEURL; ?>/auth/login" method="POST" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-slate-700">NIP / Username</label>
                <input type="text" name="username" id="username" required
                    class="w-full px-4 py-2 mt-1 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 mt-1 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit"
                class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">
                Login
            </button>
        </form>

        <div class="text-center text-xs text-slate-500 mt-4">
            &copy; <?= date('Y'); ?> Aplikasi Bimbingan dan Konseling Sekolah
        </div>
    </div>
</body>
</html>
