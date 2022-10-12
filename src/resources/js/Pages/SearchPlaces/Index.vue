<template>
  <button>
    追加
  </button>
  <draggable
    v-model="places"
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

export default {
  components: {
    draggable,
  },
  data() {
    return {
      places: [
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
      ],
    };
  },
}
</script>

<style scoped>

</style>
