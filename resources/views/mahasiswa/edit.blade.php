<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <div class="container mx-auto py-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Edit Mahasiswa</h1>

    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg space-y-4 max-w-2xl mx-auto">
      @csrf
      @method('PUT')

      <div>
        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
        <input type="text" name="nim" id="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <div>
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $mahasiswa->nama) }}" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <div>
        <label for="prodi" class="block text-sm font-medium text-gray-700">Prodi</label>
        <input type="text" name="prodi" id="prodi" value="{{ old('prodi', $mahasiswa->prodi) }}" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-md font-semibold hover:from-blue-500 hover:to-blue-700 transition">
        Update
      </button>

      <div class="pt-3">
        <a href="{{ route('mahasiswa.index') }}" class="inline-block w-full text-center bg-gradient-to-r from-red-400 to-red-600 text-white px-4 py-2 rounded-md font-semibold hover:from-red-500 hover:to-red-700 transition">
          Kembali
        </a>
      </div>
    </form>

    @if ($errors->any())
      <div class="mt-6 text-red-600 text-center">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>

  <p class="mt-8 text-center text-sm text-gray-500 cursor-pointer"
      onclick="window.open('https://www.youtube.com/watch?v=dQw4w9WgXcQ', '_blank')">
      Anak Agung Gede Wisnu Mahadhiva - 2405551106 </p>

</body>
</html>
