/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import { createApp } from "vue";

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from "./components/ExampleComponent.vue";
import promosi from "./components/promosi.vue";
import navbar from "./components/navbar.vue";
import cta from "./components/cta.vue";
import product from "./components/product.vue";
import foot from "./components/foot.vue";

app.component("foot", foot);
app.component("product", product);
app.component("cta", cta);
app.component("navbar", navbar);
app.component("promosi", promosi);
app.component("example-component", ExampleComponent);

app.mount("#app");
