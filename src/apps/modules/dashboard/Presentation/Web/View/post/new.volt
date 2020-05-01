{% extends 'layout/main.volt' %}

{% block content %}

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6 shadow rounded" style="background-color: #D3CDD7; padding: 20px; padding-top: 40px;">

        <h2>Create New Question</h2>
        
        <form action="create" role="form" method="POST" id="newPost">
            <fieldset>
                <div class="form-group">
                    <label for="title">Title</label><br>
                    <input type="text" name="title" class="form-control form-control-lg"><br>
                </div>
                <div class="form-group">
                    <label for="content">Post</label><br>
                    <textarea rows="6" cols="100" name="content" form="newPost" class="form-control"></textarea><br>
                </div>
                <input type="submit" value="Post" class="btn btn-primary">
            </fieldset>
        </form>
    </div>
    <div class="col-md-3">
    </div>
</div>
{% endblock %}