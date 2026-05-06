<x-app-layout>
    @include('layouts.sidebar')
    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <a href="{{ route('pengguna.peminjaman.index') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-[#588133] mb-6 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Riwayat
        </a>

        <div class="bg-white rounded-[40px] shadow-xl shadow-gray-100/50 p-8 md:p-12 border border-gray-50">
            <h3 class="text-2xl font-black text-gray-800 mb-2">Formulir Pinjaman</h3>
            <p class="text-sm text-gray-400 mb-10 italic">Lengkapi data untuk verifikasi 24 jam.</p>

            <form action="{{ route('pengguna.peminjaman.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama Pengguna --}}
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Nama Pengguna</label>
                        <input type="text" value="{{ Auth::user()->name }}" readonly class="w-full mt-2 border-none bg-gray-50 rounded-2xl py-4 px-6 text-sm text-gray-500 ring-1 ring-gray-100">
                    </div>

        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Nama Aset</label>
            <select name="aset_id" id="aset_select" required class="w-full mt-2 border-none bg-[#f1f5e9] rounded-2xl py-4 px-6 text-sm focus:ring-2 focus:ring-[#588133] transition-all">
                <option value="" disabled selected>-- Pilih Barang --</option>
                @foreach($asets as $aset)
                <option value="{{ $aset->id }}" data-kode="{{ $aset->kode_aset }}" 
                    data-kategori="{{ $aset->kategori->nama_kategori ?? 'Tanpa Kategori' }}"
                    {{ old('aset_id') == $aset->id ? 'selected' : '' }}> 
                    {{ $aset->nama_aset }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Kode Aset --}}
        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Kode Aset</label>
            <input type="text" id="kode_aset" placeholder="Terisi otomatis..." readonly class="w-full mt-2 border-none bg-[#f1f5e9] rounded-2xl py-4 px-6 text-sm focus:ring-2 focus:ring-[#588133] opacity-70 cursor-not-allowed">
        </div>

        {{-- Kategori --}}
        <div class="md:col-span-2">
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Kategori</label>
            <input type="text" id="kategori_aset" placeholder="Terisi otomatis..." readonly class="w-full mt-2 border-none bg-[#f1f5e9] rounded-2xl py-4 px-6 text-sm focus:ring-2 focus:ring-[#588133] opacity-70 cursor-not-allowed">
        </div>

        {{-- Tanggal --}}
        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Tgl Pengajuan</label>
            <input type="date" name="tanggal_pinjam" required class="w-full mt-2 border-none bg-[#f1f5e9] rounded-2xl py-4 px-6 text-sm focus:ring-2 focus:ring-[#588133]">
        </div>
        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Tgl Pengembalian</label>
            <input type="date" name="tanggal_kembali" required class="w-full mt-2 border-none bg-[#f1f5e9] rounded-2xl py-4 px-6 text-sm focus:ring-2 focus:ring-[#588133]">
        </div>

        {{-- Input Status (Default & Tersembunyi) --}}
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="status_peminjaman" value="pending">
        <input type="hidden" name="status_ketersediaan" value="tersedia">

        <div class="md:col-span-2">
            <div class="flex gap-4 mt-4">
                <div class="flex-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Status Pinjaman</label>
                    <input type="text" value="Pending" readonly class="w-full mt-2 border-none bg-gray-100 rounded-2xl py-3 px-6 text-xs text-gray-400 cursor-not-allowed">
                </div>
                <div class="flex-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Ketersediaan</label>
                    <input type="text" value="Tersedia" readonly class="w-full mt-2 border-none bg-gray-100 rounded-2xl py-3 px-6 text-xs text-gray-400 cursor-not-allowed">
                </div>
            </div>
        </div>
        <div class="pt-10">
        <button type="submit" class="w-full py-5 bg-[#588133] text-white font-bold rounded-[20px] shadow-lg shadow-[#588133]/30 hover:bg-[#466629] transition-all transform hover:-translate-y-1">
            Kirim Pengajuan
        </button>
        </div>
        </div>
    </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAset = document.getElementById('aset_select');
        const inputKode = document.getElementById('kode_aset');
        const inputKategori = document.getElementById('kategori_aset');

        selectAset.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const kode = selectedOption.getAttribute('data-kode');
            const kategori = selectedOption.getAttribute('data-kategori');
            inputKode.value = kode ? kode : '';
            inputKategori.value = kategori ? kategori : '';
        });
    });
</script>
</x-app-layout>