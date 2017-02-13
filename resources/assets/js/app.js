
require('./bootstrap');
require('../../../node_modules/metismenu/dist/metisMenu.min.js');

// Create Vue instance
const app = new Vue({
  el: 'body > div',
  data: {
    users: []
  },
  created: function() {
    if ($('#users-table').length) this.getUsers();
  },
  methods: {
    getTargetButtonFromEvent: (event) => {
      var button = $(event.target).get(0);

      if (button.tagName === 'I')
        button = $(button).parent().get(0);

      return button;
    },
    getUsers: function() {
      axios.get('/api/users').then(res => {
        this.users = res.data;
      });
    },
    showDeleteUserModal: function(event) {
      var id = $(this.getTargetButtonFromEvent(event)).val();
      $('#users-delete button[name="deleteUser"]').val(id);
    },
    deleteUser: function(event) {
      var id = parseInt($(this.getTargetButtonFromEvent(event)).val());
      var self = this;

      axios.delete('/api/users/', {
        data: { id: id }
      })
      .then(res => {
        if (res.status === 204) {
          self.users = self.users.filter((user, index) => {
            if (user.id !== id) return user;
          });
        }
      })
      .catch(error => {
        console.error(error);
      });
    },
    createUser: function(event) {
      var form = $(this.getTargetButtonFromEvent(event)).parents('form');

    }
  }
});

require('./scripts');

// TODO: Notifications!
