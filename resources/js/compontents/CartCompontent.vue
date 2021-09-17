<template>
    <li class="nav-item dropdown">
        <a id="cart-dropdown" class="nav-link" :class="{'dropdown-toggle':products.length > 0}" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-shopping-cart"></i>
            Cart
            <span class="badge">{{ products.length }}</span>
        </a>
        <ul v-if="products.length" class="dropdown-menu dropdown-menu-right" aria-labelledby="cart-dropdown">
            <li v-for="(row, i) in products" class="dropdown-item">
                <span> {{ row.name }} </span>
                <i class="fa fa-trash fa-fw" @click="remove(row)"></i>
            </li>
        </ul>
        <ul v-else class="dropdown-menu dropdown-menu-right" aria-labelledby="cart-dropdown">
            <li class="dropdown-item"> there is no products added </li>
        </ul>
    </li>
</template>
<script>
    export default {
        props: {
            products: {
                type: [Array],
                default: null,
            },
        },
        data(){
            return {
                //
            }
        },
        methods:{
            remove(row){
                this.$emit('remove-item-cart', row);
            }
        },
    }
</script>
