<template>
    <div :class="'col-sm-' + (sm || '6') + ' col-md-' + (md || '4')">
        <div class="thumbnail">
        <img :src="image" alt="...">
        <div class="caption">
            <small>{{date | dateFormat}} - {{date_end | dateFormat}} | Hrs {{time}}</small>
            <p class="h3 text-center">{{title}}</p>
            <p>{{description}}</p>
            <p><span class="font-weight-bold">Local: </span>{{place}}</p>
            <p><a :href="link" class="btn btn-primary" role="button">Ler mais</a></p>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'description', 'link', 'image', 'date', 'date_end', 'time', 'organization', 'place', 'sm', 'md'],
        filters:{
            dateFormat: function(value){
                if(!value) return '';
                value = value.toString();
                value = value.split('-');
                return value[2] + '/' + value[1] + '/' + value[0];
            }
        }
    }
</script>
