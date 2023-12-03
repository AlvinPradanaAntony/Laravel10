<script setup>
  import { ref } from 'vue';
  const props = defineProps({
    list: { type: Object },
    thead: { type: Object },
    searchColumn: { type: String },
    actionColumn: { type: String, default: 'Action' },
    hasAction: { type: Boolean, default: true},
    hasSearch: { type: Boolean, default: true },
    callbackColumn : { type: Object, default: {} }
  })

  const searchedString = ref('');

  function filteredList() {
    let newObj = [];
    let list = props.list;
    
    if (searchedString.value == '') {
      return list;

    } else {
      for (let i in list) {
        if (list[i][props.searchColumn].toLowerCase().includes(searchedString.value.toLowerCase())) {
          newObj.push(list[i]);
        } 
      }
      
      return newObj;
    }
  }
  
</script>

<template>
  <template v-if="hasSearch">
    <div class="flex flex-row-reverse justify-between pr-4">
      <input type="text" v-model="searchedString" class="rounded py-1 text-gray-500" placeholder="Search">
    </div>
  </template>
  <table class="min-w-full mt-2">
    <thead>
      <tr>
        <th v-for="columnName in thead.displayAs" class="text-left border-b-[1px] py-2 px-4">{{ columnName }}</th>
        <template v-if="hasAction">
          <th class="text-left border-b-[1px] py-2 px-4">{{ actionColumn }}</th>
        </template>
      </tr>
    </thead>
    <tbody>
      <tr v-for="permission in filteredList()">
        <td v-for="column in thead.column" class="border-b-[1px] py-2 px-4">
          <template v-if="typeof callbackColumn[column] === 'function'"> {{ callbackColumn[column](permission[column]) }} </template>
          <template v-else> {{ permission[column] }} </template>
        </td>
        <template v-if="hasAction">
          <td class="border-b-[1px] py-2 px-4">
            <slot name="action" :rowData="permission"/>
          </td>
        </template>
      </tr>
    </tbody>
  </table>
</template>