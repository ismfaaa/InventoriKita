<x-app-layout>
    @include('layouts.sidebar')
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#588133] leading-tight">
            {{ __('Pusat Keputusan Operasional Pelaporan') }}
        </h2>
    </x-slot>

    {{-- Container utama dengan state Alpine.js --}}
    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" x-data="{ selectedLaporan: null }">
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-800">Daftar Usulan Penanganan Aset - InventoriKita</h3>
            <p class="text-sm text-gray-500">Tinjau laporan kerusakan dan tentukan tindakan lanjut.</p>
        </div>

        <div class="bg-white overflow-hidden shadow-sm rounded-[30px] border border-gray-100">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Aset</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Tingkat Kerusakan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Feedback</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pelaporans as $index => $laporan)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $laporan->aset->nama_aset ?? 'Aset' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $laporan->tingkat_kerusakan == 'berat' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600' }}">
                                {{ $laporan->tingkat_kerusakan }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            {{-- Form Update Status --}}
                            <form action="{{ route('feedback.pelaporan.updateStatus', $laporan->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status_pelaporan" value="feedback">
                                <select name="feedback" required {{ $laporan->status_pelaporan == 'selesai' ? 'disabled' : '' }} class="text-xs border-gray-300 rounded-lg py-1 px-2 bg-gray-50">
                                    <option value="" disabled {{ is_null($laporan->feedback) ? 'selected' : '' }}>Pilih</option>
                                    <option value="diperbaiki" {{ $laporan->feedback == 'diperbaiki' ? 'selected' : '' }}>Diperbaiki</option>
                                    <option value="diganti" {{ $laporan->feedback == 'diganti' ? 'selected' : '' }}>Diganti</option>
                                    <option value="dihilangkan" {{ $laporan->feedback == 'dihilangkan' ? 'selected' : '' }}>Dihilangkan</option>
                                </select>
                                @if (!$laporan->feedback)
                                    <button type="submit" class="bg-[#588133] text-white px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase">Update</button>
                                @elseif ($laporan->status_pelaporan == 'selesai')
                                    <span class="text-blue-600 text-[10px] font-bold uppercase">Selesai</span>
                                @endif
                            </form>
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{-- Tombol Pemicu Modal --}}
                            <button @click="selectedLaporan = {{ $laporan->id }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-xl text-xs font-bold transition">
                                Lihat Detail
                            </button>

                            {{-- Bingkai Modal --}}
                            <div x-show="selectedLaporan === {{ $laporan->id }}" 
                                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" 
                                 x-cloak>
                                <div @click.away="selectedLaporan = null" class="bg-white rounded-[30px] shadow-2xl max-w-lg w-full overflow-hidden text-left">
                                    
                                    {{-- INI CARA MENGHUBUNGKANNYA: Memanggil file show terpisah --}}
                                    @include('stakeholder.pelaporan.show', ['laporan' => $laporan])

                                    <div class="p-6 bg-gray-50 flex justify-end border-t border-gray-100">
                                        <button @click="selectedLaporan = null" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-xl text-xs font-bold hover:bg-gray-300">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">Belum ada laporan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>