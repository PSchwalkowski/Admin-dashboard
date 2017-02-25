
require('./bootstrap');
require('../../../node_modules/metismenu/dist/metisMenu.min.js');

Vue.component('users', require('./components/Users.vue'));

// Create Vue instance
const app = new Vue({
  el: 'body > div',
  data: {
    users: [],
		user: {}
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
      var button = $(event.target).get(0);

      if (button.tagName === 'I')
        button = $(button).parent().get(0);

      return button;
    }
  }
});

require('./scripts');

// TODO: Notifications!
