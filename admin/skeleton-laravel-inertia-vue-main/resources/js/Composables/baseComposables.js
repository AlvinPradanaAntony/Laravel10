import { reactive } from "vue";

const baseComposablesState = reactive({
  isMainLoading: false,
  isShowSidebar: false,
})

function useCapitalise(str) {
  return `${str[0].toUpperCase()}${str.slice(1).toLowerCase()}`;
}

function useShowLoading() {
  baseComposablesState.isMainLoading = true;
}

function useHideLoading() {
  baseComposablesState.isMainLoading = false;
}

function useToggleSidebar() {
  baseComposablesState.isShowSidebar = !baseComposablesState.isShowSidebar;
}

function useScreenWidthChecker(size = 'base') {
  let screenSize = {
    'sm'  : 640,
    'md'  : 768,
    'lg'  : 1024,
    'xl'  : 1280,
    '2xl' : 1536,
  }

  return window.innerWidth <= screenSize[size] ? true : false;
}

export { baseComposablesState, useCapitalise, useShowLoading, useHideLoading, useToggleSidebar, useScreenWidthChecker };