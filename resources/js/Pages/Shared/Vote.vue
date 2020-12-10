<template>

    <div>
        <a :title="setTitle('up')" class="vote-up" :class="setClasses" @click="voteUp">
            <i class="fas fa-caret-up"></i>
        </a>

        <span class="vote-count">{{votesCount}}</span>
        <a :title="setTitle('down')" class="vote-down" :class="setClasses" @click="voteDown">
            <i class="fas fa-caret-down"></i>
        </a>
    </div>


</template>

<script>
export default {
    props:['model', 'name'],
    data() {
        return {
            votesCount: this.model.votes_count || 0
        }
    },
    computed: {
        setClasses() {
            return this.signIn ? '' : 'off';
        },

    },
    methods: {
        setTitle(voteType) {
            let titles = {
                up : `this ${this.name} is useful`,
                down: `this ${this.name} is not useful`
            }
            return titles[voteType];
        },
        _vote(vote, routeName) {
            if(!this.signIn){
                this.$toast.warning(`Pleas login frist to vote ${this.name}`, 'Warning', {
                    position: 'bottomLeft',
                    timeout: 3000
                })
                return false
            }
            const data = { id: this.model.id, routeName : this.name };
            this.$inertia.post(this.$route(this.name+'.vote', data), { vote: vote}, {
                onSuccess: (res) => {
                    console.log(res.props)
                    this.votesCount = res.props.flash.data.votesCount;
                    this.$toast.success(res.props.flash.successMsg, 'success', {
                        timeout: 3000,
                        position: "bottomLeft"
                    })
                }
            })
        },
        voteUp(){
            this._vote(1)
        },
        voteDown(){
            this._vote(-1)
        }
    }

}
</script>
