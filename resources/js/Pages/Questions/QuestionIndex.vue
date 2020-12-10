<template>

    <master-layout>
        <form  @submit.prevent="handelUpdateOrCreate">
            <div class="modal fade" tabindex="-1" role="dialog" id="myModal" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="element.title">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="10" v-model="element.body"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="clearInput" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </form>

        <div class="d-flex align-items-center p-3 my-3  bg-purple rounded shadow-sm">
            <h6 class="mb-0 lh-100">All Questions</h6>
            <div class="ml-auto">
                <button type="button" @click="createQuestionRequest" class="btn btn-primary">Ask A Question</button>
            </div>
        </div>
        <question @editQuestionRequest="editQuestionRequest($event)" v-for="question in questions" :question="question" :key="question.id"></question>

    </master-layout>
</template>

<script>
    import MasterLayout  from './../../Layouts/MasterLayout';
    import Question from './Question';
    import CreateForm from './CreateForm';

    export default {

        props:['questions'],

        data() {
            return{
                element :{
                    title: '',
                    body: '',
                    id: null
                },
                editMode: false,
                createMode: false,
            }
        },

        components: {
            MasterLayout,
            Question,
            CreateForm
        },
        methods:{
            handelUpdateOrCreate() {
                if( this.editMode) {
                    this.updateQuestion();
                }else if(this.createMode) {
                    this.createQuestion();
                }
            },
           editQuestionRequest(event) {
                $('#myModal').modal('show');
                this.editMode = true;
                this.element.title = event.title;
                this.element.body = event.body;
                this.element.id = event.id;
            },
            updateQuestion(){
                this.$inertia.put(`questions/${this.element.id}`, this.element, {
                    onFinish: () => {
                            this.$toast.success('Update', this.$page.props.flash.successMsg, {
                                timeout: 5000,
                                position: 'bottomLeft'
                            })
                            this.clearInput()
                            this.editMode = false
                        }
                })

            },
            createQuestionRequest() {
                $('#myModal').modal('show');
                this.createMode = true
                this.editMode = false
            },
            createQuestion() {
                this.$inertia.post(this.$route('questions.store'), {
                        title: this.element.title,
                        body: this.element.body
                        },
                        {
                            onSuccess: () => {
                                this.clearInput();
                                this.createMode= false
                                this.$toast.success(this.$page.props.flash.successMsg, 'success', {
                                    timeout: 3000,
                                    position: 'bottomLeft'
                                })
                            }
                        }

                )
                // .then(({data}) => {
                //     this.clearInput();
                //     this.createMode= false
                //     this.$toast.success(data.successMsg, 'success', {
                //         timeout: 3000,
                //         position: 'bottomLeft'
                //     })
                // })
            },
            clearInput() {
                this.element.title = ''
                this.element.body = ''
                $('#myModal').modal('hide');
            }
        }
    }
</script>



