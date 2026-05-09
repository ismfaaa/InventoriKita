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

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dari</label>
                        <input type="date" name="tanggal_dari" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#588133] focus:ring-[#588133]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#588133] focus:ring-[#588133]">
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" id="pdfBtn" class="bg-[#588133] hover:bg-[#466629] text-white px-6 py-3 rounded-xl font-bold transition-all">
                        Ekspor PDF
                    </button>
                    <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-bold transition-all" disabled>
                        Ekspor Excel (lagi dibuat ea)
                    </button>
                    <button type="button" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl font-bold transition-all" disabled>
                        Ekspor Word (lagi dibuat ea)
                    </button>
                </div>
            </form>
        </div>

        <script>
            function updateForm() {
                const jenisData = document.getElementById('jenisData').value;
                const form = document.getElementById('exportForm');
                const kerusakanField = document.getElementById('kerusakanField');
                const statusField = document.getElementById('statusField');

                if (jenisData === 'pelaporan') {
                    form.action = '{{ route("export.pelaporan.pdf") }}';
                    kerusakanField.style.display = 'block';
                    statusField.style.display = 'block';
                } else if (jenisData === 'pengadaan') {
                    form.action = '{{ route("export.pengadaan.pdf") }}';
                    kerusakanField.style.display = 'none';
                    statusField.style.display = 'block';
                } else if (jenisData === 'aset') {
                    form.action = '{{ route("export.aset.pdf") }}';
                    kerusakanField.style.display = 'none';
                    statusField.style.display = 'none';
                }
            }

            // Initialize
            updateForm();
        </script>
    </div>
</x-app-layout>