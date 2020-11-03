<template>

    <div class="container">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <div class="media-body text-right">
                <button type="button" class="btn btn-sm btn-outline btn-primary" @click.prevent="handleEdit">edit</button>
                <button type="button" class="btn btn-sm btn-outline btn-danger"  @click.prevent="handelDelete" >delete</button>
            </div>
            <h2 class="border-bottom border-gray mt-3 pb-2 mb-0 media-body">
                <!-- <inertia-link :href="this.$route('questions.show', question.slug)">{{question.title}}</inertia-link> -->
            </h2>
            <div class="media text-muted pt-3">
                <div class="row">
                    <div class="col-md-2">
                        <div class="d-flex flex-column counter">
                            <div class="vote">
                                <i class="fa fa-thumbs-up"></i><strong> {{question.vote}} </strong>
                            </div>
                            <div class="status" :class="Status">
                                <i class="fa fa-comment-dots"></i><strong> {{question.answers_count}}</strong>
                            </div>
                            <div class="views">
                                <i class="fa fa-eye"></i><strong> {{question.views}} </strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-9">
                                <p class="media-body">
                                    {{question.excerpt}}
                                </p>
                            </div>
                            <div class="col-md-3">
                                <user-info label="Asked" :model="question"></user-info>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import UserInfo from './../Shared/UserInfo';

export default {
    props: ['question'],

    components:{
        UserInfo,
    },

    data(){
        return {
            editMode: false,
            id: this.question.id
            };

    },

    methods:{
        StrPlural(text, count){
            return count > 1 ? text+'s' : text;
        },
        handleEdit(){
            this.$emit('editQuestionRequest', this.question)
        },
        handelDelete(){
            this.$toast.question('Delete', 'Are you sure?', {
                timeout: 20000,
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

                        this.$inertia.delete(`questions/${this.id}`, {
                            onSuccess: () =>{
                                alert();
                            }
                        })

                    }, true],
                    ['<button>NO</button>', function (instance, toast) {

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                    }],
                ],
            })
        }
    },
    computed:{
        Status(){
            return this.question.status;
        }
    }


}
</script>
