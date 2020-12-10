<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>{{setCountAnswer}}</h5>
                        </div>
                        <answer @removeAnswer="deleteAnswer(index)" v-for="(answer, index) in answers" :key="index" :answer="answer"></answer>
                        <div class="text-center" v-if="nextPageUrl">
                            <button type="button" class="btn btn-outline-success" @click="fetch(nextPageUrl)">more</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <create-answer @answerCreated="postAnswer" :question-id='question.id'></create-answer>
    </div>

</template>

<script>
import Answer from './Answer';
import CreateAnswer from './CreateAnswer';

export default {

    props: ['question'],
    data() {
        return {
            questionId : this.question.id,
            answers: [],
            nextPageUrl: null,
            count: this.question.answers_count
        }
    },
    created () {
        this.fetch(this.$route('questions.answers.index', this.questionId))
    },
    components: {
        Answer,
        CreateAnswer
    },
    methods: {
        fetch(url) {
            // this.$inertia.get(url, {
            //     onSuccess: (res) => {
            //         console.log(res)
            //     }
            // })
            axios.get(url)
            .then(({data}) => {
                this.answers.push(...data.data)
                this.nextPageUrl = data.next_page_url
            })

        },
        deleteAnswer(index){
            this.answers.splice(index, 1)
            this.count--
        },
        postAnswer(answer) {
            this.answers.push(answer)
            this.count++
        },

    },
    computed: {
        setCountAnswer() {
            return this.count+ (this.count > 1 ? ' Answers' : ' Answer')
        }

    }

}
</script>
