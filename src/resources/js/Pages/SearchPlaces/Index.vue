<template>
  <button
    @click="addPlace()"
  >
    追加
  </button>
  <draggable
    :list="places"
    item-key="id"
  >
    <template #item="{ element, index }">
      <div>
        <input
          v-model="element.name"
          type="text"
        >
        <button
          @click="deletePlace(index)"
        >
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

    let nextId = places.length;

    const addPlace = () => {
      nextId++;

      places.push({
        id: nextId,
        name: `追加されたやつ${nextId}`,
      });
    };

    const deletePlace = (index) => {
      places.splice(index, 1);
    };

    return {
      places,
      addPlace,
      deletePlace,
    };
  },
}
</script>

<style scoped>

</style>
