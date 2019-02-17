<template>
    <div v-bind:class="defineColor">
        <div v-if="title" class="panel-heading h3">{{ title }}</div>

        <div class="panel-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'color'],
        computed:{
            defineColor: function(){
                return "panel "+ (this.color || "panel-default");
            }
        }
    }
</script>

<style media="screen">
    .blue {
        border-color: #0d4a96;
    }

    .blue > .panel-heading {
        color: #f7f7f7;
        background-color: #0d4a96;
        border-color: #0d4a96;
    }

    .orange {
        border-color: #e85e0d;
    }

    .orange > .panel-heading {
        color: #f7f7f7;
        background-color: #e85e0d;
        border-color: #e85e0d;
    }
</style>