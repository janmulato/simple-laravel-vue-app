<template>
  <div class="my-3">
    <v-card :style="offset">
      <v-card-text class="text-left body-2">
        <p>
          {{$_.get(comment, 'name')}}
          | &nbsp;<span>{{$_.get(comment, 'created_at') | date}}</span>
        </p>
        <p class="font-weight-bold" v-html="$_.get(comment, 'comment', '')">
        </p>
      </v-card-text>
      <v-divider></v-divider>
      <v-card-actions>
        <v-layout wrap justify-end>
          <v-col v-if="showReplyForm">
            <!-- POST ID ALWAYS 0 BECAUSE IT ALWAYS WILL BE A REPLY -->
            <comment-form
            @success="showReplyForm = false"
            :postId="0"
            :id="$_.get(comment, 'id')"
            :depth="depth"
            :index="index"
            @cancel="showReplyForm=false"></comment-form>
          </v-col>
          <div v-else-if="(depth % 3 === 0)">
            <p class="font-weight-bold caption">You can't reply to this comment</p>
          </div>
          <div v-else>
            <v-btn  class="primary" @click="showReplyForm = true">Reply</v-btn>
          </div>
        </v-layout>
      </v-card-actions>
    </v-card>
    <template v-if="replies">
      <comment-card :commentId="$_.get(comment, 'id')" :comment="reply" :index="index" :depth="depth+1" v-for="(reply, index) in replies" :key="reply.id">

      </comment-card>
    </template>
  </div>
</template>
<script>
import CommentForm from './CommentForm'
const COLORS = [
    'white',
    'lightgray',
    'lightblue',
    'lightcyan',
    'lightskyblue',
    'lightpink',
];

export default {
  name: 'comment-card',
  components: {
    CommentForm
  },
  props: {
    comment: {
      type: Object,
      required: true
    },
    index: {
      type: Number,
      default: 0
    },
    depth: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
      showReplyForm: false,
      MAX_REPLY: 3
    }
  },
  computed: {
    replies() {
      return this.$_.get(this.comment, 'recent_comments', [])
    },
    offset() {
      return {
          'margin-left': ((this.depth - 1) * 20) + 'px',
          'background-color': COLORS[this.depth % COLORS.length],
      };
    },
  }
}
</script>
