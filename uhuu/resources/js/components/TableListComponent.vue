<template>
    <div>
        <div class="form-inline mb-2 row">
            <div class="col-9">
                <a v-if="create && !modal" v-bind:href="create">Criar</a>
                <modal-link-component v-if="create && modal" type="link" name="add" title="Criar" css=""></modal-link-component>
            </div>
            <div class="form-group">
                <input type="search" placeholder="Search" class="form-control" v-model="search">
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="cursor: pointer" v-for="(title, index) in titles" :key="title.index" v-on:click="orderColumn(index)">{{title}}</th>
                    <th v-if="detail || edit || deleted">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="(list == '')" class="text-center font-weight-bold">
                    <td colspan="6">Nenhum registro cadastrado!</td>
                </tr>
                <tr v-for="(item, index) in list" :key="item.index">
                    <td v-for="i in item" :key="">{{i | dateFormat}}</td>
                    <td v-if="detail || edit || deleted">
                        <form v-bind:id="index" v-if="deleted && token" v-bind:action="deleted + item.id" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" v-bind:value="token">

                            <a v-if="detail" v-bind:href="detail+'/'+item.id">| Detalhe </a> 
                            
                            <a v-if="edit && !modal" v-bind:href="edit">| Editar |</a> 
                            <modal-link-component v-if="edit && modal" v-bind:url="edit" v-bind:item="item" type="link" name="edit" title="| Editar |" css=""></modal-link-component>
                            
                            <a v-on:click="executeForm(index)"> Deletar |</a>
                        </form>
                        <span v-if="!token">
                            <a v-if="detail" v-bind:href="detail+'/'+item.id">| Detalhe </a> 

                            <a v-if="edit && !modal" v-bind:href="edit">| Editar |</a> 
                            <modal-link-component v-if="edit && modal" v-bind:url="edit" v-bind:item="item"  type="link" name="edit" title="| Editar |" css=""></modal-link-component>
                            
                            <a v-if="deleted" v-bind:href="deleted">Deletar |</a>
                        </span>
                        <span v-if="token && !deleted">
                            <a v-if="detail" v-bind:href="detail+'/'+item.id">| Detalhe </a>

                            <a v-if="edit && !modal" v-bind:href="edit">| Editar |</a> 
                            <modal-link-component v-if="edit && modal" v-bind:url="edit" v-bind:item="item"  type="link" name="edit" title="| Editar |" css=""></modal-link-component>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props:['titles', 'items', 'order', 'orderCol', 'create', 'detail', 'edit', 'deleted', 'token', 'modal'],
        data: function(){
            return {
                search: '',
                orderAux: this.order || "asc",
                orderAuxCol: this.orderCol || 0
            }
        },
        methods:{
            executeForm: function(index){
                document.getElementById(index).submit();
            },
            orderColumn: function(column){
                this.orderAuxCol = column;
                if(this.orderAux.toLowerCase() == "asc"){
                    this.orderAux = "desc";
                } else {
                    this.orderAux = "asc";
                }
            }
        },
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
        computed:{
            list: function(){
                let list = this.items.data;
                let order    = this.orderAux;
                let orderCol = this.orderAuxCol;

                order = order.toLowerCase();
                orderCol = parseInt(orderCol);

                if(order == 'asc'){
                    list.sort(function(a,b){
                        if (Object.values(a)[orderCol] > Object.values(b)[orderCol]){
                            return 1;
                        } else if (Object.values(a)[orderCol] < Object.values(b)[orderCol]){
                            return -1;
                        } else {
                            return 0;
                        }
                    });
                } else {
                    list.sort(function(a,b){
                        if (Object.values(a)[orderCol] < Object.values(b)[orderCol]){
                            return 1;
                        } else if (Object.values(a)[orderCol] > Object.values(b)[orderCol]){
                            return -1;
                        } else {
                            return 0;
                        }
                    });
                }

                if (this.search){
                    return list.filter(res => {
                        res = Object.values(res);
                        for(let k = 0; k<res.length; k++){
                            if((res[k]+ "").toLowerCase().indexOf(this.search.toLowerCase()) >= 0){
                                return true;
                            }
                        }
                        return false;
                    });
                }

                return list;
            }
        }
    }
</script>
