<template>
    <div>
        <div class="d-flex align-items-center p-3 my-3  bg-purple rounded shadow-sm">
            <div class="ml-auto">
                <inertia-link :href="$route('questions.index')" class="btn btn-primary">Back To All Questions
                </inertia-link>
            </div>
        </div>
        <div class="container">
            <!-- <message> -->
            <form v-if="editMode">
                <div class="form-group">
                    <input type="email" class="form-control" v-model="question.title">
                </div>
                <div class="form-group">
                    <m-editor :body="question.body">
                        <textarea class="form-control" v-model="question.body"></textarea>
                    </m-editor>
                </div>
                <div class="form-group">
                    <button type="submit" @click.prevent="edit" class="btn btn-outline-success btn-sm">Submit</button>
                    <button type="button" @click.prevent="cancel" class="btn btn-outline-secondary btn-sm">Cancel</button>
                </div>
            </form>
            <div v-else class="my-3 p-3 bg-white rounded shadow-sm">

                <h3 class="border-bottom border-gray pb-2 mb-0 media-body">{{question.title}}</h3>
                <div class="media text-muted pt-3">
                    <div class="d-flex flex-column vote-control">
                        <vote name="question" :model="question"></vote>
                        <favorite :question="question"></favorite>
                    </div>
                    <div class="media-body">
                        <div class="media-body">
                            <div class="excerpt"> {{question.excerpt }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ml-auto">
                                <button type="button" class="btn btn-outline-primary btn-sm" v-if="canEdit"
                                    @click="handelEdit">Edit</button>
                                <button type="button" class="btn btn-outline-danger btn-sm " v-if="canDelete"
                                    @click="remove">Delete</button>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <user :model="question" label="Asked"></user>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <answers :question="question"></answers>
        </div>
    </div>
</template>

<script>
    import Favorite from './Favorite';
    import Vote from '../Shared/Vote'
    import Answers from '../Answers/Answers';
    import User from '../Shared/UserInfo'
    import MEditor from '../Shared/MEditor'

    export default {
        props: ['question'],
        data() {
            return {
                questionId: this.question.id,
                editMode: false,
                beforeCach: {}
            }
        },
        components: {
            Favorite,
            Vote,
            Answers,
            User,
            MEditor
        },

        methods: {
            edit() {
                this.editMode = false
                this.$inertia.put(this.$route('questions.update', {question: this.questionId}), {
                    body:  this.question.body,
                    title: this.question.title
                }, {
                    onSuccess: () => {
                        this.$toast.success(this.$page.props.flash.successMsg, 'Updated', {
                        timeout: 3000,
                        position: 'bottomLeft'
                    })
                    }
                })
                // .then(({data}) => {
                //     this.$toast.success(data.successMsg, 'Updated', {
                //         timeout: 3000,
                //         position: 'bottomLeft'
                //     })
                // })
            },
            cancel() {
                this.question.title = this.beforeCach.title
                this.question.body = this.beforeCach.body
                this.editMode = false
            },
            remove() {
                this.$toast.question('Delete', 'Are you sure?', {
                    timeout: 2000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Hey',
                    message: 'Are you sure about that?',
                    position: 'center',
                    buttons: [
                        ['<button><b>YES</b></button>', (instance, toast) => {

                            axios.delete(this.$route('questionsdestroy', [this.questionId]))
                            .then(({successMsg}) => {
                                this.$toast.success(successMsg, 'Success', {
                                    timeout: 3000,
                                    position: 'bottomLeft'
                                })
                                setTimeout(() => {
                                    window.href.location = this.$route('questions.index')
                                }, 3000)
                            })

                        }, true],
                        ['<button>NO</button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                })
            },
            handelEdit() {
                this.editMode = true
                this.beforeCach.title = this.question.title
                this.beforeCach.body = this.question.body
            }
        },
        computed: {
            canEdit() {
                return this.authorization('modify', this.question)
            },
            canDelete() {
                return this.authorization('deleteQuestion', this.question)
            },
        }
    }

</script>
