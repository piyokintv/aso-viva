<template>
  <div class="container">
    <form
      class="mb-3 text-center"
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
        class="form-control mb-3"
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
    <div class="row">
      <div class="col-sm-6">
        <div class="ratio ratio-1x1">
          <div
            id="map"
            class="h-100"
          />
        </div>
      </div>
      <div class="col-sm-6">
        <div class="ratio ratio-1x1">
          <img
            :src="photoUrl"
            alt=""
            class="img-fluid"
          >
        </div>
      </div>
    </div>
  </div>
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
      const response = await openai.createChatCompletion({
        model: "gpt-3.5-turbo",
        messages: [
          { role: "system", content: process.env.MIX_SYSTEM_CONTENT },
          { role: "user", content: process.env.MIX_PROMPT },
          { role: "user", content: form.place },
        ],
      });

      const messageContent = response.data.choices[0].message.content;
      const regex = new RegExp(process.env.MIX_REGEX);
      const results = messageContent.match(regex);
      const recommendedPlace = results[1];

      searchPlacesWithGoogleMaps(recommendedPlace);
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

    const searchPlacesWithGoogleMaps = (recommendedPlace) => {
      let request = {
        query: recommendedPlace,
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
</style>
