require("./bootstrap");

require("alpinejs");

window.Vue = require("vue");

import Vue from "vue";
require("./components/news/addnews").default;

const app = new Vue({
    el: "#app",
});
