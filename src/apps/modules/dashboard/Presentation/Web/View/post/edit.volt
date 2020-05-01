{% extends 'layout/main.volt' %}

{% block content %}

<div class="row">
    <div class="col-md-3" style="background-color: #BC9CB0; padding: 20px; padding-top: 40px; padding-bottom: 40px;">
        {% if (session.has('auth')) %}
        <h1>Hello, {{ session.get('auth')['username'] }}!</h1>
        {% else %}
        <h1>Hello, guest!</h1>
        {% endif %}
    </div>
    <div class="col-md-6" style="background-color: #88958D; padding: 20px; padding-top: 40px; padding-bottom: 40px;">

        <h2 style="color: white;">Edit Question</h2>
        <form action="../save/{{ post.id }}" role="form" method="POST" id="newPost">
            <fieldset>
                <div class="form-group">
                    <label for="title" style="color: white;">Title</label><br>
                    <input type="text" name="title" class="form-control form-control-lg" value="{{ post.title }}"><br>
                </div>
                <div class="form-group">
                    <label for="content" style="color: white;">Post</label><br>
                    <textarea rows="6" cols="100" name="content" form="newPost" class="form-control">{{ post.content }}</textarea><br>
                </div>
                <input type="submit" value="Post" class="btn btn-primary">
            </fieldset>
        </form>
    </div>
    <div class="col-md-3" style="background-color: #D3CDD7; padding: 20px; padding-top: 40px; padding-bottom: 40px;">
        {% if (session.has('auth')) %}
        <h3>Ask a new question</h3>
        <a class="btn btn-primary" href="/dashboard/post/new">Ask!</a>
        {% else %}
        <h3>Login now to start asking question in this website!</h3>
        {% endif %}
    </div>
</div>
{% endblock %}