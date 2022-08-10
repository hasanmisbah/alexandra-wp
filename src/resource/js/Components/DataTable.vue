<template>
  <el-table :data="state.renderableData" border>
    <el-table-column v-if="showIndex" type="index" :index="indexHandler" :label="indexLabel"/>
    <el-table-column
      v-for="(column, index) in state.columns"
      :key="`${state.componentId}-${index}`"
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
  <el-pagination
    v-if="paginate"
    v-model:currentPage="state.paginationIndex"
    v-model:page-size="state.perPage"
    :background="true"
    :page-sizes="perPageOptions"
    layout="sizes, prev, pager, next"
    :total="state.data.length"
    style="margin: 20px 0"
  />
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

    perPage: {
      type: Number,
      default: 10,
    },

    perPageOptions: {
      type: Array,
      default: () => [10, 20, 30, 40, 50],
    },
  },

  setup(props) {


    const state = reactive({

      columns: computed(() => props.columns),

      componentId: computed(() => uid('data-table')),

      data: computed(() => props.data),

      paginationIndex: 1,

      perPage: props.perPage,

      renderableData: computed(() => {

        const filterableData = [...state.data];

        if(!props.paginate) {
          return filterableData;
        }

        const startIndex = state.paginationIndex > 1
          ? (state.paginationIndex * state.perPage) - state.perPage
          : 0
        ;

        const endIndex = (state.perPage * state.paginationIndex);

        return filterableData.slice(startIndex, endIndex);
      }),
    });

    const handleColumnFormatting = (row, column) => {

      if (column.formatter && typeof column.formatter === 'function') {
        return column.formatter(row[column.key]);
      }

      return row[column.key];
    };

    const indexHandler = (index) => {

      if (state.paginationIndex > 1) {
        return ((index + 1) + (state.paginationIndex * state.perPage)) - state.perPage;
      }

      return (index + 1);
    };

    return {
      state,
      handleColumnFormatting,
      indexHandler,
      uid
    };
  },
});
</script>

<style lang="scss">
.el-pagination .el-input__inner {
  background-color: #fff !important;
  border-color: transparent !important;
}

.el-select .el-input.is-focus .el-input__wrapper {
  border-color: transparent !important;
}
</style>
