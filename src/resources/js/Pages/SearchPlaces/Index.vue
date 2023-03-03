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
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import { Loader } from "@googlemaps/js-api-loader";
import { onMounted } from 'vue';

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
    };

    let map;

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

    return {
      form,
      searchPlaces,
    };
  },
}
</script>

<style scoped>
#map {
  height: 500px;
}
</style>
