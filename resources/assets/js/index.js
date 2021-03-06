
// Import 3rd party libraries
window.$ = window.jQuery = require('jquery');

window.Vue = require('vue');
window.VueRouter = require('vue-router');
Vue.use(VueRouter);
import * as vueForm from 'vue-form';
window.VueStrap = require('vue-strap/dist/vue-strap.min.js');

require('bootstrap-sass');

window.moment = require('moment');
$.fn.datetimepicker = require('eonasdan-bootstrap-datetimepicker');
require('bootstrap-select');
require('dropzone');

// Import the actual routes, aliases, ...
import { configRouter } from './routes';

// declare global mixins
Vue.mixin(require('./mixins/Translation.vue'));
Vue.mixin(require('./mixins/RouterHelpers.vue'));
Vue.mixin(require('./mixins/ErrorHandler.vue'));

// Create our router object and set options on it
const router = new VueRouter();

// Inject the routes into the VueRouter object
configRouter(router);

// Configure the application
window.config = require('./config');
Vue.config.debug = true;

// Configure our HTTP client
var rest = require('rest');
var pathPrefix = require('rest/interceptor/pathPrefix');
var mime = require('rest/interceptor/mime');
var defaultRequest = require('rest/interceptor/defaultRequest');
var errorCode = require('rest/interceptor/errorCode');
var interceptor = require('rest/interceptor');
var jwtAuth = require('./interceptors/jwAuth.js');

window.client = rest.wrap(pathPrefix, { prefix: config.api.base_url })
    .wrap(mime)
    .wrap(defaultRequest, config.api.defaultRequest)
    .wrap(errorCode, { code: 400 })
    .wrap(jwtAuth);

// Bootstrap the app
Vue.use(vueForm);
Vue.component('nav-component', require('./components/Nav.vue'));
Vue.component('footer-component', require('./components/Footer.vue'));
Vue.component('loading', require('./components/Loading.vue'));
Vue.component('loadingthumb', require('./components/LoadingThumb.vue'));
Vue.directive("dropzone",require('./directives/Dropzone.vue'));
Vue.directive("tooltip",require('./directives/Tooltip.vue'));
Vue.directive("popover",require('./directives/Popover.vue'));
const App = Vue.extend(require('./App.vue'));

router.start(App, '#app');
window.router = router;
