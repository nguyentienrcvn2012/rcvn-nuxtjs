<template>
  <div class="container-fluid mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <th scope="row">{{user.id}}</th>
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td>
                    <nuxt-link :to="{name:'user-management-id', params: {id: user.id}}" type="button" class="btn btn-primary">Edit</nuxt-link>
                    <button @click="deletePost(user.id)" type="button" class="btn btn-secondary">Delete</button>
                    <nuxt-link :to="{name: 'user-management-create', params: {id: user.id}}" type="button" class="btn btn-success">Create</nuxt-link>
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
          users: [],
          links: []
      }
  },
  async asyncData({$axios, params}) {
      const {data} = await $axios.$get(`/user`)
      return {users: data}
  },
  methods: {
      async deletePost(id) {
        await this.$axios.$post(`/user/delete/${this.$route.params.id}`, {id:id})
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
