
require('./bootstrap');
require('../../../node_modules/metismenu/dist/metisMenu.min.js');

// Create Vue instance
const app = new Vue({
  el: 'body > div',
  data: {
    users: []
  },
  methods: {
    getUsers: function() {
      axios.get('/api/users').then(res => {
        this.users = res.data;
      });
    },
    deleteUser: function(event) {
      console.log(event);
    }
  }
});

$(function() {
  if ($('#users-table').length) app.getUsers();
});

require('./scripts');
