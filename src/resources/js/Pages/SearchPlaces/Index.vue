<template>
  <form
    class="mb-3"
    @submit.prevent="searchPlaces()"
  >
    <label
      for="places-textarea"
      class="form-label"
    >
      行く予定の場所
    </label>
    <textarea
      id="places-textarea"
      v-model="form.place"
      class="form-control"
      rows="3"
      placeholder="東京駅、東京タワー、東京スカイツリー"
    />
    <button
      class="btn btn-primary"
      type="submit"
    >
      おすすめの場所を検索
    </button>
  </form>
  <div id="map" />
  <img
    :src="photoUrl"
    alt=""
  >
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import { Loader } from "@googlemaps/js-api-loader";
import { onMounted, ref } from 'vue';

export default {
  setup() {
    const form = useForm({
      place: null,
    });

    const searchPlaces = async () => {
      console.log('メソッド発火');

      const prompt = 'Google Apps Scriptの活用事例を教えてください';

      const { Configuration, OpenAIApi } = require("openai");
      const configuration = new Configuration({
        apiKey: process.env.MIX_OPENAI_API_KEY,
      });
      const openai = new OpenAIApi(configuration);
      const response = await openai.createCompletion({
        model: "text-davinci-003",
        prompt: prompt,
        temperature: 0.9,
        max_tokens: 1024,
      });

      console.log(response);

      searchPlacesWithGoogleMaps()
    };

    let map;
    let service;
    let bounds;
    let markers = [];
    let infoWindow;

    let photoUrl = ref('');

    onMounted(() => {
      const loader = new Loader({
        apiKey: process.env.MIX_GOOGLE_MAPS_API_KEY,
        version: "weekly",
        libraries: ["places"],
      });

      loader.load().then(() => {
        map = new google.maps.Map(document.getElementById("map"), {
          // 東京駅の緯度・経度
          center: {
            lat: 35.68149326522126,
            lng: 139.76709261130685,
          },
          zoom: 15,
        });
      });
    });

    const searchPlacesWithGoogleMaps = () => {
      let request = {
        query: form.place,
      };

      service = new google.maps.places.PlacesService(map);
      service.textSearch(request, callback);
    }

    const callback = (results, status) => {
      if (status == google.maps.places.PlacesServiceStatus.OK) {
        bounds = new google.maps.LatLngBounds();
        infoWindow = new google.maps.InfoWindow();

        markers.forEach((marker) => {
          marker.setMap(null);
        });
        markers = [];

        for (let i = 0; i < results.length; i++) {
          let place = results[i];
          createMarker(results[i]);
        }

        map.fitBounds(bounds);
      }
    }

    const createMarker = (place) => {
      if (!place.geometry || !place.geometry.location) {
        return;
      }

      const marker = new google.maps.Marker({
        map,
        position: place.geometry.location,
        title: place.name,
        optimized: false,
      });

      marker.addListener('click', () => {
        infoWindow.close();
        infoWindow.setContent(marker.getTitle());
        infoWindow.open(marker.getMap(), marker);

        photoUrl.value = place.photos[0].getUrl();
      });

      markers.push(marker);

      if (place.geometry.viewport) {
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    }

    return {
      form,
      searchPlaces,
      photoUrl,
    };
  },
}
</script>

<style scoped>
#map {
  height: 500px;
}
</style>
