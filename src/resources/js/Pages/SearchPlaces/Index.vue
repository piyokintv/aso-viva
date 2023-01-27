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
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
  setup() {
    const form = useForm({
      place: null,
    });

    const searchPlaces = () => {
      console.log('メソッド発火');
    };

    return {
      form,
      searchPlaces,
    };
  },
}
</script>

<style>

</style>
