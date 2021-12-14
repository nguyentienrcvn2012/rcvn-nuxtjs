<template>
  <div class="container-fluid mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="customer in customers" :key="customer.id">
                <th scope="row">{{customer.id}}</th>
                <td>{{customer.name}}</td>
                <td>{{customer.email}}</td>
                <td>{{customer.phone}}</td>
                <td>{{customer.address}}</td>
                <td>
                    <nuxt-link :to="{name: 'customer-management-id', params: {id: customer.id}}" type="button" class="btn btn-primary">Edit</nuxt-link>
                    <button @click="deletePost(customer.id)" type="button" class="btn btn-secondary">Delete</button>
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
            customers: [],
            links: []
        }
    },
    async asyncData({$axios, params}) {
        const {data} = await $axios.$get(`/customer`)
        return {customers: data}
    },
    // created(){
    //     this.$store.dispatch("setCustomers", this.customers)
    //     console.log('xxxxxxx', this.customers)
    //     console.log(this.$store.getters.customers)
    // }
    methods: {
        async deletePost(id) {
          await this.$axios.$post(`/customer/delete/${this.$route.params.id}`, {id:id})
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
