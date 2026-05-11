<x-app-layout>
    @include('layouts.sidebar')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Digital Logbook') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Seluruh aktivitas penggunaan aset secara kronologis.</p>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100 bg-gray-50">
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Waktu</th>
                            <th class="py-3 px-4">Pengguna</th>
                            <th class="py-3 px-4">Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logbook as $index => $log)
                        <tr class="border-b border-gray-50 hover:bg-gray-50">
                             <td>{{ $index + 1 }}</td>
                             <td>{{ $log['waktu']->format('d-m-Y H:i') }}</td>
                             <td>{{ $log['pengguna'] }}</td>
                             <td>{{ $log['aktivitas'] }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-gray-500">Belum ada aktivitas tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                
            </div>
        </div>
    </div>
</x-app-layout>