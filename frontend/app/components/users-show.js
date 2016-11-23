import Ember from 'ember';

export default Ember.Component.extend({
  willRender() {
    $.getJSON('/').then(data => {
      console.log("lalala");
      this.set('user', data);
      });
    }
});
