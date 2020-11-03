<template>

    <div class="alert alert-success fade show alert-dismissible" role="alert">
        <strong>success</strong>{{successMsg}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times</span>
        </button>
    </div>


</template>

<script>

    export default {
        props: ['successMsg'],
    }

</script>
