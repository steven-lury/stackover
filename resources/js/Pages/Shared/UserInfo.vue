<template>

        <div class="media-body">
            <small>{{label}} :</small><strong>{{PostDate}}</strong>
            <div class="media mt-2">
                <div class="media-body text-center">
                    <img :src="user.avatar">
                    <small>{{user.name}}</small>
                </div>
            </div>
        </div>

</template>

<script>

export default {

    props: ['label', 'model'],

    computed:{

        PostDate(){
            return this.model.date;
        }
    },
    data () {
        return {
            user : this.model.user
        }
    }

}

</script>
