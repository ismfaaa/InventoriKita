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
                            <th class="p-5 font-black">Feedback</th>
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
                                        'diproses'   => 'bg-amber-100 text-amber-700',
                                        'verifikasi' => 'bg-blue-100 text-blue-700',
                                        'feedback'   => 'bg-purple-100 text-purple-700',
                                        'selesai'    => 'bg-[#f1f5e9] text-[#588133]'
                                    ][$laporan->status_pelaporan] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span class="{{ $statusColor }} px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-tight">
                                    {{ $laporan->status_pelaporan }}
                                </span>
                            </td>
                            <td class="p-5">
                                @if($laporan->feedback)
                                    @php
                                        // Deskripsi default menyesuaikan jenis feedback
                                        $deskripsiFeedback = [
                                            'diperbaiki'  => 'Aset sedang dalam proses perbaikan oleh teknisi dan akan segera dikembalikan ke lokasi semula jika sudah selesai.',
                                            'diganti'     => 'Aset dinyatakan rusak berat dan akan diganti dengan unit yang baru',
                                            'dihilangkan' => 'Aset dihapus dari sistem inventaris karena hilang atau sudah tidak dapat diperbaiki/dimanfaatkan lagi.'
                                        ][$laporan->feedback] ?? 'Tindakan lanjutan sedang diproses.';
                                    @endphp

                                    <button type="button" 
                                            onclick="lihatDetailFeedback('{{ ucfirst($laporan->feedback) }}', '{{ $deskripsiFeedback }}')"
                                            class="flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 border border-gray-200 text-gray-600 rounded-xl text-[10px] font-black uppercase hover:bg-gray-100 transition-all">
                                        {{ $laporan->feedback }}
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </button>
                                @else
                                    <span class="text-[10px] text-gray-300 italic">- Belum ada -</span>
                                @endif
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

    <script>
        function lihatDetailFeedback(judul, deskripsi) {
            Swal.fire({
                icon: 'info',
                title: 'Tindak Lanjut: ' + judul,
                text: deskripsi,
                confirmButtonColor: '#588133',
                customClass: {
                    popup: 'rounded-[30px]',
                    confirmButton: 'rounded-xl px-6 py-2'
                }
            });
        }
    </script>

    @if(session('status_berhasil'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('status_berhasil') }}",
            confirmButtonColor: '#588133',
            customClass: {
                popup: 'rounded-[30px]',
                confirmButton: 'rounded-xl px-6 py-2'
            }
        });
    </script>
    @endif

</x-app-layout>