<table 
        id="table"
        data-page-size="3"
        data-pagination="true"
        data-side-pagination="server"
        data-url="/getTasks"
        data-pagination-loop="false"
        data-pagination-parts="pageList"
        >
        <thead>
            <tr>
                <th data-field="username" data-sortable="true">UserName</th>
                <th data-field="email" data-sortable="true">E-Mail</th>
                <th data-field="description">Description</th>
                <th data-field="state" data-sortable="true" data-formatter="styleState" >State</th>
                <?php 
                    $data->isLoggedIn() ? print '<th data-formatter="styleAction" data-events="action">Action</th>' : ''
                ?>
                
            </tr>
        </thead>
    </table>
    <div class="modal" tabindex="-1" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    <div class="form-group">
                        <label for="taskDesc">Task description</label>
                        <textarea class="form-control" id="taskDesc" rows="3"></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="comTask">
                        <label class="form-check-label" for="comTask">Complete the task</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                <button type="button" class="btn btn-primary " id="saveTask">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    <script>
        var $table = $('#table')
        var editData

        $(function() {
            $table.bootstrapTable()
        }) 
        function styleState(value, row) {
            var state = value == 1 ? '<i style="color:green" class="fas fa-check-circle"></i>' 
            : '<i style="color:red" class="fas fa-times-circle"></i>'
            var edit = row.is_edit == 1 ? '<i class="fas fa-edit"></i>' : ''
            return [state,edit].join('')
        }
        function styleAction() {
            return [
                '<button type="button" class="btn fas fa-edit edit" data-toggle="modal" data-target="#editModal">Edit</button>'
            ].join('')
        }
        
        window.action = {
            'click .edit': function (e, value, row, index) {
                $('#editModal').on('show.bs.modal', function (){
                   $('#taskDesc').val(row.description)
                   row.state == 1 ? $('#comTask').prop('checked', true) : $('#comTask').prop('checked', false)
                   editData = row
                   editIndex = index
                })
            }
        }
        $('#saveTask').on('click', function(){
            var newDescription = $('#taskDesc').val()
            var state = $('#comTask').is(":checked") ? 1 : 0
            var is_edit = newDescription === editData.description ? 0 : 1
            $.post('/editTask/' + editData.id, {description: newDescription, state: state, is_edit: is_edit}, function(responce){
                try {
                    var data = $.parseJSON(responce);
                    alert(data.error)
                    $('#editModal').modal('hide')
                    $('#login').modal('show')
                }
                catch(e) {
                    alert('Change saved')
                    location.reload();
                } 
            })
        })
        $('#close').on('click', function(){
            editData = null
        })
    </script>