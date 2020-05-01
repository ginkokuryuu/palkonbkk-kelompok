{% extends 'layout/main.volt' %}

{% block content %}

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6 shadow rounded" style="background-color: #D3CDD7; padding: 20px; padding-top: 40px;">
        <h2>Sign up</h2>
        
        <form action="../signup" role="form" method="POST">
            <p>
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
            </p>
            <p>
                <input type="submit" value="Sign Up" class="btn btn-primary">
            </p>
        </form>
    </div>
    <div class="col-md-3">
    </div>
</div>

{% endblock %}