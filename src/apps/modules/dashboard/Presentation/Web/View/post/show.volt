{% extends 'layout/main.volt' %}

{% block content %}


<div class="row">
    <div class="col-md-2" style="background-color: #BC9CB0; padding: 20px; padding-top: 40px; padding-bottom: 40px;">
        {% if (session.has('auth')) %}
        <h4>Hello, {{ session.get('auth')['username'] }}!</h4>
        {% else %}
        <h4>Hello, guest!</h4>
        {% endif %}

        <div class="list-group">
            <a href="/dashboard/search/bytag/0/" class="list-group-item list-group-item-action">Game Dev</a>
            <a href="/dashboard/search/bytag/1/" class="list-group-item list-group-item-action">Android Dev</a>
            <a href="/dashboard/search/bytag/2/" class="list-group-item list-group-item-action">Data Mining</a>
            <a href="/dashboard/search/bytag/3/" class="list-group-item list-group-item-action">TCyber</a>
            <a href="/dashboard/search/bytag/4/" class="list-group-item list-group-item-action">Competitive Programming</a>
          </div>
    </div>
    <div class="col-md-7" style="background-color: #88958D; padding: 20px; padding-top: 40px; padding-bottom: 40px;">
        <h1 style="color: white;">{{ post.title }}</h1>
        <p style="color: white;">Asked by {{ post.username }} at {{ post.created_at }}</p>
        <h3 style="color: white;">{{ post.content }}</h3>

        {% if(session.has('auth')) %}
            {% if(session.get('auth')['username'] == post.username) %}
            <a href="/dashboard/post/edit/{{ post.id }}" class="btn btn-primary">Edit</a>
            <a href="/dashboard/post/delete/{{ post.id }}" class="btn btn-danger">Delete</a>
            {% endif %}
            <br><br>
            <form action="/dashboard/comment/create/{{ post.id }}" role="form" method="POST" id="newComment">
                <textarea name="comment" cols="55" rows="5" form="newComment" placeholder="Add new answer" class="form-control"></textarea><br>
                <input type="submit" value="Add Answer" class="btn btn-primary">
            </form>
        {% endif %}
        
        <br><br>
        <h4 style="color: white;">Answers:</h4><br>
        {% for controller, comment in comments %}
        <div class="row" style="margin: 10px;">
            <div class="card col-sm-9">
                <p>{{ comment.comment }}</p>
                <h6>answer by {{ comment.username }}</h6>
            </div>
            <div class="col-s-3">
                <div style="margin: 10px; color: white;">
                    Upvote : {{ comment.upvote }}
                </div>
            </div>
            <div class="col-s-3">
                <a href="/dashboard/comment/upvote/{{ comment.id }}" class="btn btn-primary" style="margin: 5px;">Up vote</a><br>
                {% if(session.has('auth')) %}
                    {% if(session.get('auth')['username'] == comment.username) %}
                        <a href="/dashboard/comment/delete/{{ comment.id }}" class="btn btn-danger" style="margin: 5px;">Delete</a><br>
                    {% endif %}
                {% endif %}
            </div>
        </div>
        {% endfor %}
        {% if(comments.count() == 0) %}
        <p style="color: white;">No answer yet</p>
        {% endif %}
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