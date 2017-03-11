
require('./bootstrap');
require('../../../node_modules/metismenu/dist/metisMenu.min.js');

// Vue.component('auth-login', require('./components/Auth/Login.vue'));

Vue.component('users', require('./components/Users.vue'));
Vue.component('roles', require('./components/Roles.vue'));
Vue.component('media', require('./components/Media.vue'));
Vue.component('settings', require('./components/Settings.vue'));

// Create Vue instance
const app = new Vue({
  el: '.app',
  data: {
		user: {},
    users: [],
    roles: [],
		files: [],
		settings: []
  },
	created: function() {
		this.user = currentUser;
	},
  methods: {

		/**
		 * Get button element from event target
		 * Mostly used with onclick
		 * @param  {event} event DOM Event Object
		 * @return {object} DOM Element
		 */
    getTargetButtonFromEvent: (event) => {
      var button = event.target;

      if (button.tagName === 'I')
        button = button.parentNode;

      return button;
    }
  }
});

require('./scripts');

// TODO: Notifications!
