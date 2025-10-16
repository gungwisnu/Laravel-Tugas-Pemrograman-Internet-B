<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .sort-icons {
      display: flex;
      align-items: center;
      gap: 2px;
      cursor: pointer;
    }
    .arrow {
      font-size: 1rem;
      opacity: 0.4;
      font-weight: 400;
      color: white;
      transition: all 0.3s ease;
    }
    .arrow.active {
      opacity: 1;
      font-weight: 700;
      transform: scale(1.1);
    }
    .header-active {
      font-weight: 700;
      color: white;
    }
  </style>
</head>

<body class="bg-gray-100 font-sans">

  <div class="container mx-auto py-4 flex items-center justify-between">
    <a href="{{ route('mahasiswa.create') }}" 
       class="bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all duration-300">
      Tambah Mahasiswa
    </a>

    <div class="flex items-center gap-3 relative">
      <button id="btnCari" 
              class="bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all duration-300">
        Cari Mahasiswa
      </button>

      <div id="searchBox" 
           class="absolute right-full mr-3 transform translate-x-4 opacity-0 w-0 overflow-hidden transition-all duration-500 ease-in-out">
        <input type="text" id="keyword" placeholder="Ketik nama/NIM..." 
               class="p-2 w-80 border border-gray-300 rounded-lg focus:outline-none focus:ring-0">
      </div>
    </div>
  </div>

  @if (session('success'))
    <div id="successMessage" 
         class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-300 text-green-700 px-6 py-3 rounded-lg shadow-md opacity-0 -translate-y-4 transition-all duration-500 ease-in-out">
      {!! session('success') !!}
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const msg = document.getElementById("successMessage");
        if (msg) {
          setTimeout(() => msg.classList.replace("opacity-0", "opacity-100"), 100);
          setTimeout(() => msg.classList.replace("opacity-100", "opacity-0"), 5000);
          setTimeout(() => msg.remove(), 5500);
        }
      });
    </script>
  @endif

  <div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-center mb-6">Daftar Mahasiswa</h2>

    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
      <thead class="bg-gradient-to-r from-blue-400 to-blue-600 text-white">
        <tr>
          @php
            $cols = ['id' => 'ID', 'nim' => 'NIM', 'nama' => 'Nama', 'prodi' => 'Prodi'];
          @endphp

          @foreach ($cols as $key => $label)
            @php $isActive = $sort == $key; @endphp
            <th class="py-3 px-6 text-left">
              <div class="flex items-center gap-2">
                <span class="{{ $isActive ? 'header-active' : '' }}">{{ $label }}</span>
                <div class="sort-icons">
                  <a href="{{ $isActive && $order == 'asc' 
                    ? route('mahasiswa.index') 
                    : route('mahasiswa.index', ['sort' => $key, 'order' => 'asc']) }}">
                    <span class="arrow {{ $isActive && $order == 'asc' ? 'active' : '' }}">▲</span>
                  </a>
                  <a href="{{ $isActive && $order == 'desc' 
                    ? route('mahasiswa.index') 
                    : route('mahasiswa.index', ['sort' => $key, 'order' => 'desc']) }}">
                    <span class="arrow {{ $isActive && $order == 'desc' ? 'active' : '' }}">▼</span>
                  </a>
                </div>
              </div>
            </th>
          @endforeach

          <th class="py-3 px-6 text-left">Aksi</th>
        </tr>
      </thead>

      <tbody id="hasil">
        @foreach ($mahasiswas as $m)
          <tr class="border-b hover:bg-gray-100 transition-colors duration-300">
            <td class="py-3 px-6">{{ $m->id }}</td>
            <td class="py-3 px-6">{{ $m->nim }}</td>
            <td class="py-3 px-6">{{ $m->nama }}</td>
            <td class="py-3 px-6">{{ $m->prodi }}</td>
            <td class="py-3 px-6 flex gap-2">
              <a href="{{ route('mahasiswa.edit', $m->id) }}" class="text-blue-500 hover:text-blue-700 transition">Edit</a> | 
              <a href="{{ route('mahasiswa.confirmDelete', $m->id) }}" class="text-red-500 hover:text-red-700 transition">Hapus</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <p class="mt-8 text-center text-sm text-gray-500 cursor-pointer"
      onclick="window.open('https://www.youtube.com/watch?v=dQw4w9WgXcQ', '_blank')">
      Anak Agung Gede Wisnu Mahadhiva - 2405551106 
    </p>
  </div>

  <script>
    // toggle cari
    const btnCari = document.getElementById("btnCari");
    const searchBox = document.getElementById("searchBox");
    let terbuka = false;

    btnCari.addEventListener("click", () => {
      terbuka = !terbuka;
      searchBox.classList.toggle("w-0");
      searchBox.classList.toggle("opacity-0");
      searchBox.classList.toggle("translate-x-4");
      searchBox.classList.toggle("w-80");
      searchBox.classList.toggle("opacity-100");
      searchBox.classList.toggle("translate-x-0");
    });

    // live search
    const keywordInput = document.getElementById("keyword");
    const hasil = document.getElementById("hasil");

    keywordInput.addEventListener("keyup", function() {
      const keyword = this.value;
      fetch(`/mahasiswa/search?keyword=${keyword}`)
        .then(response => response.json())
        .then(data => {
          hasil.innerHTML = "";
          data.forEach(m => {
            hasil.innerHTML += `
              <tr class="border-b hover:bg-gray-100 transition-colors duration-300">
                <td class="py-3 px-6">${m.id}</td>
                <td class="py-3 px-6">${m.nim}</td>
                <td class="py-3 px-6">${m.nama}</td>
                <td class="py-3 px-6">${m.prodi}</td>
                <td class="py-3 px-6 flex gap-2">
                  <a href="/mahasiswa/${m.id}/edit" class="text-blue-500 hover:text-blue-700">Edit</a> | 
                  <a href="/mahasiswa/${m.id}/confirm-delete" class="text-red-500 hover:text-red-700">Hapus</a>
                </td>
              </tr>
            `;
          });
        });
    });
  </script>

</body>
</html>
