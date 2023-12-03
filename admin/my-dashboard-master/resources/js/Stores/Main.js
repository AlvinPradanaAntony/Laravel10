import { defineStore } from 'pinia'
import { darkModeKey } from '@/Dashboard/Config'

export const useMainStore = defineStore('main', {
    state: () => ({
        // Notification
        hasNotification: false,

        // Layout
        sideBarVisibilityMobile: false,

        // Dark mode
        darkMode: false,
    }),

    actions: {
        setHasNotification(value){
            this.hasNotification = value
        },

        changeSideBarVisibilityMobile(){
            this.sideBarVisibilityMobile = !this.sideBarVisibilityMobile
        },

        setDarkMode (payload = null) {
            const value = payload !== null ? payload : !this.darkMode

            document.documentElement.classList[value ? 'add' : 'remove']('dark')

            localStorage.setItem(darkModeKey, value ? '1' : '0')

            this.darkMode = value
        },
    }
})
