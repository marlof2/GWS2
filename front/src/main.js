import Vue from "vue";
import App from "./App.vue";
import Api from "./api/index";
import STRINGS from "./utils/strings";
import COLORS from "./utils/colors";
import MASKS from "./utils/masks";

// VUEX - https://vuex.vuejs.org/
import store from "./store";

// VUE-ROUTER - https://router.vuejs.org/
import router from "./router";

// PLUGINS
import vuetify from "./plugins/vuetify";
import i18n from "./plugins/vue-i18n";
import "./plugins/vue-shortkey";
import "./plugins/vue-head";
import "./plugins/apexcharts";
import "./plugins/echarts";
import "./plugins/animate";
import "./plugins/clipboard";
import "./plugins/moment";

//Segurança Cryptografia
// import cryptografia from "./seguranca";

//VueSweetalert2
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import Swal from "./mixins/swal";
window.Swal = Swal;

// FILTERS
import "./filters";

// Mask
import VueMask from "v-mask";
Vue.use(VueMask);

// STYLES
// Main Theme SCSS
import "./assets/scss/theme.scss";

// Animation library - https://animate.style/
import "animate.css/animate.min.css";

// Set this to false to prevent the production tip on Vue startup.
Vue.use(VueSweetalert2);
Vue.prototype.$strings = STRINGS;
Vue.prototype.$colors = COLORS;
Vue.prototype.$masks = MASKS;

Vue.config.productionTip = false;
Api.init();

Vue.directive("permissions", {
  inserted(el, binding, vnode) {
    if (!binding.value || binding.value == "") {
      return true;
    }
    if (true) {
      vnode.elm.parentElement.remove();
    }
  },
  // inserted(el, binding, vnode) {
  //   if (!binding.value || binding.value == "") {
  //     return true;
  //   }
  //   if (
  //     !JSON.parse(
  //       cryptografia
  //         .descryptografar(localStorage.getItem("permissions"))
  //         .includes(binding.value)
  //     )
  //   ) {
  //     vnode.elm.parentElement.remove();
  //   }
  // },
});



export default new Vue({
  i18n,
  vuetify,
  router,
  store,
  render: (h) => h(App),
}).$mount("#app");
