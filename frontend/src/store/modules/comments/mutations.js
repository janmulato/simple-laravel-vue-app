import _ from 'lodash';
export default {
  SET_LOADING(state, data) {
    state.loading = data;
  },
  SET_ITEMS(state, data) {
    state.items = data;
  },
  ADD_COMMENT(state, data) {
    state.items.unshift(data);
  },
  ADD_REPLY(state, data) {
    let comment = {}
    if (data.depth > 1) {
      comment = _.filter(state.items, { recent_comments: [ { id: data.id } ]}).shift();
    } else {
      comment = _.find(state.items, {id: data.id})
    }

    console.log(comment);
    if (comment) {
      if (data.depth > 1) {
        comment.recent_comments[data.index].recent_comments.unshift(data.comment)
      } else {
        comment.recent_comments.unshift(data.comment);
      }
    }
  }
}
