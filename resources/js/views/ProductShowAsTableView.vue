<template>
    <div class='container'>
        <div class='card justify-content-center'>
            <div class='card-header d-flex justify-content-between align-items-center text-center'>
                <span> Merchant Products </span>
                <button @click="$handleAction('create')" class="btn btn-info"> create </button>
            </div>
            <div class='card-body p-1'>
                <div class='table-responsive'>
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">name</th>
                                <th scope="col">price</th>
                                <th scope="col">actions</th>
                            </tr>
                        </thead>
                        <tbody v-if="entityTableResults && entityTableResults.length > 0">
                            <tr v-for="(row, i) in entityTableResults" :key="i" :id="`tr-${row.id}`">
                                <th scope="row">{{ row.name }}</th>
                                <td>{{ row.price }}</td>
                                <td>
                                    <button @click="$handleAction(`edit`, row)" class="btn btn-sm btn-clean btn-icon btn-info"> <i class="fa fa-edit fa-1x"></i> </button>
                                    <button @click="$handleAction(`delete`, row)" class="btn btn-sm btn-clean btn-icon btn-danger"> <i class="fa fa-trash fa-1x"></i> </button>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else class="text-center">
                            <tr>
                                <td colspan="100" class="align-middle text-info"> there is no data </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <create-or-update-modal :resourceUrl="resourceUrl" :form="createOrUpdateForm" :modalID="createOrUpdateModalID" :mode="addMode" :merchant="merchant"/>
    </div>
</template>
<script>
    import CreateOrUpdateModal from "./CreateOrUpdateModal";
    export default {
        components: {
            CreateOrUpdateModal,
        },
        props: {
            //
        },
        data(){
            return {
                limit: 5,
                resourceUrl: 'products',
                entityTableResults: [],
                merchant: {},
                addMode: true,
                createOrUpdateModalID: 'product-create-or-update-modal',
                createOrUpdateForm: new Form({
                    id: '',
                    name: '',
                    price: '',
                    merchant_id: '',
                    description: '',
                }),
            }
        },
        mounted(){
            this.$showTableData(`${this.resourceUrl}/merchant`);
            this.getMerchantInfo()
        },
        created(){
            Fire.$on("refreshProductTable", () => {
                this.$showTableData(`${this.resourceUrl}/merchant`);
            });
        },
        methods:{
            getMerchantInfo() {
                this.merchant = window.LoggedMerchant
            },
        },
        computed:{
            //
        }
    }
</script>
