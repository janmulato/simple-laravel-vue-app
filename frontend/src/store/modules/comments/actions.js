import _ from 'lodash';
import api from '../../../plugins/axios';

export default {
  async addComment(context, {params, depth = 0, index = 0}) {
    try {
      context.commit('SET_LOADING', true);
      let postId = _.get(params, 'postId', 0)
      let response = await api.client.post(`comments/${postId}`, params);
      if(!_.get(response, 'recent_comments')) {
        response.recent_comments = [];
      }

      if (postId) {
        context.commit('ADD_COMMENT', response)
      } else {
        context.commit('ADD_REPLY', {
          id: params.reply_id,
          depth: depth,
          index: index,
          comment: response
        })
      }

      return response;
    } catch(err) {
      console.log(err, 'error');
      throw err
    } finally {
      context.commit('SET_LOADING', false)
    }
  },
  async fetchComments(context, params) {
    try {
      context.commit('SET_LOADING', true);
      let postId = _.get(params, 'postId', 0)
      let response = await api.client.get(`comments/${postId}`);
      console.log(response);
      context.commit('SET_ITEMS', response)
      return response;
    } catch(err) {
      console.log(err);
      context.commit('SET_ITEMS', []);
      throw err;
    } finally {
      context.commit('SET_LOADING', false);
    }

  },
}
