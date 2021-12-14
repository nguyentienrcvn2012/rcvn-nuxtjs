<template>

  <div class="container-fluid mt-5">
    <nuxt-link :to="{name: 'product-create'}" type="button" class="btn btn-success">Create</nuxt-link>
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Description</th>
            <th scope="col">Inventory</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="product in products" :key="product.id">
                <th scope="row">{{product.id}}</th>
                <td>{{product.productName}}</td>
                <td>{{product.categoryId}}</td>
                <td>{{product.price}}</td>
                <td>{{product.description}}</td>
                 <td>{{product.inventory}}</td>
                <td>
                    <nuxt-link :to="{name: 'product-id', params: {id: product.id}}" type="button" class="btn btn-primary">Edit</nuxt-link>
                    <button @click="deletePost(product.id)" type="button" class="btn btn-secondary">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
  </div>
</template>
<script>
import { BasePagination } from "@/components/argon-core";
import {
  Table,
  TableColumn,
  DropdownMenu,
  DropdownItem,
  Dropdown,
  Tooltip,
  Select,
  Option,
  Button,
} from "element-ui";

export default {
  layout: "DashboardLayout",

  components: {
    BasePagination,
    [Tooltip.name]: Tooltip,
    [Table.name]: Table,
    [TableColumn.name]: TableColumn,
    [Dropdown.name]: Dropdown,
    [DropdownItem.name]: DropdownItem,
    [DropdownMenu.name]: DropdownMenu,
    [Select.name]: Select,
    [Option.name]: Option,
    [Button.name]: Button,
  },
    data() {
        return {
            products: [],
            links: []
        }
    },
    async asyncData({$axios, params}) {
        const {data} = await $axios.$get(`/product`)
        return {products: data}
    },
    methods: {
        async deletePost(id) {
          await this.$axios.$post(`/product/delete/${this.$route.params.id}`, {id:id})
          // redirect
          await this.$nuxt.refresh()
      }
    }
};
</script>
<style>
#pro-feature {
  color: #5e72e4;
  font-weight: bold;
}
#pro-feature:hover {
  color: #233dd2;
}
</style>
