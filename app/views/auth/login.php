<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 via-blue-50 to-emerald-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-[1000px] grid md:grid-cols-2 bg-white rounded-3xl shadow-2xl overflow-hidden glass-card">
        <!-- Brand Section -->
        <div class="hidden md:flex flex-col justify-center p-12 bg-gradient-to-br from-blue-700 to-indigo-800 text-white relative">
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-8 backdrop-blur-md border border-white/30">
                    <i class="fas fa-heart-pulse text-3xl"></i>
                </div>
                <h1 class="text-4xl font-extrabold mb-4 leading-tight">Sistem Bimbingan <br>& Konseling</h1>
                <p class="text-blue-100 text-lg font-light leading-relaxed">Platform cerdas untuk mengelola perkembangan emosional dan akademik peserta didik secara terintegrasi.</p>

                <div class="mt-12 space-y-4">
                    <div class="flex items-center space-x-3 text-sm text-blue-200">
                        <i class="fas fa-check-circle text-emerald-400"></i>
                        <span>Keamanan Data Terjamin (PDO)</span>
                    </div>
                    <div class="flex items-center space-x-3 text-sm text-blue-200">
                        <i class="fas fa-check-circle text-emerald-400"></i>
                        <span>Visualisasi Sosiogram Canggih</span>
                    </div>
                    <div class="flex items-center space-x-3 text-sm text-blue-200">
                        <i class="fas fa-check-circle text-emerald-400"></i>
                        <span>Laporan PDF Profesional</span>
                    </div>
                </div>
            </div>
            <!-- Abstract background shapes -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-blue-400/20 rounded-full blur-3xl"></div>
        </div>

        <!-- Form Section -->
        <div class="p-8 md:p-12 lg:p-16 flex flex-col justify-center">
            <div class="mb-10 text-center md:text-left">
                <h2 class="text-3xl font-bold text-slate-800 mb-2">Selamat Datang</h2>
                <p class="text-slate-500">Silakan masukkan akun Anda untuk memulai</p>
            </div>

            <?php if(isset($_SESSION['flash'])) : ?>
                <div class="p-4 mb-6 text-sm text-red-600 bg-red-50 border border-red-100 rounded-2xl flex items-center" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= $_SESSION['flash']['pesan']; ?>
                    <?php unset($_SESSION['flash']); ?>
                </div>
            <?php endif; ?>

            <form action="<?= BASEURL; ?>/auth/login" method="POST" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-semibold text-slate-700 mb-2">NIP / Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="username" id="username" required placeholder="Masukkan NIP atau Username"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition duration-200 outline-none">
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" id="password" required placeholder="••••••••"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition duration-200 outline-none">
                    </div>
                </div>
                <button type="submit"
                    class="w-full py-4 px-6 text-white bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl font-bold shadow-lg shadow-blue-500/30 hover:scale-[1.02] active:scale-95 transition-all duration-200">
                    Masuk ke Sistem
                </button>
            </form>

            <div class="mt-12 text-center">
                <p class="text-xs text-slate-400 font-medium">Versi 2.0 • Build Stable</p>
                <p class="text-xs text-slate-400 font-medium"><?= $data['sekolah']['nama_sekolah'] ?? 'BK Online'; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
