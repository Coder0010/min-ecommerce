require("bootstrap");

import Vue from "vue"
import Swal from 'sweetalert2'
import NProgress from "nprogress";
import "nprogress/nprogress.css";
import { Form, AlertError, AlertErrors, HasError, AlertSuccess } from "vform";

import MainHelper from "./helpers/main-helper"
import CrudHelper from "./helpers/crud-modal-helper"

window.$ = window.jQuery = require('jquery');
window.Form = Form;
window.Swal = Swal;
window.Fire = new Vue();
window.NProgress = NProgress;

window.axios = require("axios");
window.axios.defaults.baseURL = '/api/';
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    if (error.response.status == 401) {
        setTimeout(function () {
            document.getElementById("logout-form").submit();
        }, 2000);
    }
    return Promise.reject(error);
});

Vue.mixin(MainHelper)
Vue.mixin(CrudHelper)

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)
Vue.component("pagination", require("laravel-vue-pagination"));

Vue.component("carts", require("./compontents/CartCompontent.vue").default);
Vue.component("products-show-as-card", require("./views/ProductShowAsCardView.vue").default);
Vue.component("products-show-as-table", require("./views/ProductShowAsTableView.vue").default);

if (process.env.NODE_ENV == "production") {
    Vue.config.devtools = false;
    Vue.config.productionTip = false
}

const app = new Vue({
    el: "#app",
    data: {
        cart: [],
    },
    methods: {
        addToCartMethod(row) {
            if (!this.cart.some(data => data.id === row.id)) {
                this.cart.push(row);
                this.$makeSweetAlert("success", `${row.name} added to cart`)
                $(`#btn-${row.id}`).hide();
            }
        },
        removeFromCartMethod(row) {
            if (this.cart.some(data => data.id === row.id)) {
                this.cart.shift(row);
                this.$makeSweetAlert("success", `${row.name} removed to cart`)
                $(`#btn-${row.id}`).show();
            }
        }
    },
});
