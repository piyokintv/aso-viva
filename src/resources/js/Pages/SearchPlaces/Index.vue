<template>
  <div class="mb-3">
    <label
      for="places-textarea"
      class="form-label"
    >
      行く予定の場所
    </label>
    <textarea
      id="places-textarea"
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
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';

export default {

}
</script>

<style>

</style>
