
require('./bootstrap');
require('../../../node_modules/metismenu/dist/metisMenu.min.js');

// Create Vue instance
const app = new Vue({
  el: 'body > div',
  data: {
    users: []
  },
  ready: function() {
    // Get users from API
    this.users = this.getUsers();
  },
  methods: {
    getUsers: () => {
      return [
        {
          id: 1,
          name: 'test'
        },
        {
          id: 2,
          name: 'test'
        },
        {
          id: 3,
          name: 'test'
        }
      ];
    }
  }
});


require('./scripts');
