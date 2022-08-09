<template>
  <el-table :data="state.data" border>
    <el-table-column v-if="showIndex" type="index" :index="indexHandler" />
    <el-table-column
      v-for="(column, index) in state.columns"
      :key="`${uid()}-${index}`"
      :prop="column.key"
      :label="column.label"
      :sortable="column.sortable || false"
    >
      <template #default="{ row }">
        <slot
          :data="row"
          :name="column.key"
        >
          {{ handleColumnFormatting(row, column) }}
        </slot>
      </template>
    </el-table-column>
  </el-table>
</template>

<script>
import { defineComponent, reactive, computed } from 'vue';
import { uid } from '@/util/helper';

export default defineComponent({
  name: 'DataTable',
  props: {

    data: {
      type: Array,
      required: true,
    },

    columns: {
      type: Array,
      required: true,
    },

    showIndex: {
      type: Boolean,
      default: false,
    },

    indexLabel: {
      type: String,
      default: '#',
    },

    paginate: {
      type: Boolean,
      default: false,
    },
  },

  setup(props, ) {


    const state = reactive({
      columns: computed(()=> props.columns),
      data: computed(()=> props.data),
    });

    const handleColumnFormatting = (row, column) => {

      if(column.formatter && typeof column.formatter === 'function') {
        return column.formatter(row[column.key]);
      }

      return row[column.key];
    };

    const indexHandler = (index) => index + 1;

    return {
      state,
      handleColumnFormatting,
      indexHandler,
      uid
    };
  },
});
</script>

<style scoped>

</style>
