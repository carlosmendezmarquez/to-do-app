require('./bootstrap');

import { createApp } from 'vue'
import App from "./vue/app.vue"

/* import the fontawesome core and components */
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faPlusSquare, faTrash, faCompactDisc, faCheckSquare, faList } from '@fortawesome/free-solid-svg-icons'
library.add(faPlusSquare, faTrash, faCompactDisc,faCheckSquare, faList)

/* import datepicker */
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

createApp(App)
    .component('font-awesome-icon', FontAwesomeIcon)
    .component('Datepicker', Datepicker)
    .mount('#app');
