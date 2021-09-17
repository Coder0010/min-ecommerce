<template>
    <div>
        <div v-if="entityTableResults.length" class="row">
            <div v-for="(row, i) in entityTableResults" :key="i" class="mb-1 mt-1 col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="card" :class="{'border-danger' : row.logged_is_owner}" :id="`card-${row.id}`">
                    <div class="card-body">
                        <h4 class="card-title">{{ row.name }}</h4>
                        <h6 class="card-subtitle">Merchant: <span class="text-muted"> {{ row.merchant_name }} </span></h6>
                        <p class="card-text mt-1 mb-1">{{ row.description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="price text-success mt-3 mb-0">{{ row.price }}</h5>
                            <a v-if="row.logged_is_owner != true" @click="append(row)" :id="`btn-${row.id}`" href="#" class="btn btn-danger mt-3">
                                <i class="fa fa-shopping-cart fa-fw"></i> Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="col alert alert-info">
            there is no products
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            //
        },
        data(){
            return {
                resourceUrl: 'products',
                entityTableResults: [],
            }
        },
        mounted(){
            this.$showTableData(this.resourceUrl);
        },
        methods:{
            append(row){
                this.$emit('add-item-cart', row);
            }
        },
    }
</script>
