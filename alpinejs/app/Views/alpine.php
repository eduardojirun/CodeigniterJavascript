<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>CRUD Application with Alpine.js</title>
</head>

<body>

    <div class="container-fluid mt-5" x-data="studentCrud()">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header text-light bg-dark">
                        Student Table
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(student,index) in students" :key="index">
                                    <tr>
                                        <td x-text="index+1"></td>
                                        <td x-text="student.name"></td>
                                        <td x-text="student.email"></td>
                                        <td>
                                            <button @click.prevent="editData(student,index)"
                                                class="btn btn-info">Edit</button>
                                            <button @click.prevent="deleteData(index)"
                                                class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-light bg-dark">
                        <span x-show="addMode">Create Student</span>
                        <span x-show="!addMode">Edit Student</span>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="saveData" x-show="addMode">
                            <div class="form-group">
                                <label>Name</label>
                                <input x-model="form.name" type="text" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input x-model="form.email" type="text" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                        <form @submit.prevent="updateData" x-show="!addMode">
                            <div class="form-group">
                                <label>Name</label>
                                <input x-model="form.name" type="text" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input x-model="form.email" type="text" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-danger" @click.prevent="cancelEdit">Cancel Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script>
        function studentCrud() {
            return {
                addMode: true,
                id: '',
                form: {
                    name: '',
                    email: '',
                },
                students: [{
                    name: 'test',
                    email: 'test@mail.com'
                }],
                saveData() {
                    if (this.form.name.length && this.form.email.length) {
                        this.students.push({
                            name: this.form.name,
                            email: this.form.email
                        })
                        this.resetForm()
                    }
                },
                editData(student, index) {
                    this.addMode = false
                    this.form.name = student.name
                    this.form.email = student.email
                    this.id = index
                },
                updateData() {
                    if (this.form.name.length && this.form.email.length) {
                        this.students.splice(this.id, 1, {
                            name: this.form.name,
                            email: this.form.email,
                        })
                        this.resetForm()                    
                    }
                },
                deleteData(index) {
                    this.students.splice(index, 1)
                },
                cancelEdit(){
                    this.resetForm()
                },
                resetForm() {
                    this.form.name = ''
                    this.form.email = ''
                    this.addMode = true
                }
            }
        }
    </script>
</body>
</html>