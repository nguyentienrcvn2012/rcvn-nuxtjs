<template>
  <div class="container">
    <div class=" mt-5 mb-5" style="padding:20px;">
        <h3 class="display-3">Create customer</h3>
        <hr>
        <div class="ml-5 content">
            <form v-on:submit.prevent="create">
            <div class="form-group">
                <label>Name value</label>
                <input v-model="form.name" id="name"  name ="name" type="name" class="form-control" autofocus  >
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input  v-model="form.email" id="email" name ="email" type="name" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>password</label>
                <input v-model="form.password" id="password"  name ="password" type="password" class="form-control" autofocus>
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
   
    data(){
        return{
            form: {
                name: '',
                email: '',
                password: ''
            }
        }
    },
  methods: {
    async create() {
      console.log(this.form)
      await this.$axios.$post("/user-create/create", this.form)
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
