<template>
    <div>
        <a v-if="canAccept" :class="setClasses" @click="setAsBestAnswer">
            <i class="fas fa-check"></i>
        </a>
        <a v-if="accepeted" :class="setClasses">
            <i class="fas fa-check"></i>
        </a>
    </div>
</template>

<script>
import eventBus from '../../Helpers/event-bus'
import EventBus from '../../Helpers/event-bus'
export default {

    props: ['answer'],
    data() {
        return {
            isBest: this.answer.is_best,
        }
    },
    methods: {
        setAsBestAnswer() {
            this.$inertia.post(this.$route('answer.accept', this.answer.id ))
            .then(res => {
                this.$toast.success('Set As Best Answer', 'success', {
                    timeout: 3000,
                    position: 'bottomLeft'
                })
                this.isBest = true;
                eventBus.$emit('accepted', this.answer.id)
            })
        }
    },
    created() {
        EventBus.$on('accepted', id => {
             this.isBest= (id === this.answer.id)
        })
    },
    computed: {
        accepeted() {
            return !this.canAccept && this.isBest;
        },
        setClasses() {
            return ["mt-2", this.isBest ? 'accepted' : ''];
        },
        canAccept() {
            return this.authorization('accept', this.answer);
        },
    }
}
</script>
