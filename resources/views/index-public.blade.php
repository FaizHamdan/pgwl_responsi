@extends('layouts.template')

@section('style')
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        #map {
            height: calc(100vh - 56px);
            width: 100%;
            margin: 0;
        }
    </style>
@endsection



@section('content')
    <div id="map" style="width: 100vw; height: 100vh; margin: 0"></div>
@endsection



@section('script')
    <script>
        // Map
        var map = L.map('map').setView([-7.7956, 110.3695], 13);

         /* Tile Basemap */
       L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: 'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(map);

        var basemap1 = L.tileLayer(
            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | <a href="DIVSIGUGM" target="_blank">DIVSIG UGM</a>',
            }
        );

        var basemap2 = L.tileLayer(
            "https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}", {
                attribution: 'Tiles &copy; Esri | <a href="Latihan WebGIS" target="_blank">DIVSIG UGM</a>',
            }
        );

        var basemap3 = L.tileLayer(
            "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}", {
                attribution: 'Tiles &copy; Esri | <a href="Lathan WebGIS" target="_blank">DIVSIG UGM</a>',
            }
        );

        var basemap4 = L.tileLayer(
            "https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png", {
                attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
            }
        );

        basemap4.addTo(map);

        var baseMaps = {
            OpenStreetMap: basemap1,
            "Esri World Street": basemap2,
            "Esri Imagery": basemap3,
            "Stadia Dark Mode": basemap4,
        };

        L.control.layers(baseMaps).addTo(map);

        // Define custom icon
        var customIcon = L.icon({
                iconUrl: "{{ asset('bus-removebg-preview.png') }}", // Pastikan ini adalah path yang benar ke gambar ikon Anda
                iconSize: [32, 32], // Ukuran ikon, sesuaikan dengan ukuran gambar Anda
                iconAnchor: [16, 32], // Titik anchor dari ikon (biasanya tengah bawah)
                popupAnchor: [0, -32] // Titik anchor popup relatif terhadap ikon
            });

        
        //* GeoJSON Point */
                  var point = L.geoJson(null, {
            pointToLayer: function (feature, latlng) {
                return L.marker(latlng, {icon: customIcon});
            },
            onEachFeature: function(feature, layer) {
                var popupContent = "Name: " + feature.properties.name + "<br>" +
                    "Description: " + feature.properties.description + "<br>" +
                    "Photo: <img src='{{ asset('storage/images/') }}/" + feature.properties.image +
                    "' class='img-thumbnail' alt='...'>" + "<br>";
                    
                layer.on({
                    click: function(e) {
                        point.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        point.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });


                // Fungsi untuk mendapatkan gaya untuk polyline
            function getStyle(feature) {
                return {
                    color: getColor(feature.properties.PopupInfo), // Menggunakan fungsi getColor() untuk mendapatkan warna unik
                    weight: 1
                };
            }

            // Fungsi untuk menghasilkan warna unik berdasarkan string input
            function getColor(str) {
                // Hitung hash code dari string input
                var hash = 0;
                for (var i = 0; i < str.length; i++) {
                    hash = str.charCodeAt(i) + ((hash << 5) - hash);
                }
                // Ubah hash code menjadi warna hexadecimal
                var color = '#';
                for (var j = 0; j < 3; j++) {
                    var value = (hash >> (j * 8)) & 0xFF;
                    if (j === 0) {
                        value = (value + 128) % 256; // R
                    } else if (j === 1) {
                        value = (value + 64) % 256; // G
                    } else {
                        value = (value + 192) % 256; // B
                    }
                    color += ('00' + value.toString(16)).substr(-2);
                }
                return color;
            }

            // Inisialisasi variabel untuk menyimpan jalur yang sedang dipilih
            var selectedLayer = null;

            // Membuat layer GeoJSON dengan gaya dan popup
            var polyline = L.geoJson(null, {
                style: getStyle,
                onEachFeature: function(feature, layer) {
                    // Cek untuk properti yang tidak ada dan berikan nilai default
                    var name = feature.properties.Name || "Nama tidak tersedia";
                    var popupInfo = feature.properties.PopupInfo || "Informasi tidak tersedia";
                    var id = feature.properties.id || 0;

                    var popupContent = "Trayek " + name + "<br>" +
                        "Rute: " + popupInfo + "<br>";

                    layer.bindPopup(popupContent);
                    
                    layer.on({
                        mouseover: function(e) {
                            if (!layer.clicked) {
                                layer.setStyle({
                                    weight: 2
                                });
                            }
                            layer.bindTooltip(name).openTooltip();
                        },
                        mouseout: function(e) {
                            if (!layer.clicked) {
                                polyline.resetStyle(e.target); // Mengembalikan gaya awal ketika mouseout
                            }
                        },
                        click: function(e) {
                            if (selectedLayer && selectedLayer !== layer) {
                                // Mengembalikan jalur yang sebelumnya dipilih menjadi warna biru
                                selectedLayer.setStyle({
                                    color: getColor(selectedLayer.feature.properties.PopupInfo),
                                    weight: 1
                                });
                                selectedLayer.clicked = false; // Menandai layer sebelumnya tidak diklik
                            }
                            // Mengatur urutan layer agar layer yang diklik ditempatkan di depan
                            layer.bringToFront();
                            layer.clicked = true; // Menandai layer sebagai diklik
                            layer.setStyle({
                                color: 'red', // Warna ketika diklik
                                weight: 3
                            });
                            selectedLayer = layer; // Menyimpan layer yang baru dipilih
                        },
                        popupclose: function() {
                            if (!layer.clicked) {
                                layer.setStyle({
                                    color: getColor(layer.feature.properties.PopupInfo),
                                    weight: 1.5
                                });
                            }
                        }
                    });
                }
            });

            // Mengambil data GeoJSON dari URL dan menambahkannya ke peta
            fetch('{{ asset('storage/geojson/Jalan_TJ.geojson') }}')
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Log data ke konsol untuk debugging
                    polyline.addData(data);
                    map.addLayer(polyline);
                })
                .catch(error => console.log(error));

        //layer control
        var overlayMaps = {
            "Halte Trans Jogja": point,
            "Rute Trans Jogja": polyline
        };

        var layerControl = L.control.layers(null, overlayMaps, {collapsed: false}).addTo(map);

    </script>
@endsection

</body>

</html>