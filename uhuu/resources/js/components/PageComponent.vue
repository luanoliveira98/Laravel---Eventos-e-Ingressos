<template>
    <div class="container">
        <div v-bind:class="defineSize">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['size'],
        computed:{
            defineSize:function(){
                if(this.size >= 12){
                    return "col-md-12";
                } else if(this.size <= 6){
                    return "col-md-6 col-md-offset-3";
                } else if(this.size % 2 == 0){
                    return "col-md-"+this.size+" col-md-offset-"+((12 - this.size)/2);
                } else {
                    return "col-md-"+(parseInt(this.size) + 1)+" col-md-offset-"+((12 - (parseInt(this.size) + 1))/2);
                }
            }
        }
    }
</script>
