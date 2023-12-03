<template>
  <div>
      <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
        <a v-for="(page, index) in pagesNumber"
            :key="index"
            @click.prevent="changePage(page)"
            href="#"
            aria-current="page"
            class="z-10 bg-white border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium hover:bg-gray-100">
            {{page}}
        </a>
      </nav>
    </div>
</template>

<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        pagination: {
            type: Object,
            required: true
        }
    })

    const pagesNumber = computed(() => {
        if (!this.pagination.to) {
          return [];
        }

        let pagesArray  = [];
        let from        = 1;
        let to          = this.pagination.last_page;

        for (let page = from; page <= to; page++) {
          pagesArray.push(page);
        }

        return pagesArray;
    })

    const emit = defineEmits(['paginate'])

    function changePage(page) {
        this.pagination.current_page = page

        emit('paginate', page);
    }
</script>
