<template>
    <div class="row my-4">
        <div class="col-12 text-center" v-if="image">
            <img v-bind:src="image" class="figure-img img-fluid rounded m-4">
        </div>
        <div class="col-12" v-if="description">
            <p>{{description}}</p>
        </div>
        <div v-for="field in fields" :key="field['key']" :class="'col-'+field['col']">
            <span class="font-weight-bold">{{field['name']}}: </span>{{field['value'] | dateFormat}}
        </div>
        <div class="mt-5">
            <modal-link-component v-if="tickets && !guest && !sold" type="link" name="add" title="Comprar Ingressos" css="btn btn-primary"></modal-link-component>
            <modal-link-component v-if="tickets && guest && !sold" type="link" name="login" title="Comprar Ingressos" css="btn btn-primary"></modal-link-component>
            <a href="#" v-if="sold" class="btn btn-danger">Ingressos Esgotados</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['image', 'description', 'fields', 'tickets', 'guest', 'sold'],
        filters:{
            dateFormat: function(value){
                if(!value) return '';
                value = value.toString();
                if(value.split('-').length == 3){
                    value = value.split('-');
                    return value[2] + '/' + value[1] + '/' + value[0];
                }
                return value;
            }
        },
    }
</script>
