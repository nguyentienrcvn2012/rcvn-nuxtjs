<template>
  <div class="container">
    <div class=" mt-5 mb-5" style="padding:20px;">
        <h3 class="display-3">Update User {{data[0].name}}</h3>
        <hr>
        <div class="ml-5 content">
            <form @submit.prevent="update">
            <div class="form-group">
                <label>Name</label>
                <input v-model="data[0].name" type="name" class="form-control" autofocus  >
                <!-- <small v-if="errors[0].name" class="form-text text-danger">{{errors[0].name[0]}}</small> -->
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input v-model.trim="data[0].email" type="name" class="form-control" autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

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
    // validate({ params }){
    //     console.log('xxx',params)
    //     return true
    // },
    data() {
        return {
            data: {},
            errors:{}
            }
    },
    async asyncData({ $axios, params }) {
      const { data } = await $axios.$post(`/user/${params.id}`, {id:params.id})
      return {
        data: data
      }
    },
  methods: {
    // async create() {
    //   await this.$axios.$post(`/topics/${this.$route.params.id}/posts`, {body: this.body})
    //   this.$router.push('/topics')
    // },
      async update() {
          await this.$axios.$post(`/user/edit/${this.$route.params.id}`, {
              id: this.$route.params.id,
              name: this.data[0].name,
              email: this.data[0].email,
          });
          // redirect
          this.$router.push('/user-management')
      }
  }
}

</script>

<style scoped>
  .content {
    border-left: 10px solid white;
    padding: 0 10px 0 10px;
  }
  .btn-outline-success, .btn-outline-danger {
    border: none;
  }
</style>
