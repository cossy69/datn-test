<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test AI Trip Planner - Toby</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
    #map {
        height: 500px;
        width: 100%;
        border-radius: 12px;
        z-index: 1;
    }
    </style>
</head>

<body class="bg-gray-100 p-5 md:p-10">

    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">AI Smart Trip Planner 🌏</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md h-fit">
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Điểm đến:</label>
                    <input type="text" id="destination" placeholder="Ví dụ: Đà Nẵng, Tokyo..."
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button onclick="generateTrip()" id="btn-submit"
                    class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">
                    Lên kế hoạch ngay!
                </button>

                <div id="loading" class="hidden mt-4 text-center text-blue-500 font-medium italic">
                    Gemini đang suy nghĩ, chờ xíu nhé...
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div id="map" class="shadow-lg border-4 border-white"></div>
                <div id="itinerary-result" class="bg-white p-6 rounded-xl shadow-md hidden">
                    <h2 class="text-xl font-bold mb-4 border-b pb-2">Lịch trình chi tiết</h2>
                    <div id="list-items" class="space-y-4"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
    let map = L.map('map').setView([16.0544, 108.2022], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let markers = [];

    async function generateTrip() {
        const dest = document.getElementById('destination').value;
        if (!dest) return alert('Nhập điểm đến đã ông ơi!');

        // Hiển thị trạng thái loading
        document.getElementById('loading').classList.remove('hidden');
        document.getElementById('btn-submit').disabled = true;

        try {
            const response = await fetch('/api/test-ai', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    destination: dest
                })
            });

            const result = await response.json();
            renderTrip(result.data);
        } catch (error) {
            console.error(error);
            alert('Có lỗi rồi, check console log nhé!');
        } finally {
            document.getElementById('loading').classList.add('hidden');
            document.getElementById('btn-submit').disabled = false;
        }
    }

    function renderTrip(data) {
        // 1. Xóa các Marker cũ trên bản đồ
        markers.forEach(m => map.removeLayer(m));
        markers = [];

        const itineraryDiv = document.getElementById('itinerary-result');
        const listDiv = document.getElementById('list-items');
        itineraryDiv.classList.remove('hidden');
        listDiv.innerHTML = '';

        let firstCoords = null;

        data.days.forEach(day => {
            let dayHtml =
                `<div class="mb-6"><h3 class="font-bold text-blue-500 text-lg">Ngày ${day.day_index}</h3>`;

            day.items.forEach(item => {
                const loc = item.location;
                if (!firstCoords) firstCoords = [loc.lat, loc.lng];

                // Thêm Marker vào bản đồ
                let marker = L.marker([loc.lat, loc.lng])
                    .addTo(map)
                    .bindPopup(`<b>${loc.name}</b><br>${item.start_time} - ${item.end_time}`);
                markers.push(marker);

                dayHtml += `
                        <div class="ml-4 p-2 border-l-2 border-gray-200 mt-2">
                            <span class="text-sm font-semibold text-gray-500">${item.start_time} - ${item.end_time}</span>
                            <p class="font-medium">${loc.name}</p>
                        </div>
                    `;
            });
            dayHtml += `</div>`;
            listDiv.innerHTML += dayHtml;
        });

        // 2. Di chuyển tâm bản đồ tới điểm đầu tiên
        if (firstCoords) map.setView(firstCoords, 12);
    }
    </script>
</body>

</html>