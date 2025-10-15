<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Konfirmasi Hapus Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-xl rounded-xl p-8 max-w-md w-full">
    <h2 class="text-xl font-bold text-center mb-4 text-red-600">Konfirmasi Hapus</h2>
    <p class="text-gray-700 mb-6 text-center">Yakin ingin menghapus data berikut?</p>

    <div class="mb-6">
      <table class="w-full text-left border border-gray-200 rounded-md">
        <tr>
          <th class="p-2 bg-gray-50 border-b">ID</th>
          <td class="p-2 border-b">{{ $mahasiswa->id }}</td>
        </tr>
        <tr>
          <th class="p-2 bg-gray-50 border-b">NIM</th>
          <td class="p-2 border-b">{{ $mahasiswa->nim }}</td>
        </tr>
        <tr>
          <th class="p-2 bg-gray-50 border-b">Nama</th>
          <td class="p-2 border-b">{{ $mahasiswa->nama }}</td>
        </tr>
        <tr>
          <th class="p-2 bg-gray-50">Prodi</th>
          <td class="p-2">{{ $mahasiswa->prodi }}</td>
        </tr>
      </table>
    </div>

    <form method="POST" action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" class="flex justify-center gap-4">
      @csrf
      @method('DELETE')

      <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
        Yakin
      </button>

      <a href="{{ route('mahasiswa.index') }}" 
         class="bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-lg hover:from-blue-500 hover:to-blue-700 transition">
        Batal
      </a>
    </form>

    <p class="mt-8 text-center text-sm text-gray-500">
      Anak Agung Gede Wisnu Mahadhiva - 2405551106
    </p>
  </div>

</body>
</html>
