<template>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Post Your Answer</h5>
                    </div>
                    <hr>
                        <div class="form-group">
                            <textarea v-model="body" rows="4" class="form-control" :class="errorClass"></textarea>
                            <div class="invalid-feedback">
                                {{showError}}
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" @click="postAnswer" class="btn btn-lg btn-outline-primary">Send</button>
                        </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
export default {
    props: ['errors', 'questionId'],
    data() {
        return {
            body: ''
        }
    },
    methods: {
        postAnswer() {
            axios.post(this.$route('questions.answers.store', {question : this.questionId}), {
                body: this.body
            }).then(({data}) => {
                console.log(data)
                this.$emit('answerCreated', data.answer)
                this.body = ''
                this.$toast.success(data.successMsg, 'Create',  {
                    timeout: 5000,
                    position: 'bottomLeft'
                })
            })

        }
    },
    computed:{
        errorClass() {
            return this.$page.props.errors.body ? 'is-invalid' : '';
        },
        showError() {
            return this.$page.props.errors.body != '' ? this.$page.props.errors.body : '';
        }
    }
}
</script>
