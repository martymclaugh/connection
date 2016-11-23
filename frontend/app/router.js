import Ember from 'ember';
import config from './config/environment';

const Router = Ember.Router.extend({
  location: config.locationType,
  rootURL: config.rootURL
});

Router.map(function() {
  // set users path
  this.route('users', { path: '/'})
  this.route('user', { path: 'user/:user_id'}, function (){
    this.route('friends');
  });
});

export default Router;
