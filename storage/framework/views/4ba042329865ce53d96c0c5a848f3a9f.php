<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <div class="container mx-auto py-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Tambah Mahasiswa</h1>

    <form action="<?php echo e(route('mahasiswa.store')); ?>" method="POST" class="bg-white p-8 rounded-lg shadow-lg space-y-4 max-w-2xl mx-auto">
      <?php echo csrf_field(); ?>
      <div>
        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
        <input type="text" name="nim" id="nim" value="<?php echo e(old('nim')); ?>" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <div>
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="nama" id="nama" value="<?php echo e(old('nama')); ?>" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <div>
        <label for="prodi" class="block text-sm font-medium text-gray-700">Prodi</label>
        <input type="text" name="prodi" id="prodi" value="<?php echo e(old('prodi')); ?>" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-md font-semibold hover:from-blue-500 hover:to-blue-700 transition">
        Simpan
      </button>

      <div class="pt-3">
        <a href="<?php echo e(route('mahasiswa.index')); ?>" class="inline-block w-full text-center bg-gradient-to-r from-red-400 to-red-600 text-white px-4 py-2 rounded-md font-semibold hover:from-red-500 hover:to-red-700 transition">
          Kembali
        </a>
      </div>
    </form>

    <?php if($errors->any()): ?>
      <div class="mt-6 text-red-600 text-center">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
      <div class="mt-8 text-center">
        <p class="text-green-600 text-2xl font-bold flex items-center justify-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-green-600">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
          </svg>
          <?php echo e(session('success')); ?>

        </p>
      </div>
    <?php endif; ?>
  </div>

  <p class="mt-8 text-center text-sm text-gray-500">Anak Agung Gede Wisnu Mahadhiva - 2405551106</p>

</body>
</html>
<?php /**PATH C:\projectlaravel\kampus-laravel\resources\views/mahasiswa/create.blade.php ENDPATH**/ ?>