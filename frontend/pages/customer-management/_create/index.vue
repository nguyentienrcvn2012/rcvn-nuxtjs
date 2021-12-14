<template>
  <div class="container">
    <div class=" mt-5 mb-5" style="padding:20px;">
        <h3 class="display-3">Create customer</h3>
        <hr>
        <div class="ml-5 content">
            <form v-on:submit.prevent="create">
            <div class="form-group">
                <label>Name value</label>
                <input v-model="data.name" name="name" type="name" class="form-control" autofocus  >
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input v-model.trim="data.email" name="name" type="email" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>phone number</label>
                <input v-model.trim="data.phone" name="name" type="phone" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>address </label>
                <input v-model.trim="data.address" name="address" type="name" class="form-control" autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
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
    
    data() {
        return {
            data: 
              {
                name : '',
                email  : '',
                phone  : '',
                address : ''
              }
            }
    },
  methods: {
    async create() {
      await this.$axios.$post("/customer-create/create", this.data)
      await this.$router.go()
    },
    
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
