<template>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#write">Write</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#preview">Preview</a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane active" id="write">
                <slot/>
            </div>
            <div class="tab-pane" id="preview" v-html="preview">

            </div>
        </div>
    </div>
</template>

<script>

import MarkdownIt from 'markdown-it'
import prism from 'markdown-it-prism'
import AutoSize from 'autosize'
import "prismjs/components/prism-clike"
import "prismjs/components/prism-java"
import "prismjs/components/prism-php"
import "prismjs/components/prism-javascript"
const md = new MarkdownIt();
md.use(prism);

export default {

    props: ['body'],
    computed: {
        preview() {
            console.log('preview')
            return md.render(this.body)
        }
    },
    updated() {
        AutoSize(this.$el.querySelector('textarea'))
    },
    mounted() {
        AutoSize(this.$el.querySelector('textarea'))
    }
}
</script>
