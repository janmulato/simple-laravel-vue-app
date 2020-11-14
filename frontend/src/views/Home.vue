<template>
  <div class="home">
    <v-row>
      <v-col class="xs-12">
        <Comment/>
      </v-col>
    </v-row>
    <!-- <img alt="Vue logo" src="../assets/logo.png"> -->
    <!-- <HelloWorld msg="Welcome to Your Vue.js App"/> -->
  </div>
</template>

<script>
// @ is an alias to /src
import Comment from '@/components/Comment.vue'

export default {
  name: 'Home',
  components: {
    Comment
  }
}
</script>
