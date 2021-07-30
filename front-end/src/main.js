import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axios from "axios";
// import Pagination from "laravel-vue-pagination";
import Pagination from 'v-pagination-3';
//import "./index.css";
import "popper.js";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
//import { registerComponents } from "../src/components/Globar.js";
import "./assets/global-style.css";

axios.defaults.baseURL = `http://127.0.0.1:8000/api/v1/`;



const app = createApp(App);

app.component('pagination', Pagination);
app.use(store);
app.use(router);
app.use(VueSweetalert2);
app.use(Loading);
//registerComponents(app);
app.mount("#app");
