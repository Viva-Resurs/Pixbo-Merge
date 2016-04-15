// browserify entrypoint
var Vue = require('vue');

Vue.use(require('vue-resource'));
var vueboot = require('vueboot');
var bootstrap = require('bootstrap-sass');


import Schedule from './components/Schedule.vue';
import ScreenList from './components/ScreenList.vue';


Vue.config.debug = true

// Collect sessionStorage before Vue so that data is ready.
var _data = {};
try {
    _data = JSON.parse(sessionStorage.PixboData);
} catch (err) {
    console.log('Problem with JSON.parse : '+err);
    console.log('Trying to reset sessionStorage...');
    sessionStorage.PixboData = _data = '{}';
}
window._lang = (_data.lang) ? _data.lang : {} ;



// Import as global-mixin
Vue.mixin(require('./components/Cache.vue'));
Vue.mixin(require('./components/Translation.vue'));

window.Vue = new Vue({
    
    el: '#app',

    components: {
        'Alert': vueboot.alert,
        'Toast': vueboot.toast,
        Schedule,
        ScreenList,
    },

    data: function () {
        return {
            show: false,
        };
    },

    methods: {
        addAlert: function(toast) {
            vueboot.toastService.create(toast);
        },
    },

    events: {
        'add-alert': function(toast) {
            vueboot.toastService.create(toast);
        },
        'trans': function (string) {
            return this.trans(string);
        },
        'trans_choice': function (string) {
            return this.trans_choice(string);
        }
    },

    ready: function() {
        this.Load(); // Get currently stored Data
        this.$http.get('/api/locales', function(locale) {
            this.Set('lang',locale); // Update Lang-Data
        });
    },

});