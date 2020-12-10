<template>

    <div>
        <a :disabled="!signIn" @click.prevent="handleFavorite" class="favorite mt-2" :class="setFavoriteClass">
        <i class="fa fa-star"></i>
        </a>
        <span class="favorite-count" >{{favoriteCount}}</span>
    </div>


</template>

<script>
export default {
    props: ['question'],
    data() {
        return {
            isFavorite: this.question.is_favorite,
            favoriteCount : this.question.favorite_count
        }
    },
    computed: {
        setFavoriteClass() {
            return !this.signIn ? 'off' : (this.isFavorite ? 'favorited' : '');
        },
    },
    methods: {
        handleFavorite () {
            if( !this.signIn){
                this.$toast.warning('Please Login Frist', 'Warning', {
                    timeoute: 3000,
                    position: 'bottomLeft',
                })
                return;
            }
            this.isFavorite ? this.removeFavorite() : this.addFavorite();
        },
        removeFavorite () {
            this.$inertia.delete(this.$route('question.favorite',this.question.id), {
                onSuccess: () => {
                    console.log('destory')
                    this.favoriteCount--;
                    this.isFavorite = false;
                }
            })

        },
        addFavorite () {
            this.$inertia.post(this.$route('question.favorite',this.question.id), {

            }).then(res => {
                console.log('create')
                    this.favoriteCount++;
                    this.isFavorite = true;
            })
        }
    }
}
</script>
