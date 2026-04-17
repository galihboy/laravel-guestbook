<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-4xl mx-auto space-y-8">
        
        <!-- Header -->
        <div class="text-center space-y-2">
            <h1 class="text-4xl font-bold text-gray-800">📖 Buku Tamu</h1>
            <p class="text-gray-500">Silakan tinggalkan pesan Anda di bawah ini.</p>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Form Input -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Tambah Pesan Baru</h2>
            <form action="" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email (Opsional)</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label for="pesan" class="block text-sm font-medium text-gray-700 mb-1">Pesan <span class="text-red-500">*</span></label>
                    <textarea id="pesan" name="pesan" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('pesan') }}</textarea>
                    @error('pesan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300">
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>

        <!-- Daftar Pesan -->
        <div class="space-y-4">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Pesan Masuk ({{ $guestbooks->count() }})</h2>
            
            @forelse($guestbooks as $guest)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $guest->nama }}</h3>
                            @if($guest->email)
                                <p class="text-sm text-gray-500">{{ $guest->email }}</p>
                            @endif
                        </div>
                        <span class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded-full border border-gray-200">
                            {{ $guest->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="text-gray-700 mt-3 whitespace-pre-wrap">{{ $guest->pesan }}</p>
                </div>
            @empty
                <div class="bg-gray-50 p-8 text-center rounded-xl border border-dashed border-gray-300">
                    <p class="text-gray-500">Belum ada pesan. Jadilah yang pertama mengisi buku tamu!</p>
                </div>
            @endforelse
        </div>

    </div>
</body>
</html>
