<template>
  <div class="container">
    <div class=" mt-5 mb-5" style="padding:20px;">
        <h3 class="display-3">Update  {{data[0].productId}}</h3>
        <hr>
        <div class="ml-5 content">
            <form @submit.prevent="update">
            <div class="form-group">
                <label>Product Name</label>
               <input type="name" class="form-control"   >
            </div>
            <div class="form-group">
                <label>Custome Name</label>
                   <input  type="name" class="form-control"   >
            </div>
            <div class="form-group">
                <label>Quantily</label>
                <input  type="name" class="form-control" >
            </div>
            <div class="form-group">
                <label>Price</label>
                <input  type="name" class="form-control" >
            </div>
            <div class="form-group">
                <label>Status</label>
                <input type="name" class="form-control" >
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
                productId : '',
                categoryId  : '',
                price  : '',
                description : '',
                inventory : ''
              }
            }
    },
  methods: {
    async create() {
      await this.$axios.$post("/order/create-order", this.data)
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
