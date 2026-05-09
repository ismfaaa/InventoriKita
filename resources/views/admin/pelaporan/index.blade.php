<x-app-layout>
    @include('layouts.sidebar')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Riwayat Laporan Kerusakan') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Laporan Saya</h3>
                <p class="text-sm text-gray-500">Pantau status penanganan kerusakan aset yang Anda laporkan secara real-time.</p>
            </div>
            
            <a href="{{ route('pengguna.lapor.create') }}" 
               class="bg-[#588133] hover:bg-[#466629] text-white px-6 py-3 rounded-2xl font-bold text-sm transition-all shadow-lg shadow-[#588133]/20 flex items-center gap-2 group">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Laporan Baru
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-[30px] border border-[#e5edda]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#f8faf2] text-[#588133] text-[11px] uppercase tracking-widest">
                            <th class="p-5 font-black">Aset & Lokasi</th>
                            <th class="p-5 font-black">Tingkat Kerusakan</th>
                            <th class="p-5 font-black">Tanggal Lapor</th>
                            <th class="p-5 font-black">Bukti</th>
                            <th class="p-5 font-black text-center">Status</th>
                            <th class="p-5 font-black text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($pelaporans as $laporan)
                        <tr class="hover:bg-[#fcfdfa] transition-colors">
                            <td class="p-5">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-gray-700">{{ $laporan->aset->nama_aset ?? 'Aset Tidak Diketahui' }}</span>
                                    <span class="text-[10px] text-gray-400 font-medium italic">{{ $laporan->lokasi }}</span>
                                </div>
                            </td>

                            <td class="p-5">
                                @php
                                    $colorClass = [
                                        'berat' => 'bg-red-50 text-red-600 border-red-100',
                                        'sedang' => 'bg-orange-50 text-orange-600 border-orange-100',
                                        'ringan' => 'bg-blue-50 text-blue-600 border-blue-100'
                                    ][$laporan->tingkat_kerusakan] ?? 'bg-gray-50 text-gray-600';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase border {{ $colorClass }}">
                                    {{ $laporan->tingkat_kerusakan }}
                                </span>
                            </td>

                            <td class="p-5 text-sm text-gray-500 font-medium">
                                {{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d M Y') }}
                            </td>

                            <td class="p-5">
                                @if($laporan->foto)
                                    <div class="w-10 h-10 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                        <img src="{{ asset('storage/' . $laporan->foto) }}" class="w-full h-full object-cover shadow-sm" alt="Bukti Kerusakan">
                                    </div>
                                @else
                                    <span class="text-[10px] text-gray-300 italic">No Photo</span>
                                @endif
                            </td>
                            <td class="p-5 text-center">
                                @php
                                    $statusColor = [
                                        'diproses' => 'bg-yellow-50 text-yellow-600',
                                        'verifikasi' => 'bg-blue-50 text-blue-600',
                                        'feedback' => 'bg-orange-50 text-orange-600',
                                        'selesai' => 'bg-green-50 text-green-600'
                                    ][$laporan->status_pelaporan] ?? 'bg-gray-50 text-gray-600';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusColor }}">
                                    {{ $laporan->status_pelaporan }}
                                </span>
                            </td>                           

                            

                            {{-- Kolom Aksi (Dropdown Update Status) --}}
                            <td class="p-5">
                                <form action="{{ route('admin.pelaporan.updateStatus', $laporan->id) }}" method="POST" class="flex items-center gap-2 m-0" onsubmit="konfirmasiUpdate(event, this)">
                                    @csrf 
                                    @method('PATCH')
                                    
                                    <select name="status_pelaporan" class="text-xs border-gray-200 text-gray-600 rounded-lg shadow-sm focus:border-[#588133] focus:ring-[#588133] py-1.5 pl-3 pr-8 cursor-pointer"
                                    {{ $laporan->status_pelaporan == 'selesai' ? 'disabled' : '' }}>
                                        <option value="diproses" {{ $laporan->status_pelaporan == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="verifikasi" {{ $laporan->status_pelaporan == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                        <option value="feedback" {{ $laporan->status_pelaporan == 'feedback' ? 'selected' : '' }}>Feedback</option>
                                        <option value="selesai" {{ $laporan->status_pelaporan == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>

                                    <button type="submit" class="bg-[#588133] hover:bg-[#466629] text-white px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-tight transition-colors shadow-sm flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Update
                                    </button>
                                </form>
                            </td>
                                                                       
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="bg-[#f8faf2] p-4 rounded-full mb-4">
                                        <svg class="w-12 h-12 text-[#588133] opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-400 italic text-sm">Belum ada laporan kerusakan yang dikirim.</p>
                                    <a href="{{ route('pengguna.lapor.create') }}" class="mt-4 text-[#588133] font-bold text-xs hover:underline">Buat Laporan Sekarang &rarr;</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Satu script untuk semua pesan sukses --}}
    @if(session('status_berhasil') || session('success'))
    
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('status_berhasil') ?? session('success') }}",
            confirmButtonColor: '#588133',
            customClass: {
                popup: 'rounded-[30px]',
                confirmButton: 'rounded-xl px-6 py-2'
            }
        });
    </script>
    @endif

    <script>
    function konfirmasiUpdate(event, formElement) {
        event.preventDefault(); // Menahan form agar tidak langsung terkirim

        Swal.fire({
            title: 'Konfirmasi Perubahan',
            text: "Apakah Anda yakin ingin memperbarui status laporan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#588133',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Perbarui!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-[30px]',
                confirmButton: 'rounded-xl px-4 py-2',
                cancelButton: 'rounded-xl px-4 py-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                formElement.submit(); 
            }
        });
    }
</script>   
</x-app-layout>