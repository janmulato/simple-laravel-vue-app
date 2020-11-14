<template>
  <v-card>
    <v-card-text class="pa-0">
      <v-text-field
      v-model="comment.name"
      dense
      outlined
      class="pa-2"
      label="Name*"
      :error-messages="nameErrorMessage"
      >
      </v-text-field>
      <v-textarea
      v-model="comment.description"
      dense
      outlined
      class="pa-2"
      label="Comment*"
      :error-messages="commentErrorMessage"
      >
      </v-textarea>
    </v-card-text>
    <v-card-actions>
      <v-layout wrap justify-end>
        <div>
          <v-btn @click="cancel">Cancel</v-btn>
          <v-btn :disabled="loading" class="primary mx-5" @click="submit">Submit</v-btn>
        </div>
      </v-layout>
    </v-card-actions>
  </v-card>
</template>
<script>
import { required } from 'vuelidate/lib/validators'

export default {
  props: {
    postId: {
      type: [Number, String]
    },
    id: {
      type: [Number, String]
    },
    depth: {
      type: Number,
      default: 0
    },
    index: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
      comment: {
        name: '',
        description: ''
      },
      loading: false
    }
  },
  computed: {
    nameErrorMessage() {
      return this.$v.comment.name.$error ? 'Name is required.' : ''
    },

    commentErrorMessage() {
      return this.$v.comment.description.$error ? 'Comment is required.' : ''
    }
  },
  validations: {

    comment: {
      name: {
        required,
      },
      description: {
        required
      }
    }
  },
  methods: {
    // Cancel action emit cancel to the component will be use in the parent
    cancel() {
      this.reset();
      this.$emit('cancel', true);
    },
    // Reset  all the values and validation
    reset() {
      this.$v.$reset();
      this.comment = {
        name: '',
        description: ''
      }

    },

    async submit() {
      this.loading = true;
      this.$v.$touch();

      if (this.$v.$pending || this.$v.$error) {
        return;
      }

      try {
        await this.$store.dispatch('comments/addComment', {
          params: {
            ...this.comment,
            postId: this.postId,
            reply_id: this.id
          },
          depth: this.depth,
          index: this.index
        });
        this.reset();
        this.$emit('success', true)
      } catch (err) {
        console.log(err);
      } finally {
        this.loading = false;
      }

    }
  }
}
</script>
