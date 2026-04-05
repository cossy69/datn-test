<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bảng điều khiển du lịch
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-8 border border-blue-100">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Chào {{ auth()->user()->name }}! 👋</h3>
                        <p class="text-gray-600 mt-2">Hôm nay cậu muốn khám phá vùng đất mới nào cùng AI?</p>
                    </div>
                    <a href="/test-ui"
                        class="group relative inline-flex items-center px-8 py-4 bg-blue-600 text-white font-bold rounded-full transition-all hover:bg-blue-700 hover:shadow-lg active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tạo lịch trình mới
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-3 flex items-center justify-between">
                    <h4 class="text-lg font-semibold text-gray-700">Chuyến đi gần đây của cậu</h4>
                </div>

                @forelse($itineraries as $item)
                <a href="{{ route('trips.show', $item->id) }}"
                    class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:border-blue-300 transition-colors group block">
                    <div class="flex items-center justify-between mb-4">
                        <span class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                        </span>
                        <span class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                    <h5 class="font-bold text-gray-800 group-hover:text-blue-600">{{ $item->destination_name }}</h5>
                    <p class="text-sm text-gray-500 mt-2 italic">Phong cách: {{ $item->travel_style }}</p>
                </a>
                @empty
                <div
                    class="md:col-span-3 bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-10 text-center text-gray-500">
                    Cậu chưa có lịch trình nào được lưu chính chủ. Thử nhấn nút tạo mới ở trên nhé!
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>