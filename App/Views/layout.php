<!DOCTYPE html>
<html lang="ru">
<head>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    <link href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css" rel="stylesheet">
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAABILAAASCwAAAAAAAAAAAADot0T/6LhF/+m5SP/puEf/6bhH/+m5SP/puUj/6blK/+m5Sf/puUr/6bpL/+m7Tv/qvE//6rxS/+m7Tv/rwFv/7shw////////////89mb/+q8Uf/qvlX/6r5W/+u+V//rv1f/679X/+u/V//rv1j/679Z/+vBXP/rwFz/6r1T/+/LeP////////////TdqP////7//////////////////////////////////////////////////////+zEZf/rvlf//fnw//779P/uyXL/6blJ/+m5Sv/pukr/6bpL/+m6S//pukv/6bpM/+m6TP/pukz/6bpL/+m7Tv/pu07/7sp1////////////9Nyk/+3Faf/tx27/7chv/+3Ib//uyHD/7shw/+7Icf/uyHH/7slx/+7Jcf/uyHD/6rxQ/+/Mev////////////Teqf/89+n//frx//368v/9+vL//vrz//778//++/T//vv0//779f/++/X//vv0/+zDYv/rv1j//frz//779f/uyHD/6blJ/+m5Sf/puUn/6blK/+m6Sv/pukv/6bpM/+m6TP/pu03/6btN/+m7Tf/pu07/78t5////////////9N2m/+/Ofv/w0IX/8NCF//DQhv/w0Yb/8NGH//DRiP/x0Yj/8dKJ//HSif/x0on/6rxR/+/Me/////////////TeqP/67tL/+vDZ//rx2v/68dr/+/Hb//vx2//78tz/+/Ld//vy3f/78t7/+/Ld/+vBXv/qvlb//fry//779P/tx23/6blI/+m5Sf/puUn/6blJ/+m5Sv/pukv/6bpL/+m6TP/puk3/6btN/+m7Tf/pu03/78x7////////////9N2o//LXlv/z2Z3/89md//Panv/z2p7/89qf//Pan//z26D/89uh//Tbof/z26H/6r5V/+/Me/////////////TeqP/35bv/+OjC//jowv/46MP/+OjD//joxP/46cX/+OnF//jpxv/46cb/+OnG/+vAW//qvlX//fry//779f/tx27/6blJ/+m5Sf/puUr/6bpK/+m6S//pukv/6bpM/+m6Tf/pu03/6btN/+m7Tf/pu07/78t5////////////9N6p//Xgrv/247X/9uO2//bjtv/247f/9uO3//bkuP/25Lj/9uS5//bkuf/247f/68Bb/+/Mef////////////TeqP/03KT/9d+r//XfrP/136z/9d+t//Xgrf/14K7/9eCu//Xgrv/14K7/9eCu/+vAWv/puUn/8dKJ//HSi//qvlb/6blJ/+m5Sv/pukr/6bpL/+m6TP/pukz/6bpM/+m6TP/pukz/6btN/+q8Uf/qvFL/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==" rel="icon" type="image/x-icon">
    <title>BeeGee Tasks</title>
    <script 
        src="https://code.jquery.com/jquery-3.5.1.js" 
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" 
        crossorigin="anonymous">
    </script>
    <script 
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
</head>
</head>
<body>
    <div class="container">
        <div class="d-flex flex-row">
            <div class="d-flex p-2 bd-highlight">
                <button type="button" class="btn btn-secondary" id="addTask" data-toggle="modal" data-target="#addModal">Add task</button>
            </div>
            <div class="d-flex p-2 bd-highlight">
                <?php
                     $data->isLoggedIn()
                    ? print '<a class="btn btn-danger" href="/logout" role="button">Logout</a>'
                    : print '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">Login</button>'; 
                ?>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="addModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add new task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addForm">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="newTaskUser">UserName</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="newTaskEmail">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="newTaskDesc">Task description</label>
                                <textarea class="form-control" id="newTaskDesc" rows="3" name="description" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
                            <button class="btn btn-primary " type="submit">Add task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="login">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="loginForm">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="newTaskUser">UserName</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="newTaskEmail">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include '../App/Views/'.$content_view; ?>
    </div>
    <script>
        $('#addForm').submit(function(event) {
            $.post('/addTask', $('#addForm').serializeArray(), function(responce){
                try {
                    var data = $.parseJSON(responce);
                    alert(data.error)
                }
                catch(e) {
                    alert("New task added.")
                    window.location.href = '/'
                }
            })
            event.preventDefault(); 
        });
        $('#loginForm').submit(function(event) {
            $.post('/login', $('#loginForm').serializeArray(), function(responce){
                try {
                    var data = $.parseJSON(responce);
                    alert(data.error)
                }
                catch(e) {
                    alert("Login successful.")
                    window.location.href = '/'
                }
            })
            event.preventDefault(); 
        });
        $('#cancel').on('click', function(){
            $('#addForm').trigger("reset");
        })
    </script>
</body>
</html>