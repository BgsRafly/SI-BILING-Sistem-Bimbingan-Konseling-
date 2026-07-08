@extends('layouts.dosen')
@section('title', 'Monitoring Mahasiswa PA - SI-BILING')

@section('content')
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Monitoring Mahasiswa PA</h1>
                    <p class="text-gray-500 mt-2 text-sm font-medium">Daftar seluruh mahasiswa bimbingan akademik Anda.</p>
                </div>
                <div class="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg font-bold text-sm border border-indigo-100">
                    Total: {{ count($mahasiswas) }} Mahasiswa
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-sm text-gray-500">
                                <th class="p-4 font-semibold rounded-tl-xl">Mahasiswa</th>
                                <th class="p-4 font-semibold">Kontak</th>
                                <th class="p-4 font-semibold text-center">Total Konseling</th>
                                <th class="p-4 font-semibold text-center rounded-tr-xl">Status Terakhir</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($mahasiswas as $mhs)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm shrink-0">
                                            {{ strtoupper(substr($mhs->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 text-sm">{{ $mhs->name }}</p>
                                            <p class="text-[11px] text-gray-500 mt-0.5">{{ $mhs->nim_nip }} • S1 {{ $mhs->program_studi }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    @if($mhs->no_whatsapp)
                                        @php
                                            $wa = preg_replace('/^0/', '62', $mhs->no_whatsapp);
                                        @endphp
                                        <a href="https://wa.me/{{ $wa }}" target="_blank" class="text-green-600 hover:text-green-700 text-sm font-semibold flex items-center gap-2">
                                            <i class="fa-brands fa-whatsapp"></i> Hubungi WA
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-400">Tidak ada WA</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">
                                        {{ $mhs->ajuans_count }} Kali
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    @if($mhs->ajuans->count() > 0)
                                        @php $lastAjuan = $mhs->ajuans->first(); @endphp
                                        @if($lastAjuan->status == 'Selesai')
                                            <span class="bg-green-50 text-green-700 px-2.5 py-1 rounded-md text-xs font-semibold border border-green-100">Selesai ({{ \Carbon\Carbon::parse($lastAjuan->updated_at)->format('d M') }})</span>
                                        @elseif($lastAjuan->status == 'Pending')
                                            <span class="bg-yellow-50 text-yellow-700 px-2.5 py-1 rounded-md text-xs font-semibold border border-yellow-100">Pending</span>
                                        @else
                                            <span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-semibold border border-blue-100">{{ $lastAjuan->status }}</span>
                                        @endif
                                    @else
                                        <span class="text-xs text-gray-400">Belum ada riwayat</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500 font-medium">Belum ada mahasiswa bimbingan yang terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
