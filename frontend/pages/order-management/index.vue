<template>

  <div class="container-fluid mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Quantily</th>
            <th scope="col">Total Price</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="order in orders" :key="order.id">
                <th scope="row">{{order.id}}</th>
                <td>{{order.productId}}</td>
                <td>{{order.customerId}}</td>
                <td>{{order.quantily}}</td>
                <td>{{order.totalPrice}}</td>
                 <td>{{order.status}}</td>
                <td>
                    <nuxt-link :to="{name: 'order-management-id', params: {id: order.id}}" type="button" class="btn btn-primary">Edit</nuxt-link>
                    <button @click="deletePost(order.id)" type="button" class="btn btn-secondary">Delete</button>
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
            orders: [],
            links: []
        }
    },
    async asyncData({$axios, params}) {
        const {data} = await $axios.$get(`/order`)
        return {orders: data}
    },
    methods: {
        async deletePost(id) {
          await this.$axios.$post(`/order/delete/${this.$route.params.id}`, {id:id})
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
