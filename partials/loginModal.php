<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to iDiscuss</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="handlelogin.php" method="post">
                <div class="modal-body">
                    <label for="loginEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="loginEmail" name="loginEmail"
                        aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="modal-body">
                    <label for="loginpass" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginpass" name="loginpass">
                </div>
                <button type="submit" class="btn btn-primary container-fluid">Login</button>
            </form>
        </div>

    </div>
</div>
</div>