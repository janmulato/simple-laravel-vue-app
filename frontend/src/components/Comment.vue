<template>
  <v-container>
    <div class="comments">
      <!-- ASSUME ALL COMMENT ARE POST ID 1 -->
      <p class="font-weight-bold">Write your comments down below! Don't forget to like and subscribe!</p>
      <comment-form
      class="mb-12"
      :postId="1"
      >
      </comment-form>
      <comment-card class="my-3" :comment="comment" :index="index" :depth="1" v-for="(comment, index) in comments" :key="comment.id">

      </comment-card>
    </div>
  </v-container>
</template>
<script>
import {mapState} from 'vuex';
import CommentCard from './CommentCard';
import CommentForm from './CommentForm';
export default {
  components: {
    CommentCard,
    CommentForm
  },
  computed: {
    ...mapState({
      comments: state => state.comments.items
    })
  },
  async created() {
    await this.$store.dispatch('comments/fetchComments', {
        postId: 1 // ASSUME ALL POST NEED TO RETRIEVE IS POST ID 1
      })
  }
}
</script>
