<template>
    <div :id="modalID" :aria-labelledby="`${modalID}-label`" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 :id="`${modalID}-label`" class="modal-title"> {{ (mode ? 'create' : 'update') }} </h5>
                </div>
                <form @submit.prevent="mode ? $storeMethod(`merchants/${merchant.id}/products`, modalID) : $updateMethod(`products/${form.id}`, modalID)">
                    <div class="modal-body p-2">
                        <div class="col-12 mt-1 mb-1 p-3">
                            <div class="row">
                                <div class="col-lg-6 form-group" id="nameContainer">
                                    <label class="col-form-label" for="name"> name <span class="text-danger">*</span> </label>
                                    <input type="text" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" id="name">
                                    <has-error :form="form" field="name"></has-error>
                                </div><!-- NameContainer -->
                                <div class="col-lg-6 form-group" id="priceContainer">
                                    <label class="col-form-label" for="price"> price <span class="text-danger">*</span> </label>
                                    <input type="number" v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }" class="form-control" id="price">
                                    <has-error :form="form" field="price"></has-error>
                                </div><!-- PriceContainer -->
                                <div class="col-lg-12 form-group" id="descriptionContainer">
                                    <label class="col-form-label" for="description">description <span class="text-danger">*</span></label>
                                    <textarea id="description" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" class="form-control" cols="50" rows="3"></textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div><!-- descriptionContainer -->
                            </div>
                        </div><!-- body data-->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary text-black ml-2" data-dismiss="modal" type="button"> close </button>
                        <button :disabled="form.busy" class="btn btn-success text-black" type="submit"> submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            form: {
                type: [Object],
                default: null,
            },
            modalID: {
                type: [String],
                default: null,
            },
            mode: {
                type: [Boolean],
                default: null,
            },
            merchant: {
                type: [Object],
                default: null,
            },
        },
        data() {
            return {

            }
        },
        methods: {

        },
        mounted(){

        },
    }
</script>

