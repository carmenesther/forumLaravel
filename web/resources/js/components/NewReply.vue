<template>
<div>
    <div v-if="signedIn">
        <div class="form-group">
            <editor name="body" v-model="body" placeholder="Have something to say" :shouldClear="completed"></editor>
            </textarea>
        </div>
        <button type="submit"
                class="btn btn-primary"
                required
                @click="addReply">Post</button>
    </div>

    <p class="text-center" v-else>
        Please <a href="/login">sign in</a> or
        <a href="/register">register</a>
        to participate in this discussion
    </p>

</div>

</template>

<script>
    import 'jquery.caret';
    import 'at.js';

    export default {
       data(){
           return {
               body:'',
               completed: false
           };
       },

        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function(query, callback){
                        $.getJSON("/api/users", {name: query}, function (usernames){
                           callback(usernames)
                        });
                    }
                }
            });
        },

        methods: {
           addReply() {
               axios.post(location.pathname + '/replies', { body: this.body })
               .catch(error => {
                    flash(error.response.data, 'danger');
               })
               .then(({data}) => {
                   this.body = '';
                   this.completed = true;

                   flash('Your reply has been posted.');

                   this.$emit('created', data);
               });

           }
        }
    }
</script>

