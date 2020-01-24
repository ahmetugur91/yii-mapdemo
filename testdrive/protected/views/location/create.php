<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Lokasyon Oluştur';
$errors = $location->getErrors();
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lokasyon Oluştur</div>
                <div class="card-body">
                    <div class="form-group">
                        <a href="/?r=location/index" class="btn btn-primary"><i class="icon icon-arrow-left"></i>
                            Lokasyonlara Geri Dön</a>
                    </div>

                    <form action="/?r=location/create" method="POST">


                        <div class="form-group">
                            <label for="name">Lokasyon Adı</label>
                            <input id="name" name="location[name]" value="<?php echo $location->name; ?>"
                                   class="form-control <?php if (isset($errors["name"])) echo "is-invalid"; ?>" required/>
                            <?php if (isset($errors["name"])): ?>
                                <span class="invalid-feedback" role="alert">
                                        <?php foreach ($errors["name"] as $error): ?>
                                            <strong><?php echo $error; ?></strong>
                                        <?php endforeach; ?>
                                    </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="city">Şehir</label>
                            <input id="city" name="location[city]" value="<?php echo $location->city; ?>"
                                   class="form-control <?php if (isset($errors["city"])) echo "is-invalid"; ?>" required/>
                            <?php if (isset($errors["city"])): ?>
                                <span class="invalid-feedback" role="alert">
                                        <?php foreach ($errors["city"] as $error): ?>
                                            <strong><?php echo $error; ?></strong>
                                        <?php endforeach; ?>
                                    </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="district">İlçe</label>
                            <input id="district" name="location[district]" value="<?php echo $location->district; ?>"
                                   class="form-control <?php if (isset($errors["district"])) echo "is-invalid"; ?>" required/>
                            <?php if (isset($errors["district"])): ?>
                                <span class="invalid-feedback" role="alert">
                                        <?php foreach ($errors["district"] as $error): ?>
                                            <strong><?php echo $error; ?></strong>
                                        <?php endforeach; ?>
                                    </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="lat">Latitude</label>
                            <input id="lat" name="location[lat]" value=""
                                   class="form-control <?php if (isset($errors["lat"])) echo "is-invalid"; ?>" required/>
                            <?php if (isset($errors["lat"])): ?>
                                <span class="invalid-feedback" role="alert">
                                        <?php foreach ($errors["lat"] as $error): ?>
                                            <strong><?php echo $error; ?></strong>
                                        <?php endforeach; ?>
                                    </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="lng">Longitude</label>
                            <input id="lng" name="location[lng]" value=""
                                   class="form-control <?php if (isset($errors["lng"])) echo "is-invalid"; ?>" required/>
                            <?php if (isset($errors["lng"])): ?>
                                <span class="invalid-feedback" role="alert">
                                        <?php foreach ($errors["lng"] as $error): ?>
                                            <strong><?php echo $error; ?></strong>
                                        <?php endforeach; ?>
                                    </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <button type="button" onclick="getPosition()" class="btn btn-info btn-sm"><i
                                        class="icon icon-map-marker"></i> Şuanki Pozisyonumu Al
                            </button>
                        </div>

                        <div class="form-group" style="width: 100%;height: 400px">
                            <div id="map" style="height: 100%;"></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="create" value="Kaydet" class="btn btn-success btn-block">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var map;
    var markers = [];

    //init to map div
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            // there are errors but if coordinates are valid set the map again

            <?php if(count($errors) && !($errors["lat"] or $errors["lng"])): ?>
            // to reMark map from old form inputs

            center: {lat: 41.015137, lng: 28.979530},

        <?php else: ?>
            // default coordinates Istanbul
            center: {lat: 41.015137, lng: 28.979530},
            <?php endif; ?>
            zoom: 14
        })


        google.maps.event.addListener(map, 'click', function (event) {
            setForm(event.latLng.lat(), event.latLng.lng());
        });
    }

    // to get real coordinate from the browser
    function getPosition() {
        // Try HTML5 geolocation.
        infoWindow = new google.maps.InfoWindow;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                setForm(pos.lat, pos.lng);
                infoWindow.setPosition(pos);
                map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    //put a marker on map
    function setMarker(lat, lng) {
        var marker = new google.maps.Marker({
            position: {lat, lng},
            map: map,
        });
        markers.push(marker);
    }

    //transfer to form
    function setForm(lat, lng) {
        $("#lat").val(lat);
        $("#lng").val(lng);
        for (let i = 0; i < markers.length; i++) markers[i].setMap(null);
        setMarker(lat, lng);
        var latlng;
        latlng = new google.maps.LatLng(lat, lng);
        // get city and distrcit names.
        new google.maps.Geocoder().geocode({'latLng': latlng}, function (results, status) {
            var components = results[0]["address_components"];
            $("#city").val(components[4]["long_name"]);
            $("#district").val(components[3]["long_name"]);
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiuLQurCBn_M9Qk5wpS7_fe-z63qKMyEg&callback=initMap" async
        defer></script>
