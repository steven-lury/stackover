<template>

    <div>
        <div class="media">
            <div class="d-flex flex-column vote-control">
                <vote name='answer' :model="answer"></vote>
                <accept :answer='answer'></accept>
            </div>
            <div class="media-body" >
                <div v-html="bodyHtml" v-if="!editMode"></div>
                <!-- Edit input -->
                    <div class="col-md-12" v-if="editMode">
                        <div class="form-group">
                            <textarea v-model="answer.body" rows="4" class="form-control" ></textarea>
                            <div class="invalid-feedback">
                                <!-- {{showError}} -->
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" @click="edit"  class="btn btn-xs btn-outline-primary">Update</button>
                            <button type="button" @click="cancel"  class="btn btn-xs btn-outline-secondary">Cancel</button>
                        </div>

                    </div>
                <!-- End edit input -->
                <div class="row ml-auto" v-else>
                    <div class="col-md-4">
                        <div v-if="canEdit">
                            <button type="button" class="btn btn-outline-primary btn-xs" @click="handelEdit">Edit</button>
                        </div>

                        <div v-if="canDelete">
                            <button type="button" class="btn btn-sm btn-outline-danger" @click.prevent="remove" >Delete</button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <user :model="answer" label="Answered"></user>
                    </div>
                </div>
            </div>

        </div>
        <hr>
    </div>

</template>

<script>
import User from "../Shared/UserInfo";
import Accept from "./Accept";
import Vote from "../Shared/Vote";
import Mixin from "../../Helpers/mixins"

export default {
    props:['answer'],
    mixins: [Mixin],
    data() {
        return {
            questionId : this.answer.question_id,
            beforEditBody: null
        }

    },

    components: {
        User,
        Accept,
        Vote
    },
    methods: {
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

                        this.$inertia.delete(this.$route('questions.answers.destroy', [this.questionId, this.answer.id]), {
                            onSuccess: () =>{
                                this.$emit('removeAnswer')
                            }
                        })

                    }, true],
                    ['<button>NO</button>', function (instance, toast) {

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                    }],
                ],
            })
        },
        handelEdit() {
            // "$route('questions.answers.edit', [questionId, answer.id])"
            this.editMode = !this.editMode;
            this.beforEditBody = this.answer.body
        },
        cancel() {
            this.answer.body = this.beforEditBody
            this.editMode = ! this.editMode
        },
        edit() {
            this.$inertia.patch(this.$route('questions.answers.update', [this.questionId, this.answer.id]), { body: this.answer.body}, {
                onSuccess: (res) => {
                    this.$toast.success('Your answer updated successfully', 'success', {
                        timeout: 3000,
                        position: 'bottomLeft'
                    })
                    console.log(res)
                    this.editMode = false
                    this.answer.body_html = this.answer.body
                }
            })
        }
    },
    computed: {
        bodyHtml() {
            return this.answer.body_html;
        },
        canEdit() {
            return this.authorization('modify', this.answer)
        },
        canDelete() {
            return this.authorization('deleteAnswer', this.answer)
        }
    }
}
</script>
