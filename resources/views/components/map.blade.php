<div class="mt-12 max-w-5xl mx-auto px-2">
    <div>
        <h1 class="text-2xl font-bold">오시는 길</h1>
        <p>서울특별시 양천구 목동로 213</p>
    </div>

    <div id="map" class="my-4 rounded-lg aspect-video w-full border shadow-lg"></div>

    <script>
        function initMap() {

            const location = { lat: 37.52759681049792, lng: 126.86368533824552 };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: location,
            });

            const marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }
    </script>

    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAlCgmo1pX_ZgicCA-qG_Yh7o1notDwgo&callback=initMap">
    </script>
</div>