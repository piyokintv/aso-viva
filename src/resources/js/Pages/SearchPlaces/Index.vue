<template>
  <button>
    追加
  </button>
  <draggable
    :list="places"
    item-key="id"
  >
    <template #item="{element}">
      <div>
        <input
          v-model="element.name"
          type="text"
        >
        <button>
          削除
        </button>
      </div>
    </template>
  </draggable>
</template>

<script>
import draggable from 'vuedraggable';
import { reactive } from 'vue';

export default {
  components: {
    draggable,
  },
  setup() {
    const places = reactive([
      {
        id: 1,
        name: 'ああああ',
      },
      {
        id: 2,
        name: 'いいいい',
      },
      {
        id: 3,
        name: 'うううう',
      }
    ]);

    return {
      places,
    };
  },
}
</script>

<style scoped>

</style>
