<x-app-layout>
    @include('layouts.sidebar')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Ekspor Data') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-800">Ekspor Data Sistem</h3>
            <p class="text-sm text-gray-500">Pilih jenis data dan filter yang diinginkan untuk diekspor.</p>
        </div>

        <div class="bg-white p-6 rounded-[30px] shadow-sm border border-gray-100">
            <form id="exportForm" method="GET" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Data</label>
                        <select name="jenis_data" id="jenisData" onchange="updateForm()" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#588133] focus:ring-[#588133]">
                            <option value="pelaporan">Laporan Kerusakan</option>
                            <option value="pengadaan">Usulan Pengadaan</option>
                            <option value="aset">Data Aset</option>
                        </select>
                    </div>

                    <div id="statusField">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#588133] focus:ring-[#588133]">
                            <option value="">Semua Status</option>
                            <option value="diproses">Diproses</option>
                            <option value="verifikasi">Verifikasi</option>
                            <option value="feedback">Feedback</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>

                    <div id="kerusakanField">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat Kerusakan</label>
                        <select name="tingkat_kerusakan" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#588133] focus:ring-[#588133]">
                            <option value="">Semua Tingkat</option>
                            <option value="ringan">Ringan</option>
                            <option value="sedang">Sedang</option>
                            <option value="berat">Berat</option>
                        </select>
                    </div>

                    <div id="kategoriField" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="kategori_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#588133] focus:ring-[#588133]">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="button" id="pdfBtn" onclick="exportData('pdf')" class="bg-[#588133] hover:bg-[#466629] text-white px-6 py-3 rounded-xl font-bold transition-all">
                        Ekspor PDF
                    </button>
                    <button type="button" id="excelBtn" onclick="exportData('excel')" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-bold transition-all">
                        Ekspor Excel
                    </button>
                    <button type="button" id="csvBtn" onclick="exportData('csv')" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl font-bold transition-all">
                        Ekspor CSV
                    </button>
                </div>
            </form>
        </div>

        <script>
            function updateForm() {
                const jenisData = document.getElementById('jenisData').value;
                const kerusakanField = document.getElementById('kerusakanField');
                const statusField = document.getElementById('statusField');
                const kategoriField = document.getElementById('kategoriField');

                if (jenisData === 'pelaporan') {
                    kerusakanField.style.display = 'block';
                    statusField.style.display = 'block';
                    kategoriField.style.display = 'none';
                } else if (jenisData === 'pengadaan') {
                    kerusakanField.style.display = 'none';
                    statusField.style.display = 'block';
                    kategoriField.style.display = 'none';
                } else if (jenisData === 'aset') {
                    kerusakanField.style.display = 'none';
                    statusField.style.display = 'none';
                    kategoriField.style.display = 'block';
                }
            }

            function exportData(format) {
                const jenisData = document.getElementById('jenisData').value;
                const status = document.querySelector('select[name="status"]').value;
                const tingkatKerusakan = document.querySelector('select[name="tingkat_kerusakan"]').value;
                const kategoriId = document.querySelector('select[name="kategori_id"]').value;

                // Buat URL dengan query parameters
                let url = '';
                const params = new URLSearchParams();

                if (status) params.append('status', status);
                if (tingkatKerusakan) params.append('tingkat_kerusakan', tingkatKerusakan);
                if (kategoriId) params.append('kategori_id', kategoriId);

                if (jenisData === 'pelaporan') {
                    url = `/export/pelaporan/${format}`;
                } else if (jenisData === 'pengadaan') {
                    url = `/export/pengadaan/${format}`;
                } else if (jenisData === 'aset') {
                    url = `/export/aset/${format}`;
                }

                // Redirect dengan query string
                window.location.href = url + (params.toString() ? '?' + params.toString() : '');
            }

            // Initialize
            updateForm();
        </script>
    </div>
</x-app-layout>