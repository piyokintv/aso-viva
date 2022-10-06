<template>
  <draggable
    v-model="places"
    item-key="id"
  >
    <template #item="{element}">
      <div>
        {{ element.name }}
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
