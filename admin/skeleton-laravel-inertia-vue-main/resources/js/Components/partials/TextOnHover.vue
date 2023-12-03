<script setup>
import { ref } from 'vue';
const props = defineProps({
  content: { type: String, required: true},
  direction: { type: String, default: 'TOP' },
})

const directionStyle = {
  'TOP'   : '-top-8 left-1/2 -translate-x-1/2 on-top',
  'RIGHT' : '-right-3 translate-x-full top-1/2 -translate-y-1/2 on-right',
  'BOTTOM': '-bottom-8 left-1/2 -translate-x-1/2 on-bottom',
  'LEFT'  : '-left-3 -translate-x-full top-1/2 -translate-y-1/2 on-left',
};

const isShow = ref(false);

function onHover(params) {
  isShow.value = params ? true : false;
}
</script>

<template>
  <div class="relative w-fit">
    <div :class="directionStyle[direction], {'hidden': !isShow}" class="z-50 absolute bg-black text-white rounded-sm px-2 py-1 text-xs">{{ content }}</div>
    <slot name="activator" :onHover="onHover" />
  </div>
</template>

<style scoped>
  .on-top::after{
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    bottom: -6px;
    left: 50%;
    transform: translateX(-50%);
    border-left: 3px solid transparent;
    border-right: 3px solid transparent;
    border-top: 6px solid black;
  }
  .on-bottom::before{
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    top: -6px;
    left: 50%;
    transform: translateX(-50%);
    border-left: 3px solid transparent;
    border-right: 3px solid transparent;
    border-bottom: 6px solid black;
  }
  .on-left::after{
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    right: -6px;
    top: 50%;
    transform: translateY(-50%);
    border-top: 3px solid transparent;
    border-bottom: 3px solid transparent;
    border-left: 6px solid black;
  }
  .on-right::before{
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    left: -6px;
    top: 50%;
    transform: translateY(-50%);
    border-top: 3px solid transparent;
    border-bottom: 3px solid transparent;
    border-right: 6px solid black;
  }
</style>